# Blade
Blade is a high-performance php framework.

# TodoList
[x] 自动加载：基于PSR-4，使用命名空间
[] 错误和异常处理：可以捕获异常、记录日志并通知相关开发人员
[] 日志系统：可以分级别输出、
[] 配置中心读取模块：用于将配置从代码完全分离
[] 请求模块：可以方便的进行参数验证、修改及mock测试
[] 路由：简单点直接隐式映射控制器方法、性能也好点，暂时不用支持到路由中间件及别名，RESTful另外做支持
[] 中间件：全局中间件、控制器中间件
[] 控制器：支持到能映射方法执行、RESTful方法支持、只处理请求和响应
[] 数据模型：这部分准备使用号称宇宙最强的Eloquent ORM（illuminate/database）
[] 视图（模板引擎）：这部分本来不准备做的。本来PHP最开始就是做的模板语言，能很方便的与HTML代码结合。
[] 响应模块：能够决定响应的内容和类型（HTML、JSON、XML、Protobuf）并最终响应出去
