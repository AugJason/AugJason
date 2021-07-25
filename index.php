<html>
	<head>
		<meta charset='utf8' />
		<title>用户管理系统</title>
	</head>
	<body>

		<?php include('head.php'); ?>
		</br>
			<form method='GET' action='index1.php'>
				<a href='add.php'><input type='button' value='添加用户' style='color:green;align:left;' /></a>
				</br></br>
				姓名:<input type='text' size='8' name='name' value='<?php 
				error_reporting('E_ALL&~E_NOTICE');
				echo $_GET['name']; ?>' />
			<!--	性别:<input type='radio'  name='sex'  value='m'/> 男
				<input type='radio'  name='sex' value='w' /> 女 -->
				年龄:<input type='text' size='8' name='age' value='' />
			<!--	邮箱:<input type='text' size='8' name='email'  /> -->
				<input type='submit' value='检索' />
				<input type='button' value='全部信息' onclick="window.location='index.php' " />
			</form>
		
			<table border='1' width='800' >
				<caption style="background-color:green;">用户基本信息<caption>
				<tr align='center'>
				<td>用户ID</td>
				<td>用户姓名</td>
				<td>用户性别</td>
				<td>用户年龄</td>
				<td>用户邮箱</td>
				<td>注册时间</td>
				<td>操作</td>
				</tr >
				<?PHP 							
				//进行搜索
				//error_reporting('E_ALL&~E_NOTICE');
/* 				$ss = array();
				if(!empty($_GET['name'])){
					$ss[]="name like '%{$_GET['name']}%'";
					$urllist[]="author={$_GET['author']}";
				}
				if(!empty($_GET['age'])){
					$ss[]="age like '%{$_GET['age']}%'";
					$urllist[]="age={$_GET['age']}";
				}
				if(count($ss>0)){
					$where = " where " .implode(" and ",$ss);
					$url = "&".implode("&",$urllist);
				}
				 */
										
				
				require('sqlconfig.php');
				
				error_reporting('E_ALL&~E_NOTICE');
				$page=isset($_GET["page"])?$_GET['page']:1;  //当前页
				$pagesize=8;	//页大小
				$maxRows;		//最大数据条
				$maxPages;		//最大页数
				
				
				$sqlss = "select * from ss";
				$result = $conn->query($sqlss);
				$maxrows = mysqli_num_rows($result); 
				//echo $maxrows;
								
				$maxpages = ceil($maxrows/$pagesize);
				//echo $maxpages;
			
				if($page>$maxpages){
					$page=$maxpages;
					//echo $page;
				}
				if($page<1){
					$page=1;
					//echo $page;
				}
				
				$limit = " limit ".(($page-1)*$pagesize).",{$pagesize}";
				
				
				
				$sql = "select * from ss {$limit}";
				//$result = mysqli_query($conn,$sql);
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()){
				echo "<tr align='center'>";
				echo "<td>{$row['id']}</td>";
				echo "<td>{$row['name']}</td>";
				echo "<td>{$row['sex']}</td>";
				echo "<td>{$row['age']}</td>";
				echo "<td>{$row['email']}</td>";
				echo "<td>{$row['reg_date']}</td>";
				echo "<td>
				<a href='update.php?id={$row['id']}'>修改</a>
				<a href='action.php?action=delete&id={$row['id']}'>删除</a>
				</td>";

				echo "</tr>";
				}
				?>
				
			</table>
			
			<?php
				echo "<table width='800'>";
				echo "<tr>";
				echo "<td colspan='7' align='center'>";
				echo "当前{$page}/{$maxpages}页 共计{$maxrows}条&nbsp;&nbsp;&nbsp;";
				echo "<a href='index.php?page=1'>首页</a>&nbsp;&nbsp;&nbsp;";
				echo "<a href='index.php?page=".($page-1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
				echo "<a href='index.php?page=".($page+1)."'>下一页</a>&nbsp;&nbsp;&nbsp;";
				echo "<a href='index.php?page={$maxpages}'>尾页</a>";
				echo "</td>";
				echo "<tr>";
				echo "<table>";
			?>
	</body>
</html>
