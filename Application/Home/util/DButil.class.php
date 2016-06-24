<?php
namespace Home\util;
use Home\util\XMLParse;

/**通用的dml语句执行方法
 * 封装增删改查 四种操作为两个通用方法
 * @author j
 * $sql 将要执行的语句   可以带有问号 占位符
 * $params   可选参数   当sql中有问号时候   此参数必填  问号个数必须与此数组内的元素个数相同 并且注意顺序  
 * 若sql中无问号时  则此可不填或者填一个null array();
 * 
 *return   true  表示成功 
 *
 */

class DButil{
    //保存pdo；连接的数组
    private $pdoMysql;
    //创建pdo对象
    private $pdo;
    
    public  function __construct(){
        $this->pdoMysql = XMLParse::parseDBXML();
//         $this->pdo = new \PDO(C("DSN"),C("DBUSER"),C("DBPASS"),C("PDOOPTIONS"));
        $this->pdo = new \PDO(C("DB_TYPE").":host=".C("DB_HOST").";dbname=".C("DB_NAME"),C("DB_USER"),C("DB_PWD"),C("DB_PARAMS"));
    }
    
    public function executeDML($sql,array $params=null){
        $b =true;
        try {
//         $pdoMysql = XMLParse::parseDBXML();
//         $pdo = new \PDO($pdoMysql[0],$pdoMysql[1],$pdoMysql[2],array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
        $ps= $this->pdo->prepare($sql);
        //如果参数不为空 并且元素个数大于0  需要绑定参数
        if ($params != null &&  count($params)>0){
            $ps->execute($params);
            
        }else{
            $ps->execute();
        }
//         $ps->getColumnMeta($column);
        }catch(\PDOException $e){
            $b =  false;
        }
        return $b;
    }
    /**
     * 通用的查询语句方法
     * 
     * @param unknown $sql  将要执行的查询语句  可以有问号
     * @param array $params  
     * @param unknown $fetchStyle  可选参数   提前去数据的方法  默认为 PDO::FETCH_NUM   可选值有PDO::FETCH_ASSOC //对象OBJ 
     * @param unknown $className可选参数  当$fetchStyle取值为PDO::FETCH_OBJ此参数要求填入实体类的全名（命名空间\类名）；当$fetchStyle不为PDO::FETCH_OBJ此参数不填
     * @throws PDOException
     * @return array 当有查询有数据则返回数据组成的数组  没有的话则返回空数组
     */
    public function executeQuery($sql,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=null){
        try {
//             $pdoMysql = XMLParse::parseDBXML();
//             $pdo = new \PDO($pdoMysql[0],$pdoMysql[1],$pdoMysql[2],array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
            $ps = $this->pdo->prepare($sql);
            //如果参数不为空 并且元素个数大于0  需要绑定参数
            if ($params != null  &&  count($params)>0){
                $ps->execute($params);
            }else{
                $ps->execute();
            }
            
            if ($fetchStyle == \PDO::FETCH_OBJ){
                 $objs = array();
                 while ($obj = $ps->fetchObject($className)){
                     array_push($objs,$obj);
                 }
                 return $objs;
            }else{
                 return $ps->fetchAll($fetchStyle);
            }
            //         $ps->getColumnMeta($column);
        }catch(\PDOException $e){
           return false;
        }
        //如果方法执行抛异常 经返回一个空数组
      
    }
    
