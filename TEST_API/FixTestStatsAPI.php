<?php
    include_once ('functions.php');
    include_once('FixTestStats_ver2.php');

    $total_aver   = array(13.25177776, 9.892663059,9.468047574,8.587365995,6.779518092);   //나이별로 총 풀이 시간에 대한 평균
    $total_stdev  = array(3.634074956, 2.008628356,2.392136746,2.665690547,1.047356891);   //나이별로 총 풀이 시간에 대한 표준편차
    
    //나이별 정답 표시의 기준
    $ratio_level_stard = array(
    		array(58.72765849,	71.06429241,	78.1914889,	87.89928933,	88.05874587),
    		array(47.3556288,	56.76435345,	67.27396477,	72.49287668,	81.24497503),
    		array(30.06266409,	35.01904092,	50.67214747,	49.06499638,	70.88356182));
    
    
    
    
    //나이별 속도 표시의 기준
    $velocity_level_stard = array(	array(9.48530114,7.810853564,6.988757177,5.824555306,5.69400244),
    		array(12.51808173,9.487134092,8.985090763,8.049180456,6.568063566),
    		array(13.9854738,10.29819203,9.951004384,9.125551534,6.990972619),
    		array(17.01825439,11.97447255,11.94733797,11.35017668,7.865033744));
    // 나이 그룹 별로 정답수 기준
    $array_total_stats = array(
    		array( array(8.096774194,2.534493226),
    				array(6.967741935,2.738416464),
    				array(8.870967742,3.148988573),
    				array(7,2.435843454),
    				array(4.580645161,1.565762723)), //그룹0의 각 영역별 평균및 표준편차
    
    		array(	array(10.2,2.369344446),
    				array(7.966666667,3.101538365),
    				array(10.73333333,4.225810131),
    				array(7.666666667,2.904613849),
    				array(5.866666667,2.473770448)),   //그룹1의 각 영역별 평균및 표준편차
    
    		array(	array(11,2.742956347),
    				array(9.909090909,3.053633135),
    				array(13.22727273,2.158743422),
    				array(10.31818182,2.41791653),
    				array(7.090909091,3.160908412)),  //그룹2의 각 영역별 평균및 표준편차
    
    		array(	array(12.03571429,2.42643074),
    				array(10.71428571,3.759995497),
    				array(13,3.80058475),
    				array(10.82142857,3.378072773),
    				array(8.214285714,2.233700515)),  //그룹2의 각 영역별 평균및 표준편차
    
    		array(	array(13.03846154,1.341067313),
    				array(12.46153846,2.501691735),
    				array(15.38461538,1.13408723),
    				array(12.73076923,1.686598762),
    				array(9.961538462,2.029399305)));
    
    
    
    
    $fg_each_level = array(   //속도평균, 속도 표편, 정답률
    		array(array(5.908,2.966,48.39),array(5.908,2.966,48.39),array(4.439,2.39,41.94),array(5.816,4.369,61.29),array(5.816,4.369,61.29),array(6.147,2.756,83.87),array(10.908,7.365,58.06),array(6.401,4.247,61.29),array(11.443,7.52,58.06),array(8.115,5.767,45.16),array(9.615,7.205,70.97),array(7.205,3.75,29.03),array(7.254,5.962,35.48),array(5.201,4.16,22.58),array(6.333,5.103,22.58),array(9.095,6.029,3.23)),
    		array(array(6.091,2.4,73.33),array(6.091,2.4,73.33),array(5.214,2.969,40),array(4.291,2.208,70),array(4.291,2.208,70),array(6.703,4.625,86.67),array(7.882,5.626,93.33),array(8.156,5.381,56.67),array(10.284,5.354,60),array(7.199,4.789,66.67),array(8.497,6.603,86.67),array(5.162,2.597,63.33),array(7.166,5.655,36.67),array(5.656,4.822,43.33),array(5.631,3.705,30),array(8.806,5.912,20)),
    		array(array(6.328,2.546,86.36),array(6.328,2.546,86.36),array(4.65,2.876,50),array(5.839,5.053,81.82),array(5.839,5.053,81.82),array(5.087,1.751,95.45),array(6.949,3.329,95.45),array(7.176,3.355,86.36),array(11.922,7.236,63.64),array(11.366,5.487,72.73),array(8.504,5.431,86.36),array(7.421,3.938,54.55),array(7.587,4.859,59.09),array(6.206,3.88,36.36),array(7.126,5.81,31.82),array(8.989,5.053,13.64)),
    		array(array(5.144,2.284,78.57),array(5.144,2.284,78.57),array(3.592,2.224,50),array(4.235,2.329,85.71),array(4.235,2.329,85.71),array(5.196,2.04,96.43),array(6.104,3.263,100),array(8.812,7.707,89.29),array(10.982,5.624,82.14),array(7.398,4.351,85.71),array(9.017,6.129,85.71),array(7.115,5.432,71.43),array(7.428,4.963,57.14),array(6.007,3.285,46.43),array(7.117,4.178,46.43),array(7.681,4.465,28.57)),
    		array(array(4.986,3.234,84.62),array(4.986,3.234,84.62),array(4.545,3.029,76.92),array(4.831,2.48,92.31),array(4.831,2.48,92.31),array(3.993,1.495,100),array(4.257,2.373,100),array(4.712,2.534,96.15),array(8.181,3.996,88.46),array(6.365,4.001,92.31),array(6.199,3.576,96.15),array(6.644,9.558,92.31),array(7.326,4.652,88.46),array(6.936,3.606,42.31),array(7.421,2.819,42.31),array(8.862,4.443,30.77)));
    
    
    $pc_each_level = array(   //속도평균, 속도 표편, 정답률
    		array(array(6.682,4.436,78.13),array(5.354,4.425,37.5),array(8.317,6.591,21.88),array(6.682,4.436,78.13),array(8.455,5.596,15.63),array(4.858,2.462,50),array(6.179,3.576,68.75),array(5.703,4.16,34.38),array(5.719,4.367,28.13),array(6.485,4.406,59.38),array(7.405,5.811,59.38),array(6.157,4.647,34.38),array(6.335,4.941,18.75),array(13.591,8.068,9.38),array(6.939,3.572,31.25),array(13.591,8.068,9.38)),
    		array(array(4.312,1.739,90.32),array(5.11,3.093,80.65),array(5.303,4.111,35.48),array(4.312,1.739,90.32),array(7.869,5.799,22.58),array(4.183,2.06,58.06),array(5.509,3.163,70.97),array(4.533,2.948,38.71),array(5.4,3.719,41.94),array(5.297,3.309,64.52),array(6.642,5.77,67.74),array(6.031,3.866,29.03),array(5.276,2.853,19.35),array(11.907,7.133,3.23),array(6.168,4.93,29.03),array(11.907,7.133,3.23)),
    		array(array(4.158,1.79,90.91),array(3.799,1.908,72.73),array(6.735,4.826,63.64),array(4.158,1.79,90.91),array(9.871,5.258,50),array(4.768,1.558,90.91),array(6.455,2.85,86.36),array(4.79,2.017,59.09),array(7.139,4.659,68.18),array(7.181,4.163,63.64),array(7.363,4.771,81.82),array(5.41,1.654,36.36),array(5.093,2.044,27.27),array(14.049,5.815,22.73),array(6.708,3.329,45.45),array(14.049,5.815,22.73)),
    		array(array(4.223,2.594,96.43),array(3.36,1.419,82.14),array(6.908,4.292,82.14),array(4.223,2.594,96.43),array(9.713,5.305,46.43),array(4.221,1.297,82.14),array(5.451,2.307,78.57),array(4.824,2.304,64.29),array(5.976,4.146,64.29),array(4.546,1.917,71.43),array(5.373,2.402,78.57),array(5.51,2.685,64.29),array(6.367,2.916,39.29),array(13.442,5.957,35.71),array(5.784,3.603,53.57),array(13.442,5.957,35.71)),
    		array(array(3.864,1.676,100),array(3.328,1.827,80.77),array(5.583,2.597,80.77),array(3.864,1.676,100),array(8.629,5.349,69.23),array(3.951,1.019,92.31),array(4.981,1.544,92.31),array(4.581,1.462,88.46),array(5.439,1.917,96.15),array(4.918,2.084,92.31),array(6.134,2.323,84.62),array(6.721,3.374,65.38),array(6.377,2.899,73.08),array(12.488,5.137,46.15),array(7.208,3.487,73.08),array(12.488,5.137,46.15)));
    
    
    
    $ps_each_level = array(   //속도평균, 속도 표편, 정답률
    		array(array(5.053,4.089,87.5),array(5.053,4.089,87.5),array(6.603,4.146,68.75),array(6.808,3.278,46.88),array(6.833,3.821,28.13),array(4.601,4.138,53.13),array(4.755,3.356,71.88),array(4.655,4.032,59.38),array(6.29,5.169,37.5),array(6.881,4.041,59.38),array(7.087,5.884,40.63),array(5.184,4.34,65.63),array(10.647,7.135,46.88),array(10.647,7.135,46.88),array(5.559,3.463,43.75),array(10.647,7.135,46.88)),
    		array(array(2.976,0.825,96.77),array(2.976,0.825,96.77),array(3.983,1.277,77.42),array(5.129,2.233,51.61),array(4.794,2.595,45.16),array(3.162,1.732,77.42),array(3.176,2.396,74.19),array(4.057,2.336,61.29),array(3.49,2.225,74.19),array(5.317,2.422,54.84),array(6.707,3.883,61.29),array(3.508,1.76,77.42),array(6.282,3.521,77.42),array(6.282,3.521,77.42),array(7.179,6.176,61.29),array(6.282,3.521,77.42)),
    		array(array(3.908,4.656,100),array(3.908,4.656,100),array(4.118,1.379,90.91),array(5.727,2.174,77.27),array(7.058,2.085,68.18),array(3.471,2.703,86.36),array(2.772,1.446,95.45),array(3.596,1.97,86.36),array(4.057,4.281,72.73),array(5.419,2.788,72.73),array(6.97,5.112,86.36),array(4.31,2.313,90.91),array(7.709,5.409,77.27),array(7.709,5.409,77.27),array(7.386,6.203,77.27),array(7.709,5.409,77.27)),
    		array(array(3.439,1.715,96.43),array(3.439,1.715,96.43),array(3.816,1.419,78.57),array(4.551,2.449,71.43),array(5.008,2.002,67.86),array(2.396,1.086,89.29),array(3.172,2.194,85.71),array(3.032,1.19,85.71),array(4.178,4.814,85.71),array(5.213,4.096,78.57),array(5.544,3.013,85.71),array(3.62,2.334,85.71),array(5.413,3.539,71.43),array(5.413,3.539,71.43),array(5.597,3.427,82.14),array(5.413,3.539,71.43)),
    		array(array(2.441,0.809,100),array(2.441,0.809,100),array(3.388,1.272,96.15),array(4.051,1.443,96.15),array(5.029,2.237,88.46),array(2.266,0.846,96.15),array(2.046,0.899,96.15),array(2.487,0.878,100),array(2.516,1.82,96.15),array(4.187,3.443,100),array(4.474,2.014,92.31),array(3.519,2.089,100),array(4.498,2.289,92.31),array(4.498,2.289,92.31),array(7.19,4.376,100),array(4.498,2.289,92.31)));
    
    
    $sr_each_level = array(   //속도평균, 속도 표편, 정답률
    		array(array(4.802,2.645,74.19),array(4.328,1.516,35.48),array(4.239,3.795,16.13),array(3.905,2.373,12.9),array(3.814,1.742,51.61),array(6.31,2.199,58.06),array(5.693,2.729,41.94),array(5.685,3.328,58.06),array(6.552,4.419,35.48),array(5.838,3.051,16.13),array(7.61,3.789,67.74),array(6.926,3.926,61.29),array(7.05,4.112,41.94),array(7.564,4.849,48.39),array(6.533,5.514,54.84),array(5.356,3.97,25.81)),
    		array(array(4.443,1.972,80.65),array(4.354,2.357,38.71),array(4.131,3.286,19.35),array(4.259,3.5,19.35),array(3.646,1.962,61.29),array(6.603,4.101,54.84),array(6.174,4.56,54.84),array(5.14,2.775,45.16),array(7.676,6.363,32.26),array(8.076,6.207,32.26),array(7.155,5.581,74.19),array(4.017,1.943,54.84),array(4.58,2.279,48.39),array(6.815,4.621,67.74),array(5.389,3.535,64.52),array(5.207,3.987,35.48)),
    		array(array(4.247,1.549,95.45),array(5.344,2.376,36.36),array(6.207,2.763,13.64),array(6.149,4.114,36.36),array(5.307,2.307,81.82),array(6.418,3.059,90.91),array(8.47,4.389,63.64),array(8.191,5.811,72.73),array(9.994,7.002,50),array(10.156,6.077,18.18),array(5.127,1.768,100),array(5.281,2.277,77.27),array(6.356,2.477,68.18),array(7.354,3.854,86.36),array(7.838,4.919,86.36),array(6.414,3.706,54.55)),
    		array(array(4.095,2.074,92.86),array(4.945,2.275,35.71),array(6.397,5.048,21.43),array(6.296,4.275,42.86),array(5.078,4.696,75),array(6.905,4.715,78.57),array(7.41,5.643,60.71),array(9.031,6.201,64.29),array(10.722,6.288,60.71),array(9.296,5.137,75),array(4.829,3.066,89.29),array(4.293,1.713,82.14),array(6.049,3.409,60.71),array(5.191,1.842,96.43),array(5.313,2.422,82.14),array(5.254,3.385,64.29)),
    		array(array(3.981,1.645,96.15),array(5.335,1.821,57.69),array(6.01,2.908,30.77),array(5.997,2.321,69.23),array(4.23,1.787,92.31),array(6.941,3.885,84.62),array(7.525,4.28,88.46),array(10.464,6.982,69.23),array(10.43,5.726,69.23),array(10.962,5.842,69.23),array(4.18,1.571,100),array(4.313,2.924,84.62),array(5.375,2.478,80.77),array(5.159,2.042,100),array(5.778,2.504,96.15),array(6.194,2.865,84.62)));
    
    
    
    $cm_each_level = array(   //속도평균, 속도 표편, 정답률
    		array(array(5.053,4.089,87.5),array(5.167,3.981,78.13),array(6.833,3.821,28.13),array(6.603,4.146,68.75),array(6.808,3.278,46.88),array(6.881,4.041,59.38),array(6.881,4.041,59.38),array(4.601,4.138,53.13),array(4.655,4.032,59.38),array(10.647,7.135,46.88),array(4.755,3.356,71.88),array(6.078,4.311,59.38),array(5.184,4.34,65.63),array(7.087,5.884,40.63),array(5.167,3.631,12.5),array(5.559,3.463,43.75)),
    		array(array(2.976,0.825,96.77),array(3.088,1.239,87.1),array(4.794,2.595,45.16),array(3.983,1.277,77.42),array(5.129,2.233,51.61),array(5.317,2.422,54.84),array(5.317,2.422,54.84),array(3.162,1.732,77.42),array(4.057,2.336,61.29),array(6.282,3.521,77.42),array(3.176,2.396,74.19),array(5.077,2.068,70.97),array(3.508,1.76,77.42),array(6.707,3.883,61.29),array(6.5,4.124,35.48),array(7.179,6.176,61.29)),
    		array(array(3.908,4.656,100),array(3.441,1.03,100),array(7.058,2.085,68.18),array(4.118,1.379,90.91),array(5.727,2.174,77.27),array(5.419,2.788,72.73),array(5.419,2.788,72.73),array(3.471,2.703,86.36),array(3.596,1.97,86.36),array(7.709,5.409,77.27),array(2.772,1.446,95.45),array(5.755,3.539,81.82),array(4.31,2.313,90.91),array(6.97,5.112,86.36),array(9.367,6.661,59.09),array(7.386,6.203,77.27)),
    		array(array(3.439,1.715,96.43),array(2.905,2.21,89.29),array(5.008,2.002,67.86),array(3.816,1.419,78.57),array(4.551,2.449,71.43),array(5.213,4.096,78.57),array(5.213,4.096,78.57),array(2.396,1.086,89.29),array(3.032,1.19,85.71),array(5.413,3.539,71.43),array(3.172,2.194,85.71),array(5.623,3.126,85.71),array(3.62,2.334,85.71),array(5.544,3.013,85.71),array(7.621,3.803,60.71),array(5.597,3.427,82.14)),
    		array(array(2.441,0.809,100),array(2.068,0.509,96.15),array(5.029,2.237,88.46),array(3.388,1.272,96.15),array(4.051,1.443,96.15),array(4.187,3.443,100),array(4.187,3.443,100),array(2.266,0.846,96.15),array(2.487,0.878,100),array(4.498,2.289,92.31),array(2.046,0.899,96.15),array(3.899,1.219,100),array(3.519,2.089,100),array(4.474,2.014,92.31),array(7.105,4.149,88.46),array(7.19,4.376,100)));
    
    
