<?php
namespace  Home\Controller;
use Think\Controller;
use Home\Model\MenuModel;
use Think\Model;

class MenuController extends Controller{
    private $menuModel;    
    
    public function __construct(){
        $this->menuModel = new MenuModel();
//         $this->menuModel =new Model("menu","",C("DB_DSN"));
    }
    /**
     * 异步返回并输出  json字符串
     */
    public function loadMenuByPage($pageNo=1,$pageSize=10){
//         $pageNo = (int)$_GET["pageNo"];
//         $pageSize = (int)$_GET["pageSize"];
        $page  = $this->menuModel->loadMenuByPage($pageNo,$pageSize);
        $this->ajaxReturn($page);
//         $jsonStr = json_encode($page);
//         echo $jsonStr;
    }
    /*
     * 添加或者修改菜单
     * 异步返回insertOK添加成功   updateOK修改成功   no
     * 
     * 
     */
    public function saveAndUpdataMenu(){
        $menuid = $_POST["menuid"];
        $name = $_POST["name"];
        $url = $_POST["url"];
        $parentid = $_POST["parentid"];
        $isshow = $_POST["isshow"];
        if ($menuid ==""){
            $this->menuModel->saveAndUpdataMenu($name,$url,$parentid,$isshow,0);
            $this->ajaxReturn("insertok","eval");
        }else {
            $this->menuModel->saveAndUpdataMenu($name,$url,$parentid,$isshow,$menuid);
            $this->ajaxReturn("updateok","eval");
        }
    }
    
    public function menumanage(){
        $this->display();
    }
    
    public function load12Menu(){
         $page  = $this->menuModel->load12Menu();
         $this->ajaxReturn($page);
    }
    
    public function loadMenuByID($menuid){
        $menuid = $_GET["menuid"];
        $menu  = $this->menuModel->loadMenuByID($menuid);
        $this->ajaxReturn($menu);
    }
    
    
    public function deleteMenu(){
        $menuids = $_POST["menuids"];
        $menu  = $this->menuModel->deleteMenu($menuids);
//         $jsonStr = json_encode($menu);
        echo $menu;
    }
//     public function loadPageMenu($sql,$pageNo,$pageSize,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=nul){
//         //total  rows
//         $page = array();
//         try {
//             $sql2= "select count(*) ".substr(strpos("from", $sql),strpos("limit", $sql));
//             $ps= $this->pdo->prepare($sql2);
//             $ps->execute($params);
//             //提取出来是一个数组
//             $page["total"] = $ps->fetch(\PDO::FETCH_NUM)[0];
        
        
//             //当前页的数据
//             //             $pdoMysql = XMLParse::parseDBXML();
//             //             $pdo = new \PDO($pdoMysql[0],$pdoMysql[1],$pdoMysql[2],array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
//             $ps= $this->pdo->prepare($sql);
//             //如果参数不为空 并且元素个数大于0  需要绑定参数
//             if ($params != null  &&  count($params)>0){
//                 $ps->execute($params);
//             }else{
//                 $ps->execute();
//             }
        
//             if ($fetchStyle == \PDO::FETCH_OBJ){
//                 $objs = array();
//                 while ($obj = $ps->fetchObject($className)){
//                     array_push($objs,$obj);
//                 }
//                 $page["rows"] = $objs;
//             }else{
//                 $page["rows"] =  $ps->fetchAll($fetchStyle);
//             }
//             return $page;
//             //查询总共有多少数据
//             $sql= "select count(*) ".substr(strpos("from", $sql),strpos("limit", $sql))."";
//             //         $ps->getColumnMeta($column);
//         }catch(\PDOException $e){
//             return false;
//         }
//         //如果方法执行抛异常 经返回一个空数组
//     }
}

?>