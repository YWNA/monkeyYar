# MonkeyYar
A PHP Framework based on Yar for RPC Service
## 安装
* PHP扩展Yar,项目地址:[https://github.com/YWNA/yar](https://github.com/YWNA/yar)
  1. 使用[pecl](http://pecl.php.net/)安装,如果本地没有安装pecl,可以使用 sudo apt-get install php-pear
  2. pecl install yar
* 依赖包
  1. [composer](https://getcomposer.org/) install 或者 php composer.phar install
## 特点
* 数据库表脚本
  1. 初始化
      ```php
      bin/phpmig init
      ```
  2. 新建脚本
      ```php
      bin/phpmig generate
      ```
* 单元测试
  1. 初始化
      ```php
      bin/codecept init unit
      执行命令后的一个选项Do you wish to enable them? (y/n)选择y,其它默认敲击键盘回车即可. 
      ```
  2. 新建单元测试类
      ```php
      bin/codecept generate:test unit Example
      ```