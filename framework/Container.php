<?php

namespace Framework;

/**
 * 依赖注入容器
 * Dependency Injection Container
 * @author Gecco <https://github.com/anjestar>
 */
class Container {
    /**
     * The container's bindings.
     * 将 class B 绑定到 interface A，当有地方需要一个 interface A 的时候就给他返回一个 class B 的实例
     * @var array
     */
    protected $bindings = [];

    /**
     * @param      $abstract
     * @param null $concrete
     * @param bool $shared
     *
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/3
     */
    public function bind($abstract, $concrete = null, $shared = false) {
        //当不传实现的时候，默认抽象名称就是要实现的类名
        if (is_null($concrete)) {
            $concrete = $abstract;
        }
        //不是闭包就给它实现一个
        if (!$concrete instanceof \Closure) {
            $concrete = $this->getClosure($abstract, $concrete);
        }
        //设置绑定
        $this->bindings[$abstract] = compact("concrete", "shared");
    }

    /**
     * @param $abstract
     * @param $concrete
     *
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/3
     */
    public function singleton($abstract, $concrete) {
        $this->bind($abstract, $concrete, true);
    }

    /**
     * @param $abstract
     * @param $concrete
     *
     * @return \Closure
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/3
     */
    public function getClosure($abstract, $concrete) {
        return function ($c) use ($abstract, $concrete) {
            $method = ($abstract == $concrete) ? 'build' : 'make';
            return $c->$method($concrete);
        };
    }

    /**
     * @param $abstract
     *
     * @return mixed
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/3
     * @throws \ReflectionException
     */
    public function make($abstract) {
        $concrete = $this->getConcrete($abstract);
        if ($this->isBuildable($abstract, $concrete)) {
            $object = $this->build($concrete);
        } else {
            $object = $this->make($concrete);
        }
        return $object;
    }

    /**
     * @param $abstract
     *
     * @return mixed
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/3
     */
    public function getConcrete($abstract) {
        if (!isset($this->bindings[$abstract])) {
            return $abstract;
        }
        return $this->bindings[$abstract]['concrete'];
    }

    /**
     * @param $abstract
     * @param $concrete
     *
     * @return bool
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/4
     */
    public function isBuildable($abstract, $concrete) {
        return $abstract == $concrete || $concrete instanceof \Closure;
    }

    /**
     * @param $concrete
     *
     * @return mixed|object
     * @throws \ReflectionException
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/4
     */
    public function build($concrete) {

        if ($concrete instanceof \Closure) {
            return $concrete($this);
        }

        //反射
        $reflector = new \ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new \Exception('Can Not Instant');
        }

        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $constructor->getParameters();

        $instance = $this->getDependencies($dependencies);

        return $reflector->newInstanceArgs($instance);
    }

    /**
     * @param array $dependencies
     *
     * @return array
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/4
     * @throws \Exception
     */
    public function getDependencies(array $dependencies) {
        $results = [];

        foreach ($dependencies as $dependency) {
            $results[] = is_null($dependency->getClass())
                ? $this->resolveNonClass($dependency)
                : $this->resolveClass($dependency);
        }
        return $results;
    }

    /**
     * @param \ReflectionParameter $parameter
     *
     * @return mixed
     * @throws \Exception
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/4
     */
    public function resolveNonClass(\ReflectionParameter $parameter) {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        throw new \Exception('Something wrong!');
    }

    /**
     * @param \ReflectionParameter $parameter
     *
     * @return mixed
     * @author Gecco <liuxin@aladinfun.com>
     * @date   2019/4/4
     * @throws \ReflectionException
     */
    public function resolveClass(\ReflectionParameter $parameter) {
        return $this->make($parameter->getClass()->name);
    }

}
