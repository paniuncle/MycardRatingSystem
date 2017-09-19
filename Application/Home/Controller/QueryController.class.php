<?php
namespace Home\Controller;

use Think\Controller;

class QueryController extends Controller
{
    public function index()
    {
		header("Content-type: text/html; charset=utf-8");
        $player = I('get.username');
        $player = urldecode($player);
        //profile前端页面需要的全部数据  全部初始化为0    add by Joe 20160921
        $EndResult = array(
            'exp' => '800',
            'exp_rank' => '0',
            'pt' => '800',
            'arena_rank' => '0',
            'win' => '0',
            'lose' => '0',
            'draw' => '0',
            'all' => '0',
            'ratio' => '0',
            'violation' => '0',
            'trueskill' => array(
                'mean'=>'0',
                'variance'=>'0'
            )
        );
        
        //TODO CheckUser 和 QueryData  为何在我本地环境 永远返回false , bug ?
        //CheckUser($player); // 去掉查询时生成新用户的行为，以防止异常查询生成垃圾数据		
        $player_data = QueryData($player);  
        //TODO 开发约定: QueryData($player); 业务层返回给Controller层 不要返回null ,可以与上面$EndResult 一样设置默认值,
        // 排名 和 胜率 之类数据库不能直接查到 或需要计算的字段, 在方法内部处理
        if($player_data != NULL){
            $EndResult['exp'] = $player_data['exp'] ;
            $EndResult['pt'] = $player_data['pt'] ;
            $EndResult['trueskill']['mean'] = $player_data['u'] ;
            $EndResult['trueskill']['variance'] = $player_data['0'];
            $EndResult['exp_rank'] = exp_rank($player);
            $EndResult['arena_rank'] = arena_rank($player) ;
            $EndResult['win'] = $player_data['win'] ;
            $EndResult['lose'] = $player_data['lose'] ;
            $EndResult['draw'] = $player_data['game'] - ($player_data['win'] + $player_data['lose']) ;
            $EndResult['all'] = $player_data['game'] ;			
			// 下面的数据目前没有
            $EndResult['ratio'] = count_ratio($player_data['win'],$player_data['lose']) ;
            $EndResult['violation'] = $player_data['exp'] ;
        }  
        // 设置允许跨域访问 , 可以把*改成域名
        header('Access-Control-Allow-Origin: *');
        $this->ajaxReturn($EndResult);
    }
}
