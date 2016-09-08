<?php
namespace Home\Controller;
use Think\Controller;
class TrueskillController extends Controller {

    public function index(){
		
		$playerAname = I('post.usernameA','','strip_tags');//通过Post方法获取玩家A名称
		$playerBname = I('post.usernameB','','strip_tags');//通过Post方法获取玩家B名称
		$type = I('post.type','','strip_tags');//通过Post的方式获取玩家的比赛类型
		$safekey = I('post.ak','','strip_tags');//通过Post方法获取是否合法

		if(verifica($safekey) == 0){
			CheckUser($playerAname);
			CheckUser($playerBname);
			$playerAresult = 0;//第一个用户名为败北的
			$playerBresult = 1;//第二个用户名为胜利的
					
			$playerA = QueryData($playerAname); //获取玩家A的数据
			$playerB = QueryData($playerBname); //获取玩家B的数据
			
			if($type == '0'){//0:娱乐 ；1:竞技
				$ratingA_B = ClearingExp($playerA['exp'],$playerB['exp'],$playerAname,$playerBname);
				UpdataExp($playerAname,$ratingA_B[0]['exp'],$playerA['games'] + 1,
								$playerA['win'],$playerA['lose'] + 1,$playerAresult);
								
				UpdataExp($playerBname,$ratingA_B[1]['exp'],$playerB['games'] + 1,
								$playerB['win'] + 1,$playerB['lose'],$playerBresult);
				echo '0';
			}elseif($type == '1'){
				$ratingA_B = Tureskill($playerA['u'],$playerB['u'],$playerA['o'],$playerB['o'],$playerAname,$playerBname);//计算出玩家ab的u和o	
				UpdataSkill($playerAname,$ratingA_B[0]['o'],$ratingA_B[0]['u'],$playerA['games'] + 1,
								$playerA['win'],$playerA['lose'] + 1,$playerAresult);
								
				UpdataSkill($playerBname,$ratingA_B[1]['o'],$ratingA_B[1]['u'],$playerB['games'] + 1,
								$playerB['win'] + 1,$playerB['lose'],$playerBresult);
				echo '0';
			}			
		}else{
			echo '1';
		}
		

		
		
		
		
		

		}
}