<?php
//应用配置    全局配置
return array(
	//'配置项'=>'配置值'
	//修改默认的模板结构   控制器类名_操作方法名.html
// 	"DSN"=>"mysql:host=localhost;dbname=syc",
//     "DBUSER"=>"root",
//     "DBPASS"=>"892832",
//     "DBPORT"=>3306,
//     "PDOOPTIONS"=>array(
//         \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
//     ),
    //以下是分页查询配置
    "PAGENO"=>1,
    "PAGESIZE"=>10,
//     'CONTROLLER_LEVEL'=>2,
//     'URL_PARAMS_BIND' => true,
    //设置url为重写模式 6214830233609113
//     "URL_MODEL"=>2,
    //开启路由
    "URL_ROUTER_ON"=>true,
    "URL_ROUTE_RULES"=>array(
        'aaa/:username/:userpass'   =>"Home/index/index",
        '/^bbb\/(\d(4))\/(\d(2))\/(\d(22))$/' => "Home/index/index",
        'ttt/:year/:month/:date'=>"Home/index/test"
//         "login" =>"Home/User/login"
//         "ppp"=>"/eason/aaa/value/123"
    ),
    //字符串格式创建对象要求必须传入三个参数    第一个表示表名称 第二个表示表名称前缀  第三个表示连接信息
//   字符串格式
    'DB_DSN'=>"mysql://root:892832@localhost:3306/syc#utf8",
//   数组格式
//     "DB_ARRAY"=>array(
//         'db_type'=>'mysql',
//         'db_host'=>"localhost",
//         "db_user"=>"root",
//         "db_pwd"=>'892832',
//         'db_port'=>3306,
//         'db_name'=>'syc',
//         'db_charset'=>'utf8'
//     )
//   配置格式
    'DB_TYPE' =>'mysql',
    'DB_HOST' =>'localhost',
    'DB_USER' =>'root',
    'DB_PWD' =>'892832',
    'DB_NAME' =>'syc',
//     'TMPL_FILE_DEPR'=>'_'
);