    /**
     * 通用的查询语句方法  并分页查询菜单列表
     * 
     * @param unknown $sql  将要执行的查询语句  可以有问号
     * @pageNo  int  表示当前页码最小为一  
     * @oageSize  string  当前显示多少行数据
     * @param array $params  
     * @param unknown $fetchStyle  可选参数   提前去数据的方法  默认为 PDO::FETCH_NUM   可选值有PDO::FETCH_ASSOC //对象OBJ 
     * @param unknown $className可选参数  当$fetchStyle取值为PDO::FETCH_OBJ此参数要求填入实体类的全名（命名空间\类名）；当$fetchStyle不为PDO::FETCH_OBJ此参数不填
     * @throws PDOException
     * @return array 关联数组有两个索引  索引total 表示总共有多少行   索引rows 表示当前的数据
     *返回带total 和rows  的索引数组  
     */
    public function executePageQuery($sql,$pageNo,$pageSize,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=null){
        //total  rows 
        $page = array("total"=>0,"rows"=>array());
        try {
            $index1 = strpos($sql,"from");
            $index2 = strpos($sql,"limit");
            
            $sql2= "select count(*) ".substr($sql,$index1,$index2-$index1);
            $ps= $this->pdo->prepare($sql2);
            $ps->execute($params);
            //提取出来是一个数组
            $page["total"] = $ps->fetch(\PDO::FETCH_NUM)[0];
            
            
            //当前页的数据
            $ps= $this->pdo->prepare($sql);
            //如果参数不为空 并且元素个数大于0  需要绑定参数
            $begin = ($pageNo-1)*$pageSize;
            //统计原来的sql中包含多少个问号   至少都要包含两个问号
            $countWenhao = 0;
            str_replace("?","?",$sql,$countWenhao);
            if ($countWenhao>0){
                $ps->bindParam($countWenhao-1,$begin,\PDO::PARAM_INT);
                $ps->bindParam($countWenhao,$pageSize,\PDO::PARAM_INT);
            }
//             while ($m = $ps->fetchObject($className)){
//                 array_push($menus, $m);
//             }
            if ($params != null  &&  count($params)>0){
                $ps->execute($params);
            }else{
                $ps->execute();
            }
        
            if ($fetchStyle == \PDO::FETCH_OBJ){
                $objs = array();
                while ($obj = $ps->fetchObject($className)){
                    array_push($objs,$obj);
                }
                $page["rows"] = $objs;
            }else{
                $page["rows"] =  $ps->fetchAll($fetchStyle);
            }
                 
            //查询总共有多少数据
            //         $ps->getColumnMeta($column);
        }catch(\PDOException $e){
            return false;
        }
        //如果方法执行抛异常 经返回一个空数组
        return $page;
    }
    
    public function executePageSubQuery($datasql,$countsql,$pageNo,$pageSize,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=null){
        //total  rows
        $page = array("total"=>0,"rows"=>array());
        try {
            //             $index1 = strpos($sql,"from");
            //             $index2 = strpos($sql,"limit");
    
            //             $sql2= "select count(*) ".substr($sql,$index1,$index2-$index1);
            //             $ps= $this->pdo->prepare($sql2);
            //             $ps->execute($params);
            //             //提取出来是一个数组
            //             $page["total"] = $ps->fetch(\PDO::FETCH_NUM)[0];
            $ps= $this->pdo->prepare($countsql);
            $ps->execute($params);
            $page["total"]  = $ps->fetch(\PDO::FETCH_NUM)[0];
    
            //当前页的数据
            $ps= $this->pdo->prepare($datasql);
            //如果参数不为空 并且元素个数大于0  需要绑定参数
            $begin = ($pageNo-1)*$pageSize;
            //统计原来的sql中包含多少个问号   至少都要包含两个问号
            $countWenhao = 0;
            str_replace("?","?",$datasql,$countWenhao);
    
            $ps->bindParam($countWenhao-1,$begin,\PDO::PARAM_INT);
            $ps->bindParam($countWenhao,$pageSize,\PDO::PARAM_INT);
    
            //             while ($m = $ps->fetchObject($className)){
            //                 array_push($menus, $m);
            //             }
            if ($params != null  &&  count($params)>0){
                $ps->execute($params);
            }else{
                $ps->execute();
            }
    
            if ($fetchStyle == \PDO::FETCH_OBJ){
                $objs = array();
                while ($obj = $ps->fetchObject($className)){
                    array_push($objs,$obj);
                }
                $page["rows"] = $objs;
            }else{
                $page["rows"] =  $ps->fetchAll($fetchStyle);
            }
             
            //查询总共有多少数据
            //         $ps->getColumnMeta($column);
        }catch(\PDOException $e){
            return false;
        }
        //如果方法执行抛异常 经返回一个空数组
        return $page;
    }
    
