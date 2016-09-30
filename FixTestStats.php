<?php
// @myungjae_yu
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
    $info_Array = array("bmiNum"=>$input_bmiNum,"VersionID"=>$input_version); // 유저정보 : @고유번호 @퀴즈버전
    $speed_Array = array();                                                   // @유형별 정보처리 속도 : @FG ~ @CM ex 1문항당 소요시간
    $acc_Array = array();                                                     // @유형별 문제해결 정확도 : @FG ~ @CM ex 유형별 정확도
    $average_child_Array = array();                                           // 현재 아동의 평균치 @속도 @정확도
    $average_childAll_Array = array();                                        // 아동들의 평균치 @속도 @정확도
    $rank_data;                                                               // @수준 ex 검사불가능0/A수준1/B수준2/C수준3
    $rankAll_Array = array();                                                 // @수준별 치수 A,B,C,none(검사불가능)
//---------------------------------------------------------------------------------------------------------------------------------


    echo '오답여부 FG 유형 1번문제 : '.$answer_Array[0][0].'  (틀림0/맞음1)<br>';
    echo '처리속도 FG 유형 1번문제 : '.$progressTime_Array[0][0].'초 <br><br>';


    // 정확도 유형별 평균
    function Accuracy($value){
    }

    // 정확도 모든 유형별의 합 평균
    function AccuracyAll($value){
    }

    // 정확도 모든 아동들의 합 평균
    function AccuracyChildAll($value){

    }

    // 정보처리속도 유형별 평균
    function Speed($value){
    }

    // 정보처리속도 모든 유형별의 합 평균
    function SpeedAll($value){
    }

    // 정보처리속도 모든 아동들의 합 평균
    function SpeedChildAll($value){

    }

    // 아동의 수준
    function Rank($value){

    }

    // 아동들의 평균수준
    function RankAll($value){

    }



    /* main() */

    // 웹페이지에 json으로 출력될 데이터 담기
    pushSpeed($speed_Array ,23,23,23,23,23);  // 유형별 평균 FG ~ CM
    pushAccoracy($acc_Array, 23,23,23,23,23); // 유형별 평균 FG ~ CM
    pushAverageChild($average_child_Array, 23,23); // SPEED ACC
    pushAverageChildAll($average_childAll_Array , 23,23,23); // SPEED ACC AVERAGE_ACC
    pushRank($rank_data, 2); // 현재 아동의 수준 ex 검사불가능0/A수준1/B수준2/C수준3
    pushRankAll($rankAll_Array, 0,23,33,43); // none 검사불가능 A B C

    endPush($result_Array, $info_Array, $speed_Array, $acc_Array, $average_child_Array, $average_childAll_Array, $rank_data, $rankAll_Array);
    echo 'JSON 출력 :<br>';
    echo json_encode($result_Array);

//---------------------------------------------------------------------------------------------------------------------------------
//솔트단
function fixArray(&$arr, $data){$tick =0;foreach ($data as $x) {$result = KeySort($x,$tick);$tick++;array_push($arr, $result);}}
function KeySort($arr,$type){$tick = 0;$temp_arr = [array(), array(), array(), array(), array()];foreach ($arr as $x) {$return = ValueSort($type, $x);array_push($temp_arr[$return[0]], $return[1]);}return $temp_arr[$type];}
function ValueSort($type, $value){return $result_arr = [$type, $value];}

//푸쉬단
function pushSpeed(&$arr, $fg,$pc,$ps,$sr, $cm){$arr = array("FG"=>$fg,"PC"=>$pc,"PS"=>$ps,"SR"=>$sr,"CM"=>$cm);}
function pushAccoracy(&$arr, $fg,$pc,$ps,$sr, $cm){$arr = array("FG"=>$fg,"PC"=>$pc,"PS"=>$ps,"SR"=>$sr,"CM"=>$cm);}
function pushAverageChild(&$arr, $speed, $acc){$arr = array("SPEED"=>$speed,"ACC"=>$acc);}
function pushAverageChildAll(&$arr, $speed, $acc, $average_acc){$arr = array("SPEED"=>$speed,"ACC"=>$acc, "AVERAGE_ACC"=>$average_acc);}
function pushRank(&$value, $rank){$value = $rank;}
function pushRankAll(&$arr, $none, $a, $b, $c){$arr = array("NONE"=>$none,"A"=>$a, "B"=>$b, "C"=>$c);}

function endPush(&$arr, $info, $speed, $acc, $child, $childAll, $rank, $rankAll){
    echo '<p>';
    array_push($arr['INFO'], $info);
    array_push($arr['SPEED'],$speed);
    array_push($arr['ACC'],$acc);
    array_push($arr['AVERAGE_CHILD'],$child);
    array_push($arr['AVERAGE_CHILD_ALL'],$childAll);
    array_push($arr['RANK'],$rank);
    array_push($arr['RANKALL'],$rankAll);
}
?>