//---------------------------------------------------------------------------------------------------------------------------------



    // @myungjae_yu
    //$post_data = file_get_contents('/Applications/MAMP/bin/mamp/bbcp/js/PPLT/testJsonAPI/SendTestResult.json');
    $post_data = file_get_contents("php://input");
    $input_Array = json_decode($post_data);


    $input_info_Array = $input_Array -> INFO;
    $input_answer_Array = $input_Array -> Answer;
    $input_ProgressTime_Array = $input_Array -> ProgressTime;

    // 인풋 유저번호 버전아이디
    $input_bmiNum = $input_info_Array -> bmiNum;
    $input_version = $input_info_Array -> VersionID;
    $input_age = $input_info_Array -> age;

    $answer_Array = array();
    $progressTime_Array = array();
    fixArray($answer_Array, $input_answer_Array);
    fixArray($progressTime_Array, $input_ProgressTime_Array);

    // 출력해나갈 어레이 : json_Array
    $json_array = array(
        "INFO" => array(),
        "SPEED" => null,"T_SPEED" => null,"SPEED_LEVEL" => null,
        'ACCURACY_RANGE' => null, "ACCURACY_LEVEL_1" => null,"ACCURACY_LEVEL_2" => null,
        "ACCURACY_GRAPH_AVERAGE" => array(),"ACCURACY_DEFAULT_AVERAGE" => array(),
        "FG_SPEED" => array(),"PC_SPEED" => array(),"PS_SPEED" => array(),"SR_SPEED" => array(),"CM_SPEED" => array(),
        "AVERAGE_CHILD_FG" => array(), "AVERAGE_CHILD_PC" => array(), "AVERAGE_CHILD_PS" => array(), "AVERAGE_CHILD_SR" => array(), "AVERAGE_CHILD_CM" => array(),
		 "TOTAL_LEVEL" => array(), "RATIO_RANGE" => array(), "VELOCITY_LINE" => array()   		
    );
    
    /* @ Modeling :
    */
    $info_Array = array("bmiNum"=>$input_bmiNum,"VersionID"=>$input_version,"age"=>$input_age); // 유저정보 : @고유번호 @퀴즈버전
    $speed_Array = array();                                                   // @유형별 정보처리 속도 : @FG ~ @CM ex 1문항당 소요시간
    $acc_Array = array();                                                     // @유형별 문제해결 정확도 : @FG ~ @CM ex 유형별 정확도
    $average_child_Array = array();                                           // 현재 아동의 평균치 @속도 @정확도
    $average_childAll_Array = array();                                        // 아동들의 평균치 @속도 @정확도
    $rank_data;                                                               // @수준 ex 검사불가능0/A수준1/B수준2/C수준3
    $rankAll_Array = array();                                                 // @수준별 치수 A,B,C,none(검사불가능)
