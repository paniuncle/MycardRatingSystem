<?php
namespace Home\Controller;
use Think\Controller;
class MatchingController extends Controller {
    public function index(){

		$arr1=array(1500,1800,2000,2100,2200,2300,2400,2500);
		$x=1850;
		$count=count($arr1);
		for ($i=0; $i <$count ; $i++) { 
			$arr2[]=abs($x-$arr1[$i]);
		}

		$min= min($arr2);
		for ($i=0; $i <$count ; $i++) { 
			if ($min==$arr2[$i]) {
				echo $arr1[$i];
			}
		}


		}
}