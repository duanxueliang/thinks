<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
     <head>
         <title>reg界面</title>
         <meta charset="utf-8"> 	
     </head>
     <body>
     <h2>reg界面--------1---</h2>
     <span><?php echo ($ttt); ?></span>
     <p><?php echo ($arr["1"]); echo ($arr[2]); ?></p>
     <p><?php echo ($arr2["aa"]); echo ($arr2[cc]); ?></p>
     <p><?php echo ($data[0][cid]); ?>-------<?php echo ($data["0"]["name"]); ?>---------<?php echo ($data["0[createTime]"]); ?></p>
     <p><?php echo (md5($str)); ?></p>
     <p><?php echo ($menu->getName()); ?>----------<?php echo ($menu->menuid); ?>------<?php echo ($menu->menuid); ?></p>
     <p><?php echo (substr($str,0,3)); echo (substr($str,0,3)); ?></p>
     <p><?php echo substr($str,0,4);?></p>
     <p><?php echo ($i+$j); ?>----<?php echo ($i-$j); ?>----<?php echo ($i*$j); ?>----<?php echo ($i/$j); ?>----<?php echo ($i%$j); ?>---+++---<?php echo ($i++); ?>----<?php echo ($i++); ?>----<?php echo ++$i;?></p>
     <p><?php echo (md5($str)); ?></p>
     <h1>volist------循环</h1>
     <table id="tab" border='1'>
         <tr>
             <td>编号</td><td>名称</td><td>类型</td><td>创建时间</td><td>开班时间</td>
             <td>班主任</td><td>项目经理</td><td>人数</td><td>备注</td><td>状态</td>
         </tr>
         <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "$msg" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?>第<?php echo ($i); ?>次循环---索引为<?php echo ($key); ?>
         <?php if(($mod) == "0"): ?><tr style="background-color: red;">
				<td><?php echo ($class["cid"]); ?></td><td><?php echo ($class["name"]); ?></td>
				<td><?php echo ($class["classtype"]); ?></td>
				<td><?php echo ($class["createtime"]); ?></td><td><?php echo ($class["begintime"]); ?></td>
				<td><?php echo ($class["headerid"]); ?></td><td><?php echo ($class["manageid"]); ?></td>
				<td><?php echo ($class["stucount"]); ?></td><td><?php echo ($class["remark"]); ?></td>
				<td><?php echo ($class["status"]); ?></td>
				
			</tr><?php endif; ?>
         <?php if(($mod) == "1"): ?><tr style="background-color: green;">
				<td><?php echo ($class["cid"]); ?></td><td><?php echo ($class["name"]); ?></td>
				<td><?php echo ($class["classtype"]); ?></td>
				<td><?php echo ($class["createtime"]); ?></td><td><?php echo ($class["begintime"]); ?></td>
				<td><?php echo ($class["headerid"]); ?></td><td><?php echo ($class["manageid"]); ?></td>
				<td><?php echo ($class["stucount"]); ?></td><td><?php echo ($class["remark"]); ?></td>
				<td><?php echo ($class["status"]); ?></td>
			</tr><?php endif; endforeach; endif; else: echo "$msg" ;endif; ?>
	 </table >
		 <h1>foreach------循环</h1>
		 <hr/>
     <table id="tab" border='1'>
         <tr>
             <td>编号</td><td>名称</td><td>类型</td><td>创建时间</td><td>开班时间</td>
             <td>班主任</td><td>项目经理</td><td>人数</td><td>备注</td><td>状态</td>
         </tr>
     <?php if(is_array($data)): foreach($data as $i=>$class): if(($i%2) == "0"): ?><tr style="background-color: fuchsia;">
			      <td><?php echo ($class["cid"]); ?></td><td><?php echo ($class["name"]); ?></td>
				  <td>
						<?php if($class["classtype"] == 1): ?>常规班
					       <?php elseif($class["classtype"] == 2): ?>
					          falsh班
					       <?php elseif($class["classtype"] == 3): ?>
					          php班
					       <?php else: ?>
					          java班<?php endif; ?>
					    </td>
				  <td><?php echo ($class["createtime"]); ?></td><td><?php echo ($class["begintime"]); ?></td>
				  <td><?php echo ($class["headerid"]); ?></td><td><?php echo ($class["manageid"]); ?></td>
				  <td><?php echo ($class["stucount"]); ?></td><td><?php echo ($class["remark"]); ?></td>
				  <td><?php echo ($class["status"]); ?></td>
				</tr><?php endif; ?>
	         <?php if(($i%2) == "1"): ?><tr style="background-color: blue;">
					<td><?php echo ($class["cid"]); ?></td><td><?php echo ($class["name"]); ?></td>
					<td>
						<?php if($class["classtype"] == 1): ?>常规班
					       <?php elseif($class["classtype"] == 2): ?>
					          falsh班
					       <?php elseif($class["classtype"] == 3): ?>
					          php班
					       <?php else: ?>
					          java班<?php endif; ?>
					    </td>
					<td><?php echo ($class["createtime"]); ?></td><td><?php echo ($class["begintime"]); ?></td>
					<td><?php echo ($class["headerid"]); ?></td><td><?php echo ($class["manageid"]); ?></td>
					<td><?php echo ($class["stucount"]); ?></td><td><?php echo ($class["remark"]); ?></td>
					<td><?php echo ($class["status"]); ?></td>
				</tr><?php endif; endforeach; endif; ?>
     </table>
     <h1>for------循环</h1>
     <hr/>
     <table id="tab" border='1'>
         <tr>
             <td>编号</td><td>名称</td><td>类型</td><td>创建时间</td><td>开班时间</td>
             <td>班主任</td><td>项目经理</td><td>人数</td><td>备注</td><td>状态</td>
         </tr>
         <?php $__FOR_START_25365__=0;$__FOR_END_25365__=$arraylenth;for($i=$__FOR_START_25365__;$i < $__FOR_END_25365__;$i+=1){ ?><!--<for start="$arraylenth-1" end="0" comparison="gt" step="-1" name="i">-->
	           <?php if(($i%2) == "0"): ?><tr style="background-color:gray;">
						<td><?php echo ($data["$i"]["cid"]); ?></td><td><?php echo ($data["$i"]["name"]); ?></td>
						<td>
						<?php if($data.$i["classtype"] == 1): ?>常规班
					       <?php elseif($data.$i["classtype"] == 2): ?>
					          falsh班
					       <?php elseif($data.$i["classtype"] == 3): ?>
					          php班
					       <?php else: ?>
					          java班<?php endif; ?>
					    </td>
						<td><?php echo ($data["$i"]["createtime"]); ?></td><td><?php echo ($data["$i"]["begintime"]); ?></td>
						<td><?php echo ($data["$i"]["headerid"]); ?></td><td><?php echo ($data["$i"]["manageid"]); ?></td>
						<td><?php echo ($data["$i"]["stucount"]); ?></td><td><?php echo ($data["$i"]["remark"]); ?></td>
						<td><?php echo ($data["$i"]["status"]); ?></td>
					</tr><?php endif; ?>
		        <?php if(($i%2) == "1"): ?><tr style="background-color: lime;">
						<td><?php echo ($data["$i"]["cid"]); ?></td><td><?php echo ($data["$i"]["name"]); ?></td>
						<td>
						<?php if($data.$i["classtype"] == 1): ?>常规班
					       <?php elseif($data.$i[classtype] == 2): ?>
					          falsh班
					       <?php elseif($data.$i["classtype"] == 3): ?>
					          php班
					       <?php else: ?>
					          java班<?php endif; ?>
					    </td>
						<td><?php echo ($data["$i"]["createtime"]); ?></td><td><?php echo ($data["$i"]["begintime"]); ?></td>
						<td><?php echo ($data["$i"]["headerid"]); ?></td><td><?php echo ($data["$i"]["manageid"]); ?></td>
						<td><?php echo ($data["$i"]["stucount"]); ?></td><td><?php echo ($data["$i"]["remark"]); ?></td>
						<td><?php echo ($data["$i"]["status"]); ?></td>
					</tr><?php endif; } ?>
       </table>
       <?php switch($j): case "1": ?>重庆<?php break;?>
           <?php case "2": ?>四川<?php break;?> 
           <?php case "3": ?>广州<?php break;?> 
           <?php case "4": ?>湖南<?php break;?>  
           <?php case "5": ?>湖北<?php break;?>
           <default>
                                    中 国
           </default><?php endswitch;?>
       <hr/>
       <?php if($j > 5): ?>你好
       <?php elseif($j > 2): ?>
          nihao
       <?php else: ?>
          hello<?php endif; ?>
       <br/><br/><br/>
     </body>
</html>