<?php
$file = '/home/alex/tasks/city_tt/20150526/12.csv';


$handle = fopen($file,"r");
while ( ($data = fgetcsv($handle) ) !== FALSE ) {
    $upd = '';
    $upd .= "DELETE FROM `gd_city_tt` WHERE `code`='$data[1]';\n";
    $upd .= "INSERT INTO `gd_city_tt`(`code`, `category_tt`,`filial`, `city`, `index`, `location`, `name_tt`, `gps_x`, `gps_y`)
            VALUES('$data[1]', '', '$data[0]', '$data[5]', '$data[4]', '$data[3]', '$data[2]', '$data[6]', '$data[7]');\n";
    file_put_contents('/home/alex/tasks/city_tt/20150526/20150526.sql', $upd, FILE_APPEND);
}

die;
$ru = file_get_contents('/home/alex/tasks/944/RU.xml');
$sng = file_get_contents('/home/alex/tasks/944/SNG.xml');
$xml2 = new SimpleXMLElement($ru);
$xml1 = new SimpleXMLElement($sng);

$countryArr = [
    'AM' => 'armenia',
    'AZ' => 'azerbaijan',
    'BY' => 'belarus',
    'KG' => 'kyrgyzstan',
    'KZ' => 'kazakhstan',
    'MD' => 'moldova',
    'TJ' => 'tajikistan',
    'UA' => 'ukraine',
    'UZ' => 'uzbekistan',
    'RU' => 'russia',
];

foreach ($xml1 as $itm1) {
    foreach ($xml2 as $itm2) {
        if ($itm2->airport_name == $itm1->airport_name) {
            continue;
        }

        $fromNAME = $itm1->airport_name;
        $toNAME = $itm2->airport_name;



        if (strripos($fromNAME,',')) {
            $fromNAME = substr($fromNAME, 0, strripos($fromNAME,','));
        }


        if (strripos($toNAME,',')) {
            $toNAME = substr($toNAME, 0, strripos($toNAME,','));
        }

        $start = (mb_strtolower($itm1->airport_name_en));
        $end = (mb_strtolower($itm2->airport_name_en));
        $start = str_replace(', ','-', $start);
        $end = str_replace(', ', '-', $end);
        $start = str_replace(' ','-', $start);
        $end = str_replace(' ', '-', $end);

        $str = '';
        $str .= "Авиабилеты $fromNAME $toNAME; ";
        $str .= "$itm1->airport_iata; $fromNAME; $itm2->airport_iata; $toNAME;";
        $str .= "http://avia.euroset.ru/world/".$countryArr["$itm1->airport_country"]."/$start/$end;\n";
        file_put_contents('/home/alex/tasks/944/res.csv', $str, FILE_APPEND);
    }
}

/* function remComa($str) {
	return substr($str,0,strripos($str,','));
}

 function repcComa($str) {
	return str_replace(', ','-',strripos($str,','));
}*/

die;

$dir = '/www/CONTENTS/Sprav2.xml';
$xml = file_get_contents($dir);
$xml = new SimpleXMLElement($xml);


foreach ($xml as $el) {
    $el = (array)$el->TD;
    var_dump($el);
    /*if ($el[3] == 'false') {
        $upd = "UPDATE `gd_city_tt` SET WHERE `code`='$el[2]';\n";
    } else {
        $upd = "UPDATE `gd_city_tt` SET `location`='$el[4]' WHERE `code`='$el[2]';\n";
    }*/
    $upd = "UPDATE `gd_city_tt` SET `location`='$el[3]' WHERE `code`='$el[2]';\n";

    file_put_contents('/www/CONTENTS/res2.sql', $upd, FILE_APPEND);
}