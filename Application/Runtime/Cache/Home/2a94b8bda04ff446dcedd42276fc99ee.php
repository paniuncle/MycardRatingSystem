<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta char="utf8" />
<title><?php echo ($web_title); ?></title>
</head>
<body>
	<table border="1">
		<caption>全球排行榜</caption>
		<tr>
			<th>排名</th>
			<th>玩家</th>
		</tr>
		<tr>
			<td>1</td>
			<td><?php echo ($player1); ?></td>
		</tr>
		<tr>
			<td>2</td>
			<td><?php echo ($player2); ?></td>
		</tr>
		<tr>
			<td>3</td>
			<td><?php echo ($player3); ?></td>
		</tr>
		<tr>
			<td>4</td>
			<td><?php echo ($player4); ?></td>
		</tr>
		<tr>
			<td>5</td>
			<td><?php echo ($player5); ?></td>
		</tr>
		<tr>
			<td>6</td>
			<td><?php echo ($player6); ?></td>
		</tr>
		<tr>
			<td>7</td>
			<td><?php echo ($player7); ?></td>
		</tr>
		<tr>
			<td>8</td>
			<td><?php echo ($player8); ?></td>
		</tr>
		<tr>
			<td>9</td>
			<td><?php echo ($player9); ?></td>
		</tr>
		<tr>
			<td>10</td>
			<td><?php echo ($player10); ?></td>
		</tr>
	</table>
	<table border="1">
		<caption>我的信息</caption>
		<tr>
			<th>排名</th>
			<th>积分</th>
			<th>段位</th>
		</tr>
		<tr>
			<td><?php echo ($plyaer_info_ranking); ?></td>
			<td><?php echo ($plyaer_info_rating); ?></td>
			<td><?php echo ($plyaer_info_level); ?></td>
		</tr>
	</table>
	<table border="1">
		<caption>当前在线，且可以匹配的玩家</caption>
		<tr>
			<th>积分</th>
			<th>名称</th>
		</tr>
		<tr>
			<td><?php echo ($plyaer_info_ranking); ?></td>
			<td><?php echo ($plyaer_info_rating); ?></td>	
		</tr>
	</table>
	<form action="./index.php?c=clearing" method="post">
		<input type="input" name="usernameA"/>
		<input type="input" name="usernameB"/>
		<input type="hidden" name="ak" value="W60OAjmsIcTGyFpD3Tyz0apoSpFDGYHw" />
		<input type="submit" />
	</form>
</body>
</html>