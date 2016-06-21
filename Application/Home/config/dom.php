<?php
require_once '../../Application/Home/config/db.xml';
/**
 * 
 * 
 * 
 *xml解析 
 * 
 */
// 初始化解析器
$document = new DOMDocument();

//加载xml文件
$document->load("config/db.xml");
//通过元素名称获得元素数组
$dsn = $document->getElementsByTagName("dsn");
$username = $document->getElementsByTagName("username");
$password = $document->getElementsByTagName("password");
//获取元素的文本内容
// $dsn->item(0)->nodeValue;
// $username->item(0)->nodeValue;
// $password->item(0)->nodeValue;
//添加到数组
$pdoMysql = array($dsn->item(0)->nodeValue,$username->item(0)->nodeValue,$password->item(0)->nodeValue);

// print_r($pdoMysql);
// $sx = simplexml_load_file("db.xml");

// $children = $sx->children();
// $pdoMysql = array((string)$children[0]->dsn,(string)$children[0]->username,(string)$children[0]->password);
// // print_r($pdoMysql);
/**
 * 
 * 对象的创建
 * JavaScript对象表示法   对象传输
 * json
 * 
 * 
 */

// var obj = eval("("+txt+")");

?>