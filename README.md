# MonkeyYar
A PHP Framework based on Yar for RPC Service
## 安装前提
* PHP的扩展[Yar](https://github.com/laruence/yar.git)
* 项目依赖包 [composer](https://getcomposer.org/) install 或者 直接在本项目根目录下执行 php composer.phar install
## 初始化
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