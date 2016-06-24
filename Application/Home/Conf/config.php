<?php
return array(
	//'配置项'=>'配置值'
//     "URL_ROUTER_ON"=>true,
//     "URL_ROUTE_RULES"=>array(
//             "tt/:eason/:value"   =>"index/index",
//             "login1" =>"User/login"
//     //      "ppp"=>"/eason/aaa/value/123"
//     )]
//     'DB_TYPE' =>'mysql',
//     'DB_HOST' =>'localhost',
//     'DB_USER' =>'root',
//     'DB_PWD' =>'892832',
//     'DB_NAME' =>'syc'
    'DB_TYPE'   =>  'mysql',
    'DB_HOST'   =>  'localhost',
    'DB_USER'   =>  'root',
    'DB_PWD'    =>  '892832',
    'DB_PORT'   =>  3306,
    'DB_NAME'   =>  'syc',
    'DB_DSN'    =>  'mysql:host=localhost;dbname=syc',
    'DB_CHARSET'=>  'utf-8',
    'DB_PARAMS' =>  array(
        \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
    )
);