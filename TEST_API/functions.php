<?php
// 합 구하는 함수 
function hd_sum($array){
	$check = 0 ; 
	for($i = 0 ; $i<count($array); $i++){
		$check += $array[$i] ; 
	}
	return $check; 
}




//변별도 구하는 함수
function item_discrimination($list){
	$check_1 = count($list[0]);// 문제수
	$check_2 = count($list);// 사람수
	$Y_list = array();
	//총점을 구해서 넣는다.
	for($i = 0 ; $i < $check_2 ; $i++){
		$check = 0;
		for($j = 0 ; $j < $check_1 ; $j++){
			$check += $list[$i][$j];			
		}
		array_push($Y_list,$check);
	}

	$want = array();
	for($i = 0 ; $i < $check_1 ; $i++){
	
		$X = 0;	
		$Y = 0;	
		$X_2 = 0;	
		$Y_2 = 0;	
		$XY = 0;	
		for($j = 0 ; $j < $check_2 ; $j++){
			$X += $list[$j][$i];
			$Y += $Y_list[$j];
			$X_2 += pow($list[$j][$i],2);
			$Y_2 += pow($Y_list[$j],2);
			$XY += $list[$j][$i]*$Y_list[$j];
		}
		$temps_up = $check_2*$XY - $X*$Y;
		$temps_down_0 = sqrt($check_2*$X_2 - pow($X,2));
		$temps_down_1 = sqrt($check_2*$Y_2 - pow($Y,2));
		if($temps_down_0*$temps_down_1==0){
			$temp_want=0;
		}
		else{
			$temp_want = round($temps_up/($temps_down_0*$temps_down_1),3);
		}

		array_push($want ,$temp_want );
	}

	return $want;

}



//변별도 구하는 함수
function item_difficulty($list){
	$want = array();
	$check_1 = count($list[0]);// 문제수
	$check_2 = count($list);// 사람수

	for($i = 0 ; $i < $check_1 ;$i++){
		$check = 0;
		for($j = 0 ; $j < $check_2 ;$j++){
			$check +=$list[$j][$i];
		}	
		array_push($want,round($check/$check_2,2));
	}
	return $want;
}

function time_sum($list){
	$want = array();
	$check_1 = count($list[0]);// 문제수
	$check_2 = count($list);// 사람수

	for($i = 0 ; $i < $check_1 ;$i++){
		$check = 0;
		for($j = 0 ; $j < $check_2 ;$j++){
			$check +=$list[$j][$i];
		}	
		array_push($want,round($check/($check_2*1000),2));
	}
	return $want;
}


function time_sums($list,$list1){
	$want = array();
	$check_1 = count($list[0]);// 문제수
	$check_2 = count($list);// 사람수

	for($i = 0 ; $i < $check_1 ;$i++){
		$check = 0;
		$checks = 0;
		for($j = 0 ; $j < $check_2 ;$j++){
			$check +=$list[$j][$i]*$list1[$j][$i];
			$checks +=$list1[$j][$i];
		}	
		if($checks==0){
			array_push($want,0);		
		}
		else{
			array_push($want,round($check/($checks*1000),2));
		}
		
	}
	return $want;
}


function hd_aver($list){
	$check = 0 ; 
	for($i = 0 ; $i <count($list) ; $i++){
		$check +=$list[$i];	
	}
	if(count($list)==0){$want = 0;}
	else{$want = $check/count($list);}
	return $want;
}

function hd_stdev($list){
	$aver = hd_aver($list);
	$check = 0 ;
	for($i = 0 ; $i <count($list); $i++){
		$check +=pow($list[$i]-$aver,2);
	}
	if(count($list)==0){$want = 0;}
	else{	$want = sqrt($check/(count($list)-1));}
	return $want;
}


function hd_ratio($list){
	$check = 0 ;
	$total_check = 0 ;
	for($i = 0 ; $i <count($list); $i++){
		$check += $list[$i] ;
		$total_check += 1 ;
	}
	if($total_check==0){$want = 0;}
	else{	$want = $check/$total_check;}
	return $want;
}





?>