    /**
     * @return $pdoMysql
     */
    public function getPdoMysql()
    {
        return $this->pdoMysql;
    }

    /**
     * @return $pdo
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setPdoMysql($pdoMysql)
    {
        $this->pdoMysql = $pdoMysql;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    public function executelikeQuery($datasql,$countsql,$pageNo,$pageSize,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=null){
        //total  rows
        $page = array("total"=>0,"rows"=>array());
        try {
            //             $index1 = strpos($sql,"from");
            //             $index2 = strpos($sql,"limit");
    
            //             $sql2= "select count(*) ".substr($sql,$index1,$index2-$index1);
            //             $ps= $this->pdo->prepare($sql2);
            //             $ps->execute($params);
            //             //提取出来是一个数组
            //             $page["total"] = $ps->fetch(\PDO::FETCH_NUM)[0];
            $ps= $this->pdo->prepare($countsql);
            $ps->execute($params);
            $page["total"]  = $ps->fetch(\PDO::FETCH_NUM)[0];
    
            //当前页的数据
            $ps= $this->pdo->prepare($datasql);
            //如果参数不为空 并且元素个数大于0  需要绑定参数
            $begin = ($pageNo-1)*$pageSize;
            //统计原来的sql中包含多少个问号   至少都要包含两个问号
            $countWenhao = 0;
            str_replace("?","?",$datasql,$countWenhao);
    
            $ps->bindParam($countWenhao-1,$begin,\PDO::PARAM_INT);
            $ps->bindParam($countWenhao,$pageSize,\PDO::PARAM_INT);
    
            //             while ($m = $ps->fetchObject($className)){
            //                 array_push($menus, $m);
            //             }
            if ($params != null  &&  count($params)>0){
                $ps->execute($params);
            }else{
                $ps->execute();
            }
    
            if ($fetchStyle == \PDO::FETCH_OBJ){
                $objs = array();
                while ($obj = $ps->fetchObject($className)){
                    array_push($objs,$obj);
                }
                $page["rows"] = $objs;
            }else{
                $page["rows"] =  $ps->fetchAll($fetchStyle);
            }
             
            //查询总共有多少数据
            //         $ps->getColumnMeta($column);
        }catch(\PDOException $e){
            return false;
        }
        //如果方法执行抛异常 经返回一个空数组
        return $page;
    }
    
    
    
    public function executeAddMenu($sql,$name,$url,$parentid,$isshow,$menuid,$fetchStyle=\PDO::FETCH_NUM,$className=null){
        $ps = $this->pdo->prepare($sql);
        $ps->execute(array($name,$url,$parentid,$isshow,$menuid));
        $menu = $ps->fetchObject($className);
        return $menu;
    }
    public function execute12Menu($sql,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=null){
        $pstmt = $this->pdo->prepare($sql);
        //查询一级菜单
        $pstmt->execute($params);
        $fsMenu=array();
        if ( $menu1 = $pstmt->fetchObject($className)){
            $menu1->setName("一级".$menu1->getName());
            array_push($fsMenu,$menu1);
            //查询所有二级菜单   放进$secondMenu数组中
            $pstmt->execute(array($menu1->getMenuid()));
            //         $secondMenu= $pstmt->fetchObject();
            while ($menu2 = $pstmt->fetchObject($className)){
                $menu2->setName("二级".$menu2->getName());
                array_push($fsMenu,$menu2);
            }
            return $fsMenu;
       }
  }
}
?>