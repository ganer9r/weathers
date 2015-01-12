<?php
function parser($str){
        trim($str);
        $eng = preg_replace("@[^a-zA-Z0-9\s]@i", '', $str);
        $kor = preg_replace("@[a-zA-Z0-9]@i", '', $str);
        $kor = str_replace(" ", '', $kor);
        
        $eng    = preg_replace("@\s+@", " ", $eng);
        $engs   = explode(" ", trim($eng));
        $kors   = mb_split("", $kor);
        $kors = preg_split('//u', $kor, -1, PREG_SPLIT_NO_EMPTY);

        print_R($engs);
        echo "<Br/>";
        print_R($kors);

        echo "<br/><br/>";
}

        print_r( parser("대성N스쿨") );
        print_r( parser("대성 N") );
        print_r( parser("샤인shine") );
        print_r( parser("샤인랜드 shine  land") );
        print_r( parser("명문 gnb어학원") );
        print_r( parser("명문gnb어학원") );
        print_r( parser("대성1동") );
        print_r( parser("대성 1동") );
        print_r( parser("대성 1") );

