<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {
    public function index($username="nihao",$userpass=""){
        echo $username."--------".$userpass."<br/>";
        echo $_GET["eason"]."----".$_GET["value"];
        echo "<br/>";
        echo "<h1>╔╬╗</h1>";
        echo "<h1>╚╩╝</h1>";
        echo "<h1>▓※☆☆♪eason ★★※▓</h1>";
//         $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
    public function test(){
//        echo I("param.year")."-".I("param.month")."-".I("param.date");
//        echo $_GET["year"]."~".$_GET["month"]."~".$_GET["date"];
//        echo I("request.year")."/".I("request.month")."/".I("request.date");
//        echo I("path.1")."/".I("path.2")."/".I("path.3");   
//        echo I("get.year")."/".I("get.month")."/".I("get.date");
//        redirect("http://localhost:8080/thinks/index.php/Home/index/empyt");
       redirect("http://www.baidu.com");
    }
    public function empyt(){
        echo "页面不存在";
    }
    
}