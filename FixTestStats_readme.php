<?php
// @myungjae_yu

//------------------------------------------------------------------------------------
    /* @ input JSON Modeling :

    {
        "INFO" :
        {
            "bmiNum":"100469", "VersionID":"0"
        },
        "Answer" :
        {
            "FG" :
            [
                1, // 문항별 오답여부 틀림0/맞음1 ex? : 배열로 담김 16문항
                1,
                1
            ],
            "PC" : [],
            "PS" : [],
            "SR" : [],
            "CM" : []
        },
        "ProgressTime" :
        {
            "FG" :
            [
                1.23223, //문항별 정보처리 속도 ex? : 배열로 담김 16문항
                1.42423,
                3.23232
            ],
            "PC" : [],
            "PS" : [],
            "SR" : [],
            "CM" : []
        }
    }

    */
    //JSON 가 데이터 디코드 처리 : @myungjae_yu
    $input_file = file_get_contents('/Applications/MAMP/bin/mamp/bbcp/js/PPLT/testJsonAPI/SendTestResult.json');
    $input_Array = json_decode($input_file);

//------------------------------------------------------------------------------------

    /* @ Modeling :
    */

    $input_info_Array = $input_Array -> INFO; // ex? : INFO 의 전체 영역이 담김
    $input_answer_Array = $input_Array -> Answer; // ex? : Answer 의 전체 영역이 담김
    $input_ProgressTime_Array = $input_Array -> ProgressTime; // ex? : ProgressTime 의 전체 영역이 담김

    // 인풋 유저번호 버전아이디
    $input_bmiNum = $input_info_Array -> bmiNum;
    $input_version = $input_info_Array -> VersionID;

    $answer_Array = array(); //오답여부 배열
    $progressTime_Array = array(); //처리속도 배열

    //fix
    fixArray($answer_Array, $input_answer_Array);
    fixArray($progressTime_Array, $input_ProgressTime_Array);

    echo '오답여부 FG 유형 1번문제 : '.$answer_Array[0][0].'  (틀림0/맞음1)<br>';
    echo '처리속도 FG 유형 1번문제 : '.$progressTime_Array[0][0].'초 <br><br>';
    /*
        HACK : 첫분분 배열 번호 ex? FG 0/ PC 1/ PS 2/SR 3/ CM 4

    // ex? : Answer 배열 안에 속한 FG 영역의 0번째 문제 오답여부 : 틀림0/맞음1
    // ex? : ProgressTime_Array 배열 안에 속한 FG 영역의 0번째 문제 정보처리 속도 : 0.21323
    */
//------------------------------------------------------------------------------------
    // 출력해나갈 어레이 : result_Array
    $result_Array = array( "INFO"=>array(),"SPEED"=>array(),"ACC"=>array(),"AVERAGE_CHILD"=>array(),"AVERAGE_CHILD_ALL"=>array(),"RANK"=>array(),"RANKALL"=>array());

    //출력해나갈 어레이에 담길 어레이
    $info_Array = array("bmiNum"=>$input_bmiNum,"VersionID"=>$input_version); // 유저정보 : @고유번호 @퀴즈버전
    $speed_Array = array();                                                   // @유형별 정보처리 속도 : @FG ~ @CM ex 1문항당 소요시간
    $acc_Array = array();                                                     // @유형별 문제해결 정확도 : @FG ~ @CM ex 유형별 정확도
    $average_child_Array = array();                                           // 현재 아동의 평균치 @속도 @정확도
    $average_childAll_Array = array();                                        // 아동들의 평균치 @속도 @정확도
    $rank_data;                                                               // @수준 ex 검사불가능0/A수준1/B수준2/C수준3
    $rankAll_Array = array();                                                 // @수준별 치수 A,B,C,none(검사불가능)

//------------------------------------------------------------------------------------


    $return_data = [5];
    Accuracy($return_data, $answer_Array[0][0]);
    // 정확도 유형별 평균
    function Accuracy(&$obj, $num){
        $obj[0] = $num;
    }

    echo 'return_data[0]의 값 : '.$return_data[0].'<br>';

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

    // 웹페이지에 json으로 출력할 푸쉬 데이터 담기
    pushSpeed($speed_Array ,23,23,23,23,23);
    echo '정보처리속도 : ';
    print_r($speed_Array);
    echo '<p>';

    pushAccoracy($acc_Array, 23,23,23,23,23);
    echo '문제해결 정확도 : ';
    print_r($acc_Array);
    echo '<p>';

    pushAverageChild($average_child_Array, 23,23); // SPEED ACC
    echo '아동의 평균 : ';
    print_r($average_child_Array);
    echo '<p>';

    pushAverageChildAll($average_childAll_Array , 23,23,23); // SPEED ACC AVERAGE_ACC
    echo '아동의 평균 : ';
    print_r($average_childAll_Array);
    echo '<p>';

    pushRank($rank_data, 2); // 현재 아동의 수준 ex 검사불가능0/A수준1/B수준2/C수준3
    echo '아동의 수준 : ';
    print_r($rank_data);
    echo '<p>';

    pushRankAll($rankAll_Array, 0,23,33,43); // none 검사불가능 A B C
    echo '수준별 수치 : ';
    print_r($rankAll_Array);
    echo '<p>';

    endPush($result_Array, $info_Array, $speed_Array, $acc_Array, $average_child_Array, $average_childAll_Array, $rank_data, $rankAll_Array);

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

    echo 'JSON 출력 :<br>';
    echo json_encode($result_Array);

//------------------------------------------------------------------------------------
    /* @ output JSON Modeling :

{
    "INFO":[
        {"bmiNum":"100469","VersionID":"0"}
    ],
    "SPEED":[
        {"FG":23,"PC":23,"PS":23,"SR":23,"CM":23}
    ],
        "ACC":[{"FG":23,"PC":23,"PS":23,"SR":23,"CM":23}
    ],
    "AVERAGE_CHILD":[
        null
    ],
    "AVERAGE_CHILD_ALL":[
        null
    ],
    "RANK":null,
    "RANKALL":
        null
    }

    //AccuracyChildAll
{
    "INFO":
    {
        "bmiNum":"100469", "VersionID":"0"
    },
    "AVERAGE_CHILD":
    {
        "SPEED" : "23", "ACC" : "23"
    },
    "AVERAGE_CHILD_ALL":
    {
        "SPEED" : "23", "ACC" : "23", "AVERAGE_ACC" : "23"
    },
    "SPEED":
    {
        "FG" : "23", "PC" : "23", "PS" : "23", "SR" : "23", "CM" : "23"
    },
    "ACC":
    {
        "FG" : "23", "PC" : "23", "PS" : "23", "SR" : "23", "CM" : "23"
    },
    "RANK":
    {
        "A",
    }
    "RANKALL":
    {
        "none" : "23", "A":"23", "B":"23", "C" : "23"
    }
}
*/
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
?>
