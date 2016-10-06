<?php
// @myungjae_yu
/*
    $input_file = file_get_contents('/Applications/MAMP/bin/mamp/bbcp/js/PPLT/testJsonAPI/SendTestResult.json');
    $input_Array = json_decode($input_file);

    $input_info_Array = $input_Array -> INFO;
    $input_answer_Array = $input_Array -> Answer;
    $input_ProgressTime_Array = $input_Array -> ProgressTime;

    // 인풋 유저번호 버전아이디
    $input_bmiNum = $input_info_Array -> bmiNum;
    $input_version = $input_info_Array -> VersionID;

    $answer_Array = array();
    $progressTime_Array = array();
    fixArray($answer_Array, $input_answer_Array);
    fixArray($progressTime_Array, $input_ProgressTime_Array);

    // 출력해나갈 어레이 : result_Array
    $result_Array = array( "INFO"=>array(),"SPEED"=>array(),"ACC"=>array(),"AVERAGE_CHILD"=>array(),"AVERAGE_CHILD_ALL"=>array(),"RANK"=>array(),"RANKALL"=>array());

    /* @ Modeling :
    */
  /*  $info_Array = array("bmiNum"=>$input_bmiNum,"VersionID"=>$input_version); // 유저정보 : @고유번호 @퀴즈버전
    $speed_Array = array();                                                   // @유형별 정보처리 속도 : @FG ~ @CM ex 1문항당 소요시간
    $acc_Array = array();                                                     // @유형별 문제해결 정확도 : @FG ~ @CM ex 유형별 정확도
    $average_child_Array = array();                                           // 현재 아동의 평균치 @속도 @정확도
    $average_childAll_Array = array();                                        // 아동들의 평균치 @속도 @정확도
    $rank_data;                                                               // @수준 ex 검사불가능0/A수준1/B수준2/C수준3
    $rankAll_Array = array();                                                 // @수준별 치수 A,B,C,none(검사불가능)
//---------------------------------------------------------------------------------------------------------------------------------


    echo '오답여부 FG 유형 1번문제 : '.$answer_Array[0][0].'  (틀림0/맞음1)<br>';
    echo '처리속도 FG 유형 1번문제 : '.$progressTime_Array[0][0].'초 <br><br>';

*/










	/*
			@ 윤희동
			@ 2016-10-04 작성
			@ 변수명 규칙




	0. total_array 규칙
	  ex) $t_array  = array($fg_t_array,$pc_t_array,$ps_t_array,$sr_t_array,$cm_t_array)  순서는 fg,pc,ps,sr,cm



	1. array 규칙 (영역)_(항목)_array
  	  ex) $fg_t_array    시간 값, array(0.55,4.04,...) 이런식으로 넣어 주세요.  단위는 소수점 3째짜리까지
	  ex) $fg_r_array    정답 유무, array(0,1,1,1,0...) 이런식으로 넣어 주세요.  0: 오답. 1: 정답


	2. 규칙 (영역)_(항목)_(문제 번호)
	  ex) $fg_r_1    fg 영역의 2번째 문제의 정답 유무, 시작수를 0부터



	3. 평균 규칙   (규모)_(영역)_(문제번호)_(항목)_(통계구분) 규모에 따라 구분가능하면 삭제함
	  ex) $total_t_stdev    모든 문항의 시간에 대한 표준편차
	  ex) $total_r_aver     모든 문항의 정답률에 대한 평균
	  ex) $fg_t_aver    fg 문항의 시간에 대한 평균
	  ex) $fg_1_t_aver    fg 문항의 2번째 문제의 시간에 대한 평균
	  ex) $fg_15_t_stdev    fg 문항의 16번째 문제의 시간에 대한 표준 편차


	4.temp_(함수) 는 평균을 도출하기 위한 임시 함수
		지워서 드림
	*/
    // 측정항목 분석 - 정보 처리 속도


	function Speed($t_array,$r_array){
		$check_t = 0;
		$check_r = 0;
		for($i = 0 ; $i < count($t_array);$i++ ){
			$temp_t_array = $t_array[$i];
			$temp_r_array = $r_array[$i];
			for($j = 0 ; $j < count($temp_t_array);$j++ ){
                if(!is_null($temp_r_array[$j])){
                    $check_t +=	$temp_t_array[$j]/1000;
                    $check_r += $temp_r_array[$j];
                }
			}

		}
		$want = $check_t / $check_r;
		return $want;
    }


	//나이 변환 함수
	function trans_age($age){
		if($age<=7){$want =0;}
		elseif($age<=8){$want =1;}
		elseif($age<=9){$want =2;}
		elseif($age<=11){$want =3;}
		else{$want =4;}
		return $want;
	}


	$total_aver   = array(13.25177776, 9.892663059,9.468047574,8.587365995,6.779518092);   //나이별로 총 풀이 시간에 대한 평균
	$total_stdev  = array(3.634074956, 2.008628356,2.392136746,2.665690547,1.047356891);   //나이별로 총 풀이 시간에 대한 표준편차


	function T_Speed($t_array,$r_array,$age,$total_aver,$total_stdev){
		$t_age = trans_age($age);
		$check_t = 0;
		$check_r = 0;
		for($i = 0 ; $i < count($t_array);$i++ ){
			$temp_t_array = $t_array[$i];
			$temp_r_array = $r_array[$i];
			for($j = 0 ; $j < count($temp_t_array);$j++ ){
                if(!is_null($temp_r_array[$j])){
                    $check_t +=	$temp_t_array[$j]/1000 ;
                    $check_r += $temp_r_array[$j] ;
                }
			}
		}
		$want = ($total_aver[$t_age]-$check_t/$check_r)/$total_stdev[$t_age]*20+100;
		return $want;
    }



	//아동 수준


	// 아동의 수준
	// $velocity = Speed($t_array,$r_array,$age,$total_aver,$total_stdev)

    function Speed_level($velocity,$velocity_level_stard,$age){
		$t_age = trans_age($age);
		if( $velocity < 	$velocity_level_stard[0][$t_age]){$want = '매우 빠름';}
		elseif( $velocity < $velocity_level_stard[1][$t_age]){$want = '빠름';}
		elseif( $velocity < $velocity_level_stard[2][$t_age]){$want = '보통';}
		elseif( $velocity < $velocity_level_stard[3][$t_age]){$want = '느림';}
		else{$want = '매우 느림';}
		return $want;
    }



	// 정확도
	function temp_Accuracy($r_array){
		$check_r = 0;
		for($i = 0 ; $i < count($r_array);$i++ ){
			$temp_r_array = $r_array[$i];
			for($j = 0 ; $j < count($temp_r_array);$j++ ){
				$check_r += $temp_r_array[$j] ;
			}

		}
		$want = $check_r;
		return $want;
	}

	function Accuracy($r_array){
		$check_r = 0;
		for($i = 0 ; $i < count($r_array);$i++ ){
			$temp_r_array = $r_array[$i];
			for($j = 0 ; $j < count($temp_r_array);$j++ ){
				$check_r += $temp_r_array[$j] ;
			}

		}
		$want = $check_r/80*100;
		return $want;
	}


	//$total_ratio = 모든 영역의 정답수/80*100
    function Accuracy_level($total_ratio,$ratio_level_stard,$age){
		$t_age = trans_age($age);

		if( $total_ratio > 	$ratio_level_stard[0][$t_age]){$want1 = '매우 높음';$want2 = '매우 적은';}
		elseif( $total_ratio > $ratio_level_stard[1][$t_age]){$want1 = '평균';$want2 = '적은 편';}
		elseif( $total_ratio > $ratio_level_stard[2][$t_age]){$want1 = '낮음';$want2 = '많은 편';}
		else{$want1 = '매우 낮음'; $want2 = '매우 많은';}
		$want = array($want1,$want2);
		return $want;
    }








    // 아동들의 평균수준
    function area_t_score($value,$array_total_stats,$age){
		$t_age = trans_age($age);
		$gp_age =$array_total_stats[$t_age];
		$want_0 = ($value[0]-$gp_age[0][0])/$gp_age[0][1]*20+100;
		$want_1 = ($value[1]-$gp_age[1][0])/$gp_age[1][1]*20+100;
		$want_2 = ($value[2]-$gp_age[2][0])/$gp_age[2][1]*20+100;
		$want_3 = ($value[3]-$gp_age[3][0])/$gp_age[3][1]*20+100;
		$want_4 = ($value[4]-$gp_age[4][0])/$gp_age[4][1]*20+100;
		$want = array($want_0,$want_1,$want_2,$want_3,$want_4) ;
		return $want;
    }


    // 개별문제 높고 낮음 판단 함수
    function each_pro($value,$mean,$stdev){
		if($value < $mean-$stdev/2){$want = '빠름';}
		elseif($value < $mean+$stdev/2){$want = '보통';}
		else{$want = '느림';}
		return $want;
    }


	 // 전체 레벨
    function total_level(){
    }

	 // 그래프 속도
    function velocity_line(){
    }


	 // 정확도 범위
    function ratio_range(){
    }


?>