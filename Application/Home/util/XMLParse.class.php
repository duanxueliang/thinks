<?php
/**
 * xml解析工具类
 * @author j
 *
 */
namespace Home\util;
class XMLParse{
    /**
     * 解析   xml
     * return  数据库  用户名  密码的组成的数组
     */
    public  static  function parseDBXML(){
        // require_once dirname(__FILE__).'/config/db.xml';
        $sx = simplexml_load_file(dirname(__DIR__)."/config/db.xml");
        
        $children = $sx->children();
        $pdoMysql = array((string)$children[0]->dsn,(string)$children[0]->username,(string)$children[0]->password);
        // print_r($pdoMysql);
        return  $pdoMysql;
    }
    
}

?>