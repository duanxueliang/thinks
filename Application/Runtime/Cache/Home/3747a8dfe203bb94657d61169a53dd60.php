<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
     <head>
         <title>菜单管理界面</title>
         <link type="text/css" rel="stylesheet" href="http://localhost:8080/thinks/Public/easyui/themes/bootstrap/easyui.css"/>
          <link type="text/css" rel="stylesheet" href="http://localhost:8080/thinks/Public/easyui/themes/icon.css"/>	
          <script type="text/javascript" src="http://localhost:8080/thinks/Public/easyui/jquery.min.js"></script>
          <script type="text/javascript" src="http://localhost:8080/thinks/Public/easyui/jquery.easyui.min.js"></script>
          <script type="text/javascript" src="http://localhost:8080/thinks/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
         <meta charset="utf-8"> 
         <style type="text/css">
            #formtable tr{
	         height:30px;
             } 
             #dd{
             	margin-top: 40px;
	            margin-left: 80px;
             }
             .in{
	            width:200px;
             } 
             .tt{
               width:250px;
               margin-top: 20px;
	           margin-left: 50px;
             }
         </style>
         <script type="text/javascript" >
          $(function(){
        	  $('#win').window('close');  // close a window  
        	  $('#dg').datagrid({   
        		method:"GET", 
      		    url:'http://localhost:8080/thinks/index.php/Home/Class/loadClassByPage?pageNo=1&pageSize=10',
//         		url:'../test.php',
        		pagination:true,
        		striped:true,
        		rownumbers:true,
        		frozenColumns:[[
        		      {field:'afgfda',checkbox:true}
            		]],
      		    columns:[[  
      		        {field:'cid',hidden:true},     
      		        {field:'name',title:'班级名称',width:100,align:'center'},    
      		        {field:'classtype',title:'班级类型',width:100,align:'center'}, 
        		    {field:'createtime',title:'创建时间',width:200,align:'center'},
        		    {field:'begintime',title:'开班时间',width:200,align:'center'},    
        		    {field:'endtime',title:'毕业时间',width:200,align:'center'},
        		    {field:'headername',title:'班主任',width:100,align:'center'},    
      		        {field:'managename',title:'项目经理',width:100,align:'center'}, 
        		    {field:'stucount',title:'班级人数',width:100,align:'center'},    
      		        {field:'remark',title:'备注',width:100,align:'center'}, 
      		        {field:'status',title:'状态',width:100,align:'center',
        		         formatter:function(status){if(status == 1){return "<a href='rolemanage.php'>正常</a>";}else if(status ==2){return "被合并";}else{
        	      		         return "结业";}
            		     }} 
      		    ]],
        		toolbar:"#tb"
      		});
      		//设置翻页功能
      		var pager = $("#dg").datagrid("getPager");
      		pager.pagination({
      			onSelectPage:function(pageNumber, pageSize){
      				refreshData(pageNumber, pageSize);
      			}
      		});
      	  });	
         //改变和设置值的函数
         function searchClass(){
        	 $.post('http://localhost:8080/thinks/index.php/Home/Class/loadClassByPage',{
        		 'pageNo'     :1,
        		 'pageSize'   :10,
            	 'className'  :$("#search-className").val(),
            	 'createtime1':$("#search-createtime1").combo("getValue"),
            	 'createtime2':$("#search-createtime2").combo("getValue"),
            	 'headerName' :$("#search-headerName").val(),
            	 'begintime1' :$("#search-begintime1").combo("getValue"),
            	 'begintime2' :$("#search-begintime2").combo("getValue"),
            	 'manageName' :$("#search-manageName").val(),
            	 'endtime1'   :$("#search-endtime1").combo("getValue"),
            	 'endtime2'   :$("#search-endtime2").combo("getValue"),
            	 'status'     :$("#search-status").combo("getValue")
             },function(data){
            	 $("#dg").datagrid('loadData',{
                     rows:data.rows,
                     total:data.total
                 });
             },"json");
         }
         //班级合并
         //一：至少选择两个班级进行合并   二：所选班级状态必须为正常  三：所选班级今天不能有考试
         //
         function combineClass(){
        	 var selectedRows = $("#dg").datagrid("getSelections");
        	 if(selectedRows.length < 2){
                    alert("至少选中两个班级才能进行合并！！！");
                    return;
             }
        	 var b =true;
        	 for(var i=0;i<selectedRows.length;i++){
        		 if(selectedRows[i].status != 1){
        			 b=false;
        			 break;
        		 }
        		 if(!b){
        			 alert("所选班级状态必须为正常");
        		 }
        	 }
       		 //获取已选中的班级id
       		 var cids =new Array();
       		 //var options ="<option value='-1'>请指定合并后的班级名称</option>";
       		 var options = new Array();
       		 options.push({'name':'请指定合并后的班级名称','cid':'-1'});
       		 for(var i=0;i<selectedRows.length;i++){
       			 cids.push(selectedRows[i].cid);
       			 options.push({'name':selectedRows[i].name,'cid':selectedRows[i].cid});
       		 }
       		 $.post('http://localhost:8080/thinks/index.php/Home/Class/checkExamToday',{'cids':cids.join(",")},function(data){
               	 if(data =="ok"){
               		 //根据已选中的班级
               		 //$("#combinedClassName").append(options);
               		 $("#combinedClassid").combobox({
               		     valueField:'cid',
               		     textField:'name',
               		     data:options,
               		     value:'-1'
               		 });
               		 //ajak加载loadAllHeader
               		 $('#combinedHeaderid').combobox({    
                   		    url:'http://localhost:8080/thinks/index.php/Home/User/loadAllHeader',    
                   		    valueField:'uid',    
                   		    textField:'truename',
               		        value:'-1'   
                 		 }); 
               		 $('#combinedManageid').combobox({    
                   		    url:'http://localhost:8080/thinks/index.php/Home/User/loadAllManage',    
                   		    valueField:'uid',    
                   		    textField:'truename',
                  		        value:'-1'
                  		 });
               		 //打开合并的窗口表单界面
               		 $('#win').window('open'); 
               	 }else{
               		 alert(data); 
               	 }
                },"text");
         }
         function hebingClass(){
        	 var selectedRows = $("#dg").datagrid("getSelections");
        	//获取已选中的班级id
       		 var cids =new Array();
       		 //var options ="<option value='-1'>请指定合并后的班级名称</option>";
       		 for(var i=0;i<selectedRows.length;i++){
       			 cids.push(selectedRows[i].cid);
       		 }
        	 $.post("http://localhost:8080/thinks/index.php/Home/Class/hebingClass",{
        		'cids':cids.join(","),
        		'combinedClassid':$("#combinedClassid").combo("getValue"),
        		'combinedHeaderid':$("#combinedHeaderid").combo("getValue"),
        		'combinedManageid':$("#combinedManageid").combo("getValue")
        	 },function(data){
        		 $('#win').window('close');
        		 alert("班级合并成功");
        		 $("#dg").datagrid('loadData',{
                     rows:data.rows,
                     total:data.total
                 });
        	 },"json");
         }
		 </script>	
     </head>
     <body>
        <table id="dg"></table>
        <div id="tb">
            <form id="searchFrom" action="" >
	            <table>
	                <tr>
	                    <td>
	                        <label>班级查询</label>
	                        <input type="text" id="search-className" class="easyui-validatebox" placeholder="请输入班级"  />
	                    </td>
	                    <td >
	                        <label>创建时间</label>
			                <input type="text"  class="easyui-datebox" id="search-createtime1" />
			                <label>至</label>
			                <input type="text"  class="easyui-datebox" id="search-createtime2" />
	                    </td>
	                </tr>
	                <tr>
	                    <td>
	                        <label>班主任</label >
	                        <input type="text" id="search-headerName" class="easyui-validatebox" placeholder="请输入班主任" />
	                    </td>
	                    <td>
	                         <label>开班时间</label>
			                 <input type="text"  class="easyui-datebox"  id="search-begintime1"/>
			                 <label>至</label>
			                 <input type="text"  class="easyui-datebox"  id="search-begintime2"/>
	                    </td>
	                </tr>
	                <tr>
	                    <td>
	                        <label>项目经理</label>
	                        <input type="text" id="search-manageName" class="easyui-validatebox" placeholder="请输入项目经理" />
	                    </td>
	                    <td>
	                         <label>结业时间</label>
			                 <input type="text"  class="easyui-datebox" id="search-endtime1" />
			                 <label>至</label>
			                 <input type="text"  class="easyui-datebox"  id="search-endtime2"/>
	                    </td>
	                </tr>
	                <tr>
	                    <td>
	                        <label>状态：</label>
			                <select class="easyui-combobox" id="search-status" >   
			                     <option value="1">正常</option>   
			                     <option value="2">被合并</option>
			                     <option value="3">结业</option>      
			                </select>
			            </td> 
			            <td>
			                <a id="btn" href="javascript:searchClass();" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true">搜索</a>
			                <a id="btn" href="javascript:combineClass();" class="easyui-linkbutton" data-options="iconCls:'icon-edit',plain:true">合并</a>  
			            </td> 
	                </tr>
	            </table>
            </form>
        </div>
        <div id="win" class="easyui-window" title="合并班级" style="width:600px;height:400px"   
                data-options="iconCls:'icon-adduser',modal:true,minimizable:false">   
            <form id="ff" action="post" >
            <div id="dd">
	            <table style="text-align: center;">
	                <tr class="tt" style="height: 50px;">
	                    <td>
	                        <label for="combinedClassid" >合并后班级名称</label>
	                    </td>
	                    <td>
	                        <select class="easyui-combobox in" id="combinedClassid" >   
			                </select>
	                    </td>
	                </tr >
	                <tr class="tt" style="height: 50px;">
	                    <td>
	                        <label for="combinedHeaderid">合并后班主任名称</label>
	                    </td>
	                    <td>
	                        <select class="easyui-combobox in" id="combinedHeaderid" >   
			                </select>
	                    </td>
	               
	                <tr class="tt" style="height: 50px;">
	                    <td>
	                        <label for="combinedManageid">合并后班项目经理名称</label>
	                    </td>
	                    <td> 
	                        <select class="easyui-combobox in" id="combinedManageid" >   
			                </select>
	                    </td>
	                </tr>
	                <tr class="tt" style="height: 50px;">
	                    <td colspan="2">
			                <a id="btn" href="javascript:hebingClass();" class="easyui-linkbutton" data-options="iconCls:'icon-search'">合并</a>
			            </td> 
	                </tr>
	            </table>
	        </div>
            </form>
        </div>  

        
     </body>
</html>