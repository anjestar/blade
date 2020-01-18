<?php
/**
 * Created by PhpStorm.
 * User: Gecco <hi@gecco.me>
 * Date: 2019/12/26
 * Time: 10:38
 */

namespace Blade;

use Closure;
use Exception;
use ReflectionClass;
use ReflectionParameter;

/*
 * @property Cache $xx
 */

class Container
{
    private static $_instances;
    private $s = [];

    public function singleton($k, $c)
    {
        $this->bind($k, $c, TRUE);
    }

    public function bind($k, $c, $singleton = FALSE)
    {
        $this->s[$k] = [$c, $singleton];
    }

    public function __get($k)
    {
        if (!$this->s[$k][0]) {
            throw new \Exception("目标 {$k} 未进行绑定，无法直接使用！", 500);
        }
        return $this->getInstance(...$this->s[$k]);
    }

    public function getInstance($name, $singleton)
    {
        //闭包直接输出
        if ($name instanceof Closure) {
            return $name($this);
        }
        //非单例
        if (!$singleton) {
            return $this->build($name);
        }
        //单例
        if (isset(self::$_instances[$name])) {
            return self::$_instances[$name];
        }
        return self::$_instances[$name] = $this->build($name);
    }

    public function build($className)
    {
        $reflector = new ReflectionClass($className);
        // 检查类是否可实例化, 排除抽象类abstract和对象接口interface
        if (!$reflector->isInstantiable()) {
            throw new Exception("该目标无法实例化，仅支持类名");
        }
        $constructor = $reflector->getConstructor();

        // 如果没有构造函数， 直接实例化并返回
        if (is_null($constructor)) {
            return new $className;
        }
        $parameters = $constructor->getParameters();
        // 递归解析构造函数的参数
        $dependencies = $this->getDependencies($parameters);
        // 创建一个类的新实例,给出的参数将传递到类的构造函数.
        return $reflector->newInstanceArgs($dependencies);
    }

    public function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if (is_null($dependency)) {
                $dependencies[] = $this->resolveNonClass($parameter);
            } else {
                // 是一个类，递归解析
                $className = lcfirst($dependency->name);
                // 先取出容器中绑定的类 否则自动绑定
                if ($this->s[$className]) {
                    $dependencies[] = $this->$className;
                } else {
                    $dependencies[] = $this->build($dependency->name);
                }
            }
        }
        return $dependencies;
    }

    public function resolveNonClass(ReflectionParameter $parameter)
    {
        // 有默认值则返回默认值
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        throw new Exception('无法处理的参数依赖');
    }
}