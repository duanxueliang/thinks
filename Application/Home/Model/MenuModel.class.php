<?php
namespace Home\Model;
use Home\util\DButil;
use Home\entity\Menu;
/**
 * 专注于访问menu表
 * @author j
 *
 */

class MenuModel{
    private $dbUtil;
    public function __construct(){
        $this->dbUtil = new DButil();
    }
    /**
     * 分页查询菜单列表
     * @param unknown $pageNo
     * @param unknown $pageSize
     * 
     * 返回带total 和rows  的索引数组 
     */
    public function loadMenuByPage($pageNo,$pageSize){
        $begin = ($pageNo-1)*$pageSize;
        $sql = "select * from menu limit $begin,$pageSize";
        $page = $this->dbUtil->executePageQuery($sql,$pageNo, $pageSize,null,$fetchStyle=\PDO::FETCH_OBJ,'Home\entity\Menu');
        return  $page;
    }
    
    
    public function saveAndUpdataMenu($name,$url,$parentid,$isshow,$menuid){
        $b = true;
        if ($menuid == 0){
            $sql = "insert into menu(name,url,parentid,isshow) values(?,?,?,?)";
            $b = $this->dbUtil->executeDML($sql,array($name,$url,$parentid,$isshow));
        }elseif($menuid >0){
            $sql = "update menu set name=?,url=?,parentid=?,isshow=? where menuid=?";
            $b = $this->dbUtil->executeDML($sql,array($name,$url,$parentid,$isshow,$menuid));
        }
        return $b;
    }

    
 public function loadTreeMenu($uid){
        $m2s =array();
        $sql = "select m.* from userrole ur,rolemenu rm,menu m where ur.rid=rm.rid and rm.menuid=m.menuid and m.isshow=1 and ur.uid=? and parentid=?";
        $menus = $this->dbUtil->executeQuery($sql,array($uid,-1));
        if ($menus > 0){
            $menu1 = $menus[0];
            $menu2 = $this->dbUtil->executeQuery($sql,array($uid,$menu1[0]));
        
            foreach ($menu2 as $second){
                $m2 = array();
                array_push($m2,$second[0],$second[1],$second[2],$second[3],$second[4]);
                $menu3 = $this->dbUtil->executeQuery($sql,array($uid,$second[0]));
//                 $second->setChildren($menu3);
                array_push($m2,$menu3);
                array_push($m2s, $m2);
            }
            return $m2s;
        }
       
    }
    
    public function load12Menu(){
        $sql = "select * from menu where parentid=?";
        $menus = $this->dbUtil->execute12Menu($sql,array(-1),$fetchStyle=\PDO::FETCH_OBJ,'Home\entity\Menu');
        return $menus;
    }
   
    public function loadMenuByID($menuid){
        $sql = "select * from menu where menuid=?";
        $menu = $this->dbUtil->executeQuery($sql,array($menuid),$fetchStyle=\PDO::FETCH_OBJ,'Home\entity\Menu');
        $menu1 =  $menu[0];
        return $menu1;
    }
    public function deleteMenu($menuids){
        $sql = "delete from menu where menuid=$menuids";
        $menu  = $this->dbUtil->executeDML($sql,array($menuids));
        return $menu;
    }
    
//     public function execute12Menu($sql,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=null){
//         $pstmt = $this->pdo->prepare($sql);
//         //查询一级菜单
//         $pstmt->execute($params);
//         $fsMenu=array();
//         if ( $menu1 = $pstmt->fetchObject($className)){
//             $menu1->setName("一级".$menu1->getName());
//             array_push($fsMenu,$menu1);
//             //查询所有二级菜单   放进$secondMenu数组中
//             $pstmt->execute(array($menu1->getMenuid()));
//             //         $secondMenu= $pstmt->fetchObject();
//             while ($menu2 = $pstmt->fetchObject($className)){
//                 $menu2->setName("二级".$menu2->getName());
//                 array_push($fsMenu,$menu2);
//             }
            
//         }
//     }
//     public function load12Men($parentid){
//         $sql = "select * from menu where parentid=?";
//         $fsMenu=array();
//         $menus = $this->dbUtil->executeQuery($sql,array(parentid),$fetchStyle=\PDO::FETCH_OBJ,'entity\Menu');
         
//         foreach ($menus as $m){
//             $m->setName("一级".$m->getName());
//             array_push($fsMenu,$m);
//         }
//         $menuss = $this->dbUtil->executeQuery($sql,array($m->getMenuid()),\PDO::FETCH_OBJ,'entity\Menu');
//         foreach  ($menuss as $m2) {
//             $m2->setName("二级".$m2->getName());
//             array_push($fsMenu,$m2);
//         }
//         return $fsMenu;
    
//     }
    
}

?>