//---------------------------------------------------------------------------------------------------------------------------------


/*
    echo '오답여부 FG 유형 1번문제 : '.$answer_Array[0][0].'  (틀림0/맞음1)<br>';
    echo '처리속도 FG 유형 1번문제 : '.$progressTime_Array[0][0].'초 <br><br>';
*/

    $idx = $info_Array['bmiNum'];
    $version_num = $info_Array['VersionID'];
    $age = $info_Array['age'];
    $ratio_range = ratio_range($velocity_level_stard,$age);

    $r_array=array($answer_Array[0],$answer_Array[1],$answer_Array[2],$answer_Array[3],$answer_Array[4]);
    $t_array=array($progressTime_Array[0],$progressTime_Array[1],$progressTime_Array[2],$progressTime_Array[3],$progressTime_Array[4]);

    $temp_velocity = Speed($t_array,$r_array);
    $velocity = T_Speed($t_array,$r_array,$age,$total_aver,$total_stdev);
    $temp = Speed_level($temp_velocity,$velocity_level_stard,$age);

    $velocity_line = velocity_line($velocity);
    
    $temp_ratio = round(temp_Accuracy($r_array)/80*100,2);
    $want  =Accuracy_level($temp_ratio,$ratio_level_stard,$age);

    $total_level = total_level($temp,$want[2]);
   
    $accuracy_range = Accuracy($r_array);

    $temp_0 = hd_sum($r_array[0]);
    $temp_1 = hd_sum($r_array[1]);
    $temp_2 = hd_sum($r_array[2]);
    $temp_3 = hd_sum($r_array[3]);
    $temp_4 = hd_sum($r_array[4]);
    $temp = array($temp_0,$temp_1,$temp_2,$temp_3,$temp_4);

    $area_want = area_t_score($temp,$array_total_stats,$age);
    $t_0 = 	$area_want[0];
    $t_1 = 	$area_want[1];
    $t_2 = 	$area_want[2];
    $t_3 = 	$area_want[3];
    $t_4 = 	$area_want[4];

    $each_level = array($fg_each_level,$pc_each_level,$ps_each_level,$sr_each_level,$cm_each_level);
    $t_age = trans_age($age);
    $speed_name = ['FG_SPEED','PC_SPEED','PS_SPEED','SR_SPEED','CM_SPEED'];
    for($i = 0 ; $i <5 ; $i++){
        for($j = 0 ; $j <16 ; $j++){
            $temp_each_level = $each_level[$t_age][$i][$j];

            $value = $t_array[$i][$j]/1000;
            $mean  = $temp_each_level[0];
            $stdev = $temp_each_level[1];
            $temp = each_pro($value,$mean,$stdev);

            array_push($json_array[$speed_name[$i]], $temp);
        }
    }

    array_push($json_array['INFO'], $input_bmiNum);
    array_push($json_array['INFO'], $input_version);
    array_push($json_array['INFO'], $input_age);
    $json_array['SPEED'] = $temp_velocity;
    $json_array['T_SPEED'] = $velocity;
    $json_array['SPEED_LEVEL'] = $temp;
    $json_array['ACCURACY_RANGE'] = $accuracy_range;
    $json_array['ACCURACY_LEVEL_1'] = $want[0];
    $json_array['ACCURACY_LEVEL_2'] = $want[1];
    array_push($json_array['ACCURACY_DEFAULT_AVERAGE'], $temp_0);
    array_push($json_array['ACCURACY_GRAPH_AVERAGE'], $t_0);
    array_push($json_array['ACCURACY_DEFAULT_AVERAGE'], $temp_1);
    array_push($json_array['ACCURACY_GRAPH_AVERAGE'], $t_1);
    array_push($json_array['ACCURACY_DEFAULT_AVERAGE'], $temp_2);
    array_push($json_array['ACCURACY_GRAPH_AVERAGE'], $t_2);
    array_push($json_array['ACCURACY_DEFAULT_AVERAGE'], $temp_3);
    array_push($json_array['ACCURACY_GRAPH_AVERAGE'], $t_3);
    array_push($json_array['ACCURACY_DEFAULT_AVERAGE'], $temp_4);
    array_push($json_array['ACCURACY_GRAPH_AVERAGE'], $t_4);
    array_push($json_array['AVERAGE_CHILD_FG'], $fg_each_level);
    array_push($json_array['AVERAGE_CHILD_PC'], $pc_each_level);
    array_push($json_array['AVERAGE_CHILD_PS'], $ps_each_level);
    array_push($json_array['AVERAGE_CHILD_SR'], $sr_each_level);
    array_push($json_array['AVERAGE_CHILD_CM'], $cm_each_level);
    array_push($json_array['TOTAL_LEVEL'], $total_level);
    array_push($json_array['RATIO_RANGE'], $ratio_range);
    array_push($json_array['VELOCITY_LINE'], $velocity_line);
