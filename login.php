<?php
// require_once 'autoload.php';
session_start();
$root = str_replace("\\","/",dirname(__FILE__)."/");
?>
<!DOCTYPE html> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录界面</title>

<link rel="stylesheet" type="text/css" href="Public/css/style.css" />
<link rel="stylesheet" type="text/css" href="Public/css/animate.css" />

<script type="text/javascript" src="Public/js/login.js"></script>
<script type="text/javascript" src="Public/js/jquery.min.js"></script>	  
	  
</head>
 
<body>
	<canvas id="christmasCanvas" style="top: 0px; left: 0px; z-index: 5000; position: fixed; pointer-events: none;" width="1285" height="50%"></canvas>
	<script type="text/javascript">
		 var snow = function() {
	    if(1==1) {
	      $("body").append('<canvas id="christmasCanvas" style="top: 0px; left: 0px; z-index: 5000; position: fixed; pointer-events: none;"></canvas>');
	      var b = document.getElementById("christmasCanvas"), a = b.getContext("2d"), d = window.innerWidth, c = window.innerHeight;
	      b.width = d;
	      b.height = c;
	      for(var e = [], b = 0;b < 70;b++) {
	        e.push({x:Math.random() * d, y:Math.random() * c, r:Math.random() * 4 + 1, d:Math.random() * 70})
	      }
	      var h = 0;
	      window.intervral4Christmas = setInterval(function() {
	        a.clearRect(0, 0, d, c);
	        a.fillStyle = "rgba(255, 255, 255, 0.6)";
	        a.shadowBlur = 5;
	        a.shadowColor = "rgba(255, 255, 255, 0.9)";
	        a.beginPath();
	        for(var b = 0;b < 70;b++) {
	          var f = e[b];
	          a.moveTo(f.x, f.y);
	          a.arc(f.x, f.y, f.r, 0, Math.PI * 2, !0)
	        }
	        a.fill();
	        h += 0.01;
	        for(b = 0;b < 70;b++) {
	          if(f = e[b], f.y += Math.cos(h + f.d) + 1 + f.r / 2, f.x += Math.sin(h) * 2, f.x > d + 5 || f.x < -5 || f.y > c) {
	            e[b] = b % 3 > 0 ? {x:Math.random() * d, y:-10, r:f.r, d:f.d} : Math.sin(h) > 0 ? {x:-5, y:Math.random() * c, r:f.r, d:f.d} : {x:d + 5, y:Math.random() * c, r:f.r, d:f.d}
	          }
	        }
	      }, 70)
	    
	  }
	  snow();
	  $("#bt-login").click(function(){
		    $("#ff")[0].submit(); 
	  });
	  $("#submitzhuce").click(function(){
		    $("#fd")[0].submit(); 
	  });
	</script>
	
	<h2 align="center">登陆界面</h2>
	
	<div class="login_frame"></div>
	
	<div class="LoginWindow">
		<div>
		<form action="http://localhost:8080/thinks/index.php/Home/User/login" method="post" id="ff" >
<!-- 		    <input type="hidden" name="controller" value="UserController"> -->
<!-- 		    <input type="hidden" name="methodName" value="login"> -->
			<div class="login">
				<p><input type="text"  name="userName"id="id" placeholder="用户名" value=""></p>
				<p><input type="password" name="userPass" id="password" placeholder="密码" value=""></p>
				<p class="login-submit"><button type="submit" class="login-button" id ="submit">登录</button></p>
			    <p>
				<?php 
			/* 	if (isset($_SESSION["loginError"])){
				    echo $_SESSION["loginError"];
// 				    session_destroy();
				    unset($_SESSION["loginError"]);
				} */
				?>
			</p>
			</div>
		</form>
		<p class="registration  btn" id="regiest"><a>快速注册</a></p>
		</div>
	</div>
		
	
	<div class="box">
		<div class="regiest">
		<form action="index.php/Application/Home/login" method="post" id="fd" >
		    <input type="hidden" name="controller" value="UserController">
		    <input type="hidden" name="methodName" value="login">
			<p><input type="text" id="userName" name="userName" placeholder="用户名"></p>
			<p><input type="password" name="userPass"  id="password" placeholder="密码" ></p>
			<div id="btn2">
				<ul>
				    <li><a href="javascript:viod(0);">关闭</a></li>
					<li><input type="button" value="关闭" class="colse"/></li>
					<li><input type="submit" value="提交" id="sumbmitzhuce"/></li>
				</ul>
			</div>
		</form>
		</div>
	</div>
	
	<div id="timeArea"><script type="text/javascript">LoadBlogParts();</script></div>
	
	<script type="text/javascript">
	$(function(){
		$(".btn").click(function(){
		var left = ($(window).width()*(1-0.35)) /2;//box弹出框距离左边的额距离
		var height =  ($(window).height()*(1-0.5)) /2;
		
	   $(".box").addClass("animated bounceIn").show().css({left:left,top:top});
	   $(".opacity_bg").css("opacity","0.3").show();
	   });
	  
	  
	   $(".colse").click(function(){
		 
		var left=($(window).width()*(1-0.35))/2;
		var top=($(window).height()*(1-0.5))/2;
		$(".box").show().animate({
			width:"-$(window).width()*0.35",
			height:"-$(window).height()*0.5",
			left:"-"+left+"px",
			top:"-"+top+"px"
			},1000,function(){
				 var width1 = $(window).width()*0.35;
				 var height1 =$(window).height()*0.5;
				 console.log(width1);
				$(this).css({width:width1,height:height1}).hide();
			});
	
	   });
	});
	</script>
	<div style="text-align:center;">
	</div>
</body>
</html>
