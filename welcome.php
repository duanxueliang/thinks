<?php 
session_start();
?>
<!DOCTYPE html>
<html>
     <head>
          <title>easy</title>
          <meta charset="utf-8"> 
          <link type="text/css" rel="stylesheet" href="Public/easyui/themes/bootstrap/easyui.css"/>
          <link type="text/css" rel="stylesheet" href="Public/easyui/themes/icon.css"/>	
          <script type="text/javascript" src="Public/easyui/jquery.min.js"></script>
          <script type="text/javascript" src="Public/easyui/jquery.easyui.min.js"></script>
          <script type="text/javascript" src="Public/easyui/locale/easyui-lang-zh_CN.js"></script>
		  <style type="text/css">
		    li{
		    	list-style: none;
		    }
			.first{
				width: 180px;
				height: 30px;
				background-image: url(Public/images/2.jpg);
				background-position: 0 -63px;
				background-repeat: no-repeat;
				padding-top: 10px;
			}
			.second{
				margin-top: 10px;
				width: 180px;
				/*background-image: url(Public/images/2.jpg);
				background-position: 0px -168px;
				background-repeat: no-repeat;*/
				display: none;
			}
			span{
				margin-left: 20px;
			} 
			.second li{
				margin-left: -40px;
				height: 28px;
				padding-top: 5px;
				background-image:url(Public/images/1.jpg);
				background-position: 0px 0px;
				background-repeat: no-repeat;
			}
			.second a{
				text-decoration: none;
				margin-left: 70px;
				color: cornflowerblue;
			}
			.second a:hover{
				text-decoration: underline;
			}
			#aaa{
/* 	          background-image:url("images/1.jpg"); */
				background-image: url("Public/images/2.jpg");
			}
		</style>
		  <script type="text/javascript" >
          $(function(){
//                $("#tabs").tabs({
//                    fit:true; 
//                })
        	  $(".first").click(function(){
					if($(this).attr("exanpt")=="true"){
						//收缩
						$(this).css("background-position"," 0 -63px");
						$(this).find(".second").slideUp(500).fadeOut(500).hide();
						$(this).height("30px")
						$(this).attr("exanpt","false");
					}else{
						//展开
						//改变背景图定位
						$(this).css("background-position"," 0 -23px");
						//展示下拉菜单
						var h=parseInt($(this).height());
						var h2=$(this).find("li").size()*33;
						$(this).height((h+h2)+"px");
						$(this).find(".second").slideDown(500).fadeIn("fast").show();
						//改变为true
						$(this).attr("exanpt","true");
					}
					
				});
          });
          function addTabs(url,name){
        	 if($('#tabs').tabs("exists",name)){
            	 //如果当前选项卡已经存在   则选中它
            	 $('#tabs').tabs("select",name);
             }else{
               // 添加一个未选中的选项卡面板
        	   $('#tabs').tabs('add',{
               		title: name,
               		selected: true,
               		closable:true,
               		content:"<iframe name='"+name+"' src='"+url+"' width='100%' height='100%' frameborder='0'  scrolling='no' > </iframe> "
           	   }); 
             }         
          }
		  </script>
     </head>
     
    <body class="easyui-layout"> 
        <div><img alt="" src="Public/images/33.png" style="margin-top: 30px; margin-left: 40px;" width="90px" height="90px">
        <img alt="" src="Public/images/22.gif" style="margin-top: 30px; margin-left: 5px;" width="90px" height="90px">
        <span style="font-size: 30px;color:black;">传媒职业学院OA系统</span>
        </div>
        <div data-options="region:'north',title:'栏目',split:true" style="height:120px; margin-left:1200px;">
			    <div style="margin-top:20px; font-size:16px; color:#03458f;">
			    
			       <?php 
			       if (array_key_exists("loginUser",$_SESSION)){
// 			           switch ($_SESSION['loginUser'][3]){
// 			               case 1: "管理员"  break ;
// 			           }
			         echo "欢迎你！".$_SESSION['loginUser'][4];
			         if ($_SESSION['loginUser'][3]==1){
			             echo "(管理员)";
			         }elseif ($_SESSION['loginUser'][3]==2){
			             echo "(班主任)";
			         }elseif ($_SESSION['loginUser'][3]==3){
			             echo "(项目经理)";
			         }else {
			             echo "(学员)";
			         }
			         echo  "<a href='index.php' style='font-size:15px;margin-left:30px; color:red;'>退出登录</a>";
			       }
			       else{
                        echo "<a  href='index.php' >登录进入 </a>";
                        echo "<a  href='zc.php' style='margin-left:18px; color:red;'>立即注册</a>";
			       }?>
			       
			   </div>    
        </div> 
       
        <div data-options="region:'west',title:'菜单',split:true" style="width:240px;">
            <div id="left">
            <ul> 
                <?php 
                if (array_key_exists("secondMenu",$_SESSION)){
                    $secondMenu =$_SESSION["secondMenu"];
                    foreach ($secondMenu as $menu2){
                        echo "<li class='first' exanpt='false'><span>{$menu2[1]}</span><ul class='second'>";  
                            foreach ($menu2[5] as $menu3){
                            echo "<li><span><a href=\"Javascript:addTabs('{$menu3[2]}','{$menu3[1]}');\">{$menu3[1]}</a></span></li>";
                        }                        
                        echo "</ul>";
                        echo "</li>";
                    }
                }
//                 ?>
                
            </ul> 
          </div>
        </div>   
        <div data-options="region:'center'" style="padding:5px;background:#eee;">
            
            <div id="tabs" class="easyui-tabs" style="width:500px;height:250px;" data-options="fit:true">   
                <div title="欢迎你" style="padding:20px;" data-options="closable:true">   
                   <img alt="" src="images/00.png">
                </div>   
            </div> 
        </div>   
    </body>
</html>