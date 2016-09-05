<?php

function ClearingRating($ratingA,$ratingB,$resultA,$resultB,$usernameA,$usernameB){//清算历史积分
	$weight = 32; //权值，游戏难度越大权值越小
	
	$differA = $ratingB - $ratingA; //计算积分玩家A差值
	$differB = $ratingA - $ratingB; //计算积分玩家B差值
	
	$Ea = 1/(1+(10^$differA)/400); //计算出玩家A的期望得分
	$Eb = 1/(1+(10^$differB)/400); //计算出玩家B的期望得分

	if($Ea <= 0){
		$Ea = 1 - $Eb;
	}elseif($Ea >0){
		$Eb = 1 - $Ea;
	}
	$EndRatingA = $ratingA + $weight * ($resultA - $Ea); //计算出玩家A游戏结束后的积分
	
	$EndRatingB = $ratingB + $weight * ($resultB - $Eb); //计算出玩家B游戏结束后的积分
	
	$EndRatingResult = array(
		array(
			'name'=>$usernameA,
			'rating'=>$EndRatingA
		),
		array(
			'name'=>$usernameB,
			'rating'=>$EndRatingB
		)
	);
	
	return $EndRatingResult;
}

function ClearingTempRating($ratingA,$ratingB,$resultA,$resultB,$usernameA,$usernameB){//清算月清积分
	$weight = 32; //权值，游戏难度越大权值越小
	
	$differA = $ratingB - $ratingA; //计算积分玩家A差值
	$differB = $ratingA - $ratingB; //计算积分玩家B差值
	
	
	$Ea = 1/(1+(10^$differA)/400); //计算出玩家A的期望得分
	$Eb = 1/(1+(10^$differB)/400); //计算出玩家B的期望得分
	
	if($Ea <= 0){
		$Ea = 1 - $Eb;
	}elseif($Ea >0){
		$Eb = 1 - $Ea;
	}

	$EndRatingA = $ratingA + $weight * ($resultA - $Ea); //计算出玩家A游戏结束后的积分
	
	$EndRatingB = $ratingB + $weight * ($resultB - $Eb); //计算出玩家B游戏结束后的积分
	
	$EndRatingResult = array(
		array(
			'name'=>$usernameA,
			'rating'=>$EndRatingA
		),
		array(
			'name'=>$usernameB,
			'rating'=>$EndRatingB
		)
	);
	
	return $EndRatingResult;
}

function QueryData($username){//查询用户数据
	$mysql = M("rating_index");//连接数据库
	$data = $mysql->where('username="'.$username.'"')->find();//查询某个用户的所有信息
	return $data;
}

function UpdataRating($username,$rating,$temprating,$games,$tempgames,$win,$tempwin,$lose,$templose,$last){//更新用户
	$mysql = M("rating_index");
	$data['integral'] = $rating; //总积分
	$data['tempinte'] = $temprating; //月清积分
	$data['games'] = $games; //总场数
	$data['tempgames'] = $tempgames; //月清场数
	$data['win'] = $win; //总胜利
	$data['tempwin'] = $tempwin; //月清胜利
	$data['lose'] = $lose; //总失败
	$data['templose'] = $templose; //月清失败
	$data['last'] = $last; //最后一场输赢
	$mysql->where('username="'.$username.'"')->save($data); //更新数据
}

function verifica($ak){//安全认证
	$mysql = M("safe_ak");
	$data = $mysql->where('ak="'.$ak.'"')->find();
	if($data == NULL){
		return 1;//没有该ak
	}elseif($data == false){
		return 2;//查询出错
	}else{
		return 0;//成功
	}
}

function Ranking(){//获取全球玩家积分的前十名
	$mysql = M("rating_index");//链接数据表
	$data = $mysql->where('status=0')->field('username')->order('tempinte desc')->limit(10)->select();//获取本表前十名
	return $data;//返回数据
}

function Ranking_player($tempinte){//计算用户目前的月清积分排名用的
	$mysql = M("rating_index");//连接数据库
	$map['tempinte'] = array('EGT',$tempinte);//用数组当作查询条件
	$data = $mysql->where($map)->field('username')->order('tempinte asc,username asc')->Count();//计算出用户的月清积分排名
	return $data;//返回数据
}

function UpdataStatus($username,$status){//更新用户是否在线的
	$mysql = M("rating_index");
	$data['online'] = $status;
	$mysql->where('username="'.$username.'"')->save($data); //更新数据
}

function CheckUser($username){//判断是否数据表中存在用户名
	$mysql = M("rating_index");//连接数据库
	$data = $mysql->where('username="'.$username.'"')->find();//查询某个用户的所有信息
	if($data == NULL){
		$new_data['username'] = $username;
		$mysql->data($new_data)->add();
	}
}

?>