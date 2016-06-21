<?php
namespace Home\Controller;
use Home\Model\MenuModel;
use Home\Model\UserModel;
use Think\Controller;

class UserController extends Controller{
    private $userModel;
    private $menuModel;
    private $userModel2;
    public function __construct(){
        parent::__construct();
        $this->userModel= new UserModel();
        $this->menuModel= new MenuModel();
        $this->userModel2= M("tb_user","",C("DB_DSN"));
    }
    public function test(){
        echo "home控制器";
    }
    public function login(){
     $userName =$_POST["userName"];
        $userPass =$_POST["userPass"];
        $i = $this->userModel->login($userName,$userPass);
        if ($i == 1){
            //登录成功
            $user  = $this->userModel->loadUserByName($userName);
            $_SESSION["loginUser"] = $user;
            $uid = $_SESSION['loginUser'][0];
            $secondMenu =$this->menuModel->loadTreeMenu($uid);
            $_SESSION["secondMenu"] = $secondMenu;
            header("location:http://localhost:8080/thinks/welcome.php");
        }elseif ($i == 2){
            //用户名错误
            $_SESSION["loginError"]= "用户名不存在";
            header("location:http://localhost:8080/thinks/login.php");
        }else{
            $_SESSION["loginError"]= "密码错误";
            header("location:http://localhost:8080/thinks/login.php");
        }
        
    }
    /**
     * 查询班主任回填下拉列表
     */
    public function loadAllHeader(){
        $options= array(array("uid"=>-1,"truename"=>"请指定合并后班主任名称"));
        $data = $this->userModel2->field("uid,trueName")->where("useType=2")->select();
        foreach($data as $d){
            array_push($options,$d);
        }
//         print_r($options);
//         exit();
        $this->ajaxReturn($options);
        
    }   
    /**
     * 查询班主任回填下拉列表
     */
    public function loadAllManage(){
        $options= array(array("uid"=>-1,"truename"=>"请指定合并后项目经理名称"));
        $data = $this->userModel2->field("uid,trueName")->where("useType=3")->select();
        foreach($data as $d){
            array_push($options,$d);
        }
        $this->ajaxReturn($options);
    
    }
}

?>