/*  추가
    TOTAL_LEVEL   : 전체 레벨 A B C 검사불가능
    RATIO_RANGE   : 정확도 범위 나이별 정확도 기준
    VELOCITY_LINE : 속도계 그래프 벡터값 x1 x2 y1 y2
*/
    /* main() */
    echo json_encode($json_array,JSON_UNESCAPED_UNICODE);
//---------------------------------------------------------------------------------------------------------------------------------
//솔트단
function fixArray(&$arr, $data){$tick =0;foreach ($data as $x) {$result = KeySort($x,$tick);$tick++;array_push($arr, $result);}}
function KeySort($arr,$type){$tick = 0;$temp_arr = [array(), array(), array(), array(), array()];foreach ($arr as $x) {$return = ValueSort($type, $x);array_push($temp_arr[$return[0]], $return[1]);}return $temp_arr[$type];}
function ValueSort($type, $value){return $result_arr = [$type, $value];}

/*
{
    "INFO":
    [
        "100423",
        "0",
        "12"
    ],
    "SPEED":7.75854545455,
    "T_SPEED":81.3047993295,
    "SPEED_LEVEL":
    [
        12,9,15,12,7
    ],
    "ACCURACY_LEVEL_1":"매우 낮음",
    "ACCURACY_LEVEL_2":매우 많은 편,
    "ACCURACY_GRAPH_AVERAGE":
    [
        84.5129095321,
        72.3264188663,
        93.2171817154,
        91.3344033393,
        70.8136446612
    ],
    "ACCURACY_DEFAULT_AVERAGE":
    [
        12,
        9,
        15,
        12,
        7
    ],
    "FG_SPEED":
    [
        "보통",
        "빠름",
        "빠름",
        "빠름",
        "빠름",
        "빠름",
        "빠름",
        "보통",
        "보통",
        "보통",
        "느림",
        "빠름",
        "보통",
        "보통",
        "보통",
        "보통"
    ],
    "PC_SPEED":
    [
        "보통",
        "느림",
        "보통",
        "느림",
        "느림",
        "보통",
        "빠름",
        "보통",
        "느림",
        "보통",
        "느림",
        "보통",
        "느림",
        "보통",
        "느림",
        "보통"
    ],
    "PS_SPEED":
    [
        "보통",
        "빠름",
        "빠름",
        "보통",
        "느림",
        "빠름",
        "빠름",
        "보통",
        "느림",
        "빠름",
        "느림",
        "보통",
        "보통",
        "보통",
        "보통",
        "느림"
    ],
    "SR_SPEED":
    [
        "보통",
        "느림",
        "보통",
        "보통",
        "보통",
        "보통",
        "빠름",
        "느림",
        "느림",
        "보통",
        "느림",
        "빠름",
        "느림",
        "보통",
        "빠름",
        "느림"
    ],
    "CM_SPEED":
    [
        "빠름",
        "보통",
        "보통",
        "느림",
        "빠름",
        "빠름",
        "보통",
        "느림",
        "보통",
        "빠름",
        "느림",
        "보통",
        "느림",
        "느림",
        "빠름",
        "빠름"
    ]
}
*/

?>