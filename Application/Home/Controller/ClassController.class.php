<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
use Home\entity\Menu;
class ClassController extends Controller{
    private $classModel;
//     const DB_DSN="mysql://root:892832@localhost:3306/syc#utf8";
//     self::DB_DSN
    public  function __construct(){
        parent::__construct();
        //直接实例化Model类，用来完成简单的怎删改查操作
        $this->classModel =new Model("class","",C("DB_DSN"));//M("class");
    }
    public function loadAllClass(){
//         $param['cid'] =2;
        $param['cid'] =array('EQ',1);//cid>1
        //使用预处理机制增加安全性 降低内存消耗  提升查询效率  （推荐使用）
//         $data = $this->classModel->field("cid,name,createTime")->where("cid>%d",1)->select();
//         $data = $this->classModel->field("cid,name,createTime")->where("cid>%d",array(1))->select();
//         $data = $this->classModel->field("cid,name,createTime")->where("cid<:cid")->bind(":cid",2)->select();
        $data = $this->classModel->field("cid,name,createTime")->where($param)->select();
        //多表查询中使用（有列名称相同的的情况下  要给列写列别名）
//         $data = $this->classModel->field("u.trueName,p.name pname,c.name cname")
//         ->table("tb_user u,provice p,city c")
//         ->where("u.pid=p.pid and u.cid=c.cid")
//         ->select();
       //分页查询
//        $data = $this->classModel->table("tb_user")->limit(0,2)->select();
       //page()分页查询
//        $data = $this->classModel->table("tb_user")->page(1,10)->select();
    
//         $this->classModel->where('uage=12')->limit(5)->save(array('upwd'=>'111'));
//分组
//having 聚合函数
//        $this->classModel->field("uage,count(*) num")->group("uage")->having("count(*)>2")->select();
        print_r($data);
    }
    public function reg(){
        //向表里面添加数据   用create()函数会自动创建一个stdClass类
//         $data = array("name"=>"u21");
//         $this->classModel->create($data);
//         $this->classModel->field("name")->add();
//         $this->display();//查找默认的模板展示
//         $this->display("index");//查找另一个模板展示
//            $this->display("User:user");//跨目录查找
        //保存索引数组
        $this->assign("ttt","hello");
        $arr = array(123,"中国",hhh);
        $this->assign("arr",$arr);
        //保存关联数组
        $arr2 = array("aa"=>123,"bb"=>"中国","cc"=>ddhh);
        
        $this->assign("arr2",$arr2);
        //保存二维数组
        $data= $this->classModel->field("")->select();
//         print_r($data);
//         exit();
        $this->assign("msg","<p style='color:red;'>no data!!</p>");
        $this->assign("arraylenth",count($data));
        $this->assign("data",$data);
        
        //保存对象
//         $menu= new Menu();
        $menu =Menu::getInsall(1,"aaa","aa.html",1,1);
//         print_r($menu);
        $this->assign("menu",$menu);
//         $ug= $_SERVER["HTTP_USER_AGENT"];
//         $this->assign("ug",$ug);
        //演示使用函数
        $this->assign("i",2);
        $this->assign("j",3);
        $this->assign("str","abcdefg");
        $this->display("index");//跨目录查找
    }
    /**
     * $data =array("trueName"=>"sss");
     * $this->classModel->where("uid=2")->save($data);
     * $data =array("trueName"=>"sss");
     * $this->classModel->data($data)->where('uid=2')->save()
     */
    public function classmanage(){
        $this->display();
    }
    public function loadClassByPage($pageNo=1,$pageSize=10,$className=null, $createtime1=null,
        $createtime2=null,$headerName=null,$begintime1=null,$begintime2=null,$manageName=null,
        $endtime1=null,$endtime2=null,$status=-1){
        $sql = " from class c,tb_user u1,tb_user u2 where c.headerid=u1.uid and u2.uid=c.manageid ";
        //第一行
        if (null != $className){
            $sql .= " and c.name like '%$className%'";
        }
        if(null != $createtime1){
            $sql .= " and c.createTime >= '".$createtime1."'";
        }
        if(null != $createtime2){
            $sql .= " and c.createTime <= '".$createtime2."'";
        }
        
        //第二行
        if (null != $headerName){
            $sql .= " and u1.trueName like '%$headerName%'";
        }
        if(null != $begintime1){
            $sql .= " and c.beninTime >= '".$begintime1."'";
        }
        if(null != $begintime2){
            $sql .= " and c.beninTime <= '".$begintime2."'";
        }
        
        //第三行
        if (null != $manageName){
            $sql .= " and u2.trueName like '%$manageName%'";
        }
        if(null != $endtime1){
            $sql .= " and c.endTime >= '".$endtime1."'";
        }
        if(null != $endtime2){
            $sql .= " and c.endTime <= '".$endtime2."'";
        }
        
        //状态
        if($status > 0){
            $sql .= " and c.status = $status";
        }
        
        $count = $this->classModel->query("select count(*) as cc".$sql)[0]["cc"];
        $page["total"] = $count;
        
        $begin = ($pageNo-1)*$pageSize;
        $rows = $this->classModel->query("select c.cid,c.name,c.classtype,
            c.createtime,c.begintime,c.endtime,u1.truename headername,
            u2.trueName managename,c.stucount,c.remark,c.status".$sql." limit $begin,$pageSize");
        $page["rows"] = $rows;
        
        $this->ajaxReturn($page);
    }
    /**
     * 检查所选班级今天是否有考试
     * @param unknown $cids   参数绑定  参数格式为1,2,3
     */
    public function checkExamToday($cids=null){
        $d =date("Y-m-d");
        $db =$d." 00:00:00";
        $de =$d." 23:59:59";
        $data = $this->classModel->table("exam")->where("classid in($cids) and beginTime between '$db' and '$de'")->select();
//         echo $this->classModel->table("exam")->where("classid in($cids) and beginTime between '$db' and '$de'")->fetchSql(true)->select();
//         exit();
        if (count($data)>0){
            //获取到今天有考试的班级id   用于提示信息
            $classids =array();
            foreach ($data as $exam){
               array_push($classids,$exam["classid"]);
            }
            $str = implode(",", $classids);
//             echo $str;
            //查询今天有考试的班级名称
            $cnames = $this->classModel->field("name")->where("cid in($str)")->select();
            //存放今天有考试的班级名称 数组
            $names =array();
            foreach ($cnames as $n){
                array_push($names,$n["name"]);
            }
            $str1 = implode(",",$names);
//             echo $str1;
            $this->ajaxReturn("对不起,".$str1."今天有考试","EVAL");
//             print_r($cnames);
//             print_r($classids);
        }else{
            $this->ajaxReturn("ok","EVAL");
        }
//         $sql ="select * from exam where cid in($cids) and beginTime between $db and $de";
        
    }
    /**
     * 要合并的参数绑定  格式为 1,2,3
     * @param unknown $cids 班级id
     * @param unknown $combinedClassid  
     * @param unknown $combinedHeaderid   该班的班主任id
     * @param unknown $combinedManageid   该班的项目经理id
     */
    public function hebingClass($cids=null,$combinedClassid=-1,$combinedHeaderid=-1,$combinedManageid=-1){
        try {
            //关闭自动提交
            $this->classModel->setProperty(\PDO::ATTR_AUTOCOMMIT, false);
            
            $this->classModel->startTrans();//开启事务
           
            //我们选中的要进行合并的班级   返回的是一个二维数组
            $calsses = $this->classModel->table("class")->where("cid in($cids)")->select();
            $totalCount =0;
//             $str =array();
            foreach ($calsses as $c){
                if ($c["cid"] == $combinedClassid){
                    //要保留的班级
//                     $c["headerid"]=$combinedHeaderid;
//                     $c["manageid"]=$combinedManageid;
//                     $this->classModel->save($c);
                }else {
                    //不保留的班级
                    //定义一个变量累计我们不需要保留的班级的人数
                    $totalCount += $c["stucount"];
                    //将不需要保留的班级人数清空
                    $c["stucount"] =0;
                    //将不需要保留的班级状态改为  被合并（3）
                    $c["status"] =3;
                    //执行更改语句
                    $this->classModel->save($c);
//                     array_push($str,$c["cid"]);
                    //修改在用户表中对应的学生 属于我们选中的那个班级
                    $sql ="update tb_user set classid=%d  where classid=%d";
                    $this->classModel->execute($sql,$combinedClassid,$c["cid"]);
//                     $this->classModel->table("tb_user")->where("classid=%d",$c["cid"])
                }
                
            }
            
//             $str = implode(",", $str);
//             $sql ="update tb_user set classid=%d  where classid in($str)";
//             $this->classModel->execute($sql,$combinedClassid,$c["cid"]);
            
            //查询合并后要保留的班级信息
            //返回单行数据   指定我们要改的那个班级
            $combinedClass = $this->classModel->table("class")->where("cid=%d",$combinedClassid)->find();
            $combinedClass["headerid"]=$combinedHeaderid;
            $combinedClass["manageid"]=$combinedManageid;
            $combinedClass["stucount"] +=$totalCount;
            $this->classModel->save($combinedClass);
            
            $this->classModel->commit();//提交事务
        }catch(\Exception $e){
            $this->classModel->rollback();//事务回滚
        }
        $this->loadClassByPage();
    }
}

?>