<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta char="utf8" />
<title><?php echo ($web_title); ?></title>
</head>
<body>
	<form action="./index.php?c=trueskill" method="post">
		<input type="input" name="usernameA"/>
		<input type="input" name="usernameB"/>
		<input type="hidden" name="ak" value="W60OAjmsIcTGyFpD3Tyz0apoSpFDGYHw" />
		<input type="hidden" name="type" value="0" />
		<input type="submit" />
	</form>
	<br>
	<form action="./index.php?c=query" method="post">
		<input type="input" name="username"/>
		<input type="hidden" name="ak" value="W60OAjmsIcTGyFpD3Tyz0apoSpFDGYHw" />
		<input type="submit" />
	</form>
</body>
</html>