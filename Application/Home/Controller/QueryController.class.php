<?php
namespace Home\Controller;
use Think\Controller;
class QueryController extends Controller {
    public function index(){
		$player = I('post.username','','strip_tags');//通过Post方法获取玩家名称
		$passw = I('post.password','','strip_tags');//通过Post方法获取玩家密码
		$safekey = I('post.ak','','strip_tags');//通过Post方法获取是否合法
		
		if(verifica($safekey) == 0){
			CheckUser($player);

			$player_data = QueryData($player); //获取玩家的数据
			
				$EndResult = array(
						'exp'=>$player_data['exp'],
						'pt'=>$player_data['pt'],
						'trueskill'=>array(
							'mean'=>$player_data['u'],
							'variance'=>$player_data['o']
						)
					);
				$this->ajaxReturn($EndResult);
		
		}else{
			echo '1';
		}
		
		}
}