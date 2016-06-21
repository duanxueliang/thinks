<?php
namespace Home\Model;

use Home\util\DButil;
class UserModel{
        private $dbUtil;
    
        public function __construct(){
            $this->dbUtil = new DButil();
        }
        public function login($userName,$userPass){
            $sql = "select * from tb_user where useName=?";
            //查询一级菜单   只有一个
            $datas = $this->dbUtil->executeQuery($sql,array($userName));
            if (count($datas)==1){
                if ($userPass == $datas[0][2]){
                    return 1;   //登录成功
                }else{
                    return 3;    //密码错误
                }
            }else{
                return 2;   //用户名不存在
            }
        }
        //     public function saveAndUpdataMenu($useName,$usePass,$useType,$trueName,
        //         $sex,$birthDay,$phone,$school,$education,$workYear,$regTime,$status,$pid,$cid,$address,$uid){
        //             $b = true;
        //             if ($uid == 0){
        //                 $sql = "insert into tb_user(useName,usePass,useType,trueName,sex,birthDay,phone,
        //                     school,education,workYear,regTime,status,pid,cid,address) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        //                 $b = $this->dbUtil->executeDML($sql,array($useName,$usePass,$useType,$trueName,
        //                     $sex,$birthDay,$phone,$school,$education,$workYear,$regTime,$status,$pid,$cid,$address));
        //             }elseif($uid >0){
        //                 $sql = "update tb_user set useName=?,usePass=?,useType=?,trueName=?,sex=?,birthDay=?,phone=?,school=?,education=?,workYear=?
        //                     ,regTime=?,status=?,pid=?,cid=?,address=? where uid=?";
        // //                 $str =date(Y-m-d H-i-s);
        //                 $b = $this->dbUtil->executeDML($sql,array($useName,$usePass,$useType,$trueName,
        //                     $sex,$birthDay,$phone,$school,$education,$workYear,$regTime,$status,$pid,$cid,$address,$uid));
        //             }
        //             return $b;
        //     }
        //     public function loadPageSubQuery($pageNo,$pageSize){
        //         $sql1 = "select t.useName,t.usePass,t.useType,t.trueName,t.sex,t.birthDay,t.phone,
        //      t.school,t.education,t.workYear,t.regTime,t.status,(select  p.name  from provice p where  p.pid=t.pid) as pid,
        //      (select  c.name  from city c,provice p where  c.cid=t.cid and p.pid=c.pid) as cid,t.address from tb_user t  limit ?,?";
        //         $sql2 = "select count(*) from tb_user";
        //         $page = $this->dbUtil->executePageSubQuery($sql1,$sql2,$pageNo,$pageSize,null,\PDO::FETCH_OBJ,'entity\Tb_user');
        //         return $page;
        //     }
    
    
    
        //     public function loadMenuByID($uid){
        //         $sql = "select * from tb_user where uid=?";
        //         $menu = $this->dbUtil->executeQuery($sql,array($uid),\PDO::FETCH_OBJ,'entity\Tb_user');
        //         $menu1 = $menu[0];
        //         return $menu1;
        //     }
        //     public function deleteMenu($uids){
        //         $sql = "delete from tb_user where uid=$uids";
        //         $menu  = $this->dbUtil->executeDML($sql,array($uids));
        //         return $menu;
        //     }
    
    
        public function loadUserByName($userName){
            $sql = "select * from tb_user where useName=?";
            $datas =  $this->dbUtil->executeQuery($sql,array($userName));
            if (count($datas) == 1){
                return $datas[0];
            }else{
                return null;
            }
        }
    
        public function loadMenuByPage($pageNo,$pageSize){
    
            $sql = "select * from tb_user limit ?,?";
            $page = $this->dbUtil->executePageQuery($sql,$pageNo, $pageSize,null,$fetchStyle=\PDO::FETCH_OBJ,'entity\Tb_user');
            return  $page;
        }
    
        /**
         * 分页查询菜单列表
         * @param unknown $pageNo
         * @param unknown $pageSize
         * @return
         */
        public function loadUserByPage($pageNo,$pageSize){
            $datasql = "select t.uid,t.useName,t.usePass,t.useType,t.trueName,t.sex,t.birthDay,t.phone,t.school,
           t.workYear,t.regTime,t.status,
           (select p.name from provice p where p.pid=t.pid) pname,
           (select c.name from city c where c.cid=t.cid) cname,t.address
           from tb_user t limit ?,?";
            $countsql = "select count(*) from tb_user";
            $page = $this->dbUtil->executePageSubQuery($datasql,$countsql, $pageNo, $pageSize,null,\PDO::FETCH_ASSOC);
            return $page;
        }
    
    
        public function loadByIdUser($uid){
            $sql = "select * from tb_user where uid=?";
            $user2 = $this->dbUtil->executeQuery($sql,array($uid),\PDO::FETCH_OBJ,'entity\Tb_user');
            $user1 = $user2[0];
            return $user1;
        }
         
        /**
         * 增加与修改
         *
         * @param unknown $name
         * @param unknown $url
         * @param unknown $parentid
         * @param unknown $isshow
         * @param unknown $menuid
         */
        public function addOrUpdateUser($useName,$usePass,$useType,$trueName,$sex,$birthDay,$phone,$school,$education,$workYear,$status,$pid,$cid,$address,$uid){
            if ($uid == 0){
                $sql = "insert into tb_user(useName,usePass,useType,trueName,sex,birthDay,phone,school,education,workYear,status,pid,cid,address) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $user2 = $this->dbUtil->executeDML($sql,array($useName,$usePass,$useType,$trueName,$sex,$birthDay,$phone,$school,$education,$workYear,$status,$pid,$cid,$address));
                return $user2;
            }else if($uid > 0){
                $sql = "update tb_user set useName=?,usePass=?,useType=?,trueName=?,sex=?,birthDay=?,phone=?,school=?,education=?,workYear=?,status=?,pid=?,cid=?,address=? where uid=?";
                $user2 = $this->dbUtil->executeDML($sql,array($useName,$usePass,$useType,$trueName,$sex,$birthDay,$phone,$school,$education,$workYear,$status,$pid,$cid,$address,$uid));
                return $user2;
            }
             
        }
        /**
         * 删除菜单
         */
        public function deleteUser($uids){
            $sql = "delete from tb_user where uid in($uids)";
            $user1 = $this->dbUtil->executeDML($sql);
        }
    
 
}

?>