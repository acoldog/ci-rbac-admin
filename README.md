# ci-rbac-admin

<h2>半小时内搭建一套带权限管理的管理后台系统</h2>

<h3>说明</h3>

基于codeigniter3.0的快速搭建 带有RBAC权限管理系统的 管理后台框架

支持快速搭建表单提交保存入库功能

集成图片上传，预览，富文本编辑框（ueditor）

样式采用 bootstrap3，支持直接集成该版本的bootstrap各种框架

完整清晰的 RBAC 权限管理系统


<h3>安装注意事项</h3>
php需要安装mysqli或者pdo扩展
upload目录需要创建文件的权限


把根目录下的 test-xxx.sql 导进数据库，改一下application/config/databases.php 里的数据库名就可以了

nginx.conf 配置示例：

location / {
    try_files $uri $uri/ /index.php?$query_string;
}


有空再加详细说明

fork from https://github.com/toryzen/SmartCI

<h3>将ci升级到了最新版本，做了很多样式细节优化，加了常见有用的插件，封装了表单入库的基本操作</h3>
<h3>功能堆加迭代更加迅速，大大减少代码量</h3>