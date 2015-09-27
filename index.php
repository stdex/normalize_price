<?php

$test_array = array('1200,.00 ������.',
                    '12003,030 ���.',
                    '12004=10 ������.',
                    '12004-=00 ������.',
                    '12004-=00 ������.',
                    '12000=00 ������.',
                    '1200.00 ������.',
                    '1200,00 ������.',
                    '12004-004. ������.',
                    '1200,.00',
                    '12003,030.',
                    '12004=10 ',
                    '12004-=00 .');

foreach( $test_array as $subject ) {
    $out = normalize_price($subject);
    echo $out."<br/>";
}

function normalize_price($subject) {
    $pattern = '#([\d\s\.,-|=]+)(���)*(���|\.|\s|$)#';
    preg_match($pattern, $subject, $matches);
    $str_price = $matches[1];   
    $results = preg_split('/[;,.=-]/', $str_price);
    $int_part = $results[0];
    if($results[1] != '') {
       $fract_part =  $results[1];
    }
    else {
        $fract_part =  $results[2];
    }  
    $out = floatval ($int_part.'.'.$fract_part);
    $out_format = number_format($out, 2, '.', '');
    return $out_format;
}
