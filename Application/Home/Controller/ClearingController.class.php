<?php
namespace Home\Controller;
use Think\Controller;
class ClearingController extends Controller {
    public function index(){
		
		$playerAname = I('post.usernameA','','strip_tags');//通过Post方法获取玩家A名称
		$playerBname = I('post.usernameB','','strip_tags');//通过Post方法获取玩家B名称
		

		$safekey = I('post.ak','','strip_tags');//通过Post方法获取是否合法

		if(verifica($safekey) == 0){
					CheckUser($playerAname);
					CheckUser($playerBname);
					$playerAresult = 0;//第一个用户名为败北的
					$playerBresult = 1;//第二个用户名为胜利的
					
					$playerA = QueryData($playerAname); //获取玩家A的数据
					$playerB = QueryData($playerBname); //获取玩家B的数据
					
					$ratingA_B = ClearingRating($playerA['integral'],$playerB['integral'],$playerAresult,
												$playerBresult,$playerAname,$playerBname); //清算A和B的总积分
												
					$ratingTempA_B = ClearingTempRating($playerA['tempinte'],$playerB['tempinte'],$playerAresult,
														$playerBresult,$playerAname,$playerBname); //清算A和B的月清积分
					

					UpdataRating($playerAname,$ratingA_B[0]['rating'],$ratingTempA_B[0]['rating'],$playerA['games'] + 1,$playerA['tempgames'] + 1,
									$playerA['win'],$playerA['tempwin'],$playerA['lose'] + 1,$playerA['templose'] + 1,$playerAresult); //更新A玩家失败的天梯数据
					UpdataRating($playerBname,$ratingA_B[1]['rating'],$ratingTempA_B[1]['rating'],$playerB['games'] + 1,$playerB['tempgames'] + 1,
									$playerB['win'] + 1,$playerB['tempwin'] + 1,$playerB['lose'],$playerB['templose'],$playerBresult); //更新B玩家成功的天梯数据

					
					$this->ajaxReturn($ratingTempA_B);
					
		}else{
			echo 'false';
		}
		

		
		
		
		
		

		}
}