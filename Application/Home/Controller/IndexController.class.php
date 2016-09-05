<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		$web_title = 'MyCard 天梯系统';
		$username = 'abc';
		$this->assign('web_title',$web_title);
		$data = Ranking();
		for ($i=0;$i <= 10;$i++){
		$this->assign('player'.$i,$data[$i-1]['username']);
		}
		
		
		$mydata = QueryData($username);//获取用户的基本信息
		$rating_now = $mydata['tempinte'];//现在的积分
		$level_now = $mydata['level'];//现在的段位
		$ranking_now = Ranking_player($rating_now);//现在的排名
		
		if($ranking_now == 0)
		{
			$ranking_now =1;
		}
		
		$this->assign('plyaer_info_ranking',$ranking_now);
		$this->assign('plyaer_info_rating',$rating_now);
		$this->assign('plyaer_info_level',$level_now);
		
		$this->display();
		}
}