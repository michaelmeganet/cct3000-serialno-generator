<?php

include_once 'IdGenerate.class.php';

function generate_runno($j) {
    $date = new DateTime();
    $date->setDate(2020, 10, 3);
    echo $date->format('Y-m-d') . " | ";
    $expiredate = $date->format('Y-m-d');
    // $j = 1001; //only one user/machine ID
    $datetimenow = time();
    echo(date("d-m-Y", $datetimenow)) . "<br>";

    $instantid = [];
    for ($i = 1; $i < 10; $i++) {
        # code...
        //with in 100 time loop of $i

        $params = array('work_id' => $j,);
        $idGenerate = IdGenerate::getInstance($params);
        $id = $idGenerate->generatorNextId();
        //$serialno++;
        // return $id;
        // Prints the day, date, month, year, time, AM or PM
        array_push($instantid, $id);
        echo "work_id = $j, \$id = $id    |   " . date("l jS \of F Y h:i:s A") . " | expireddate = $expiredate <br>";
        // echo "work_id = $j, \$id = $id    |   " . date("l jS \of F Y h:i:s A") . " <br>";date_format($expiredate, 'd/m/Y');
        // sleep(1);
    }
//    echo"<br>list down array \$instantid<br>";
//    print_r($instantid);
//    echo "<br>";
    return $instantid;
}

$userid1 = 'cct3000';
$userid2 = 'michael';
$getID1 = generate_runno($userid1);
$getID2 = generate_runno($userid2);
$all_IDsets = array_merge($getID1, $getID2);
echo"<br>list down array \$instantid<br>";
$serialno = 0;
foreach ($all_IDsets as $key => $value) {
    $serialno++;
    #echo " $value | $serialno" . "<br>";
    echo "Serial Number : $serialno<br>";
    $urlencode_value = urlencode($value);
    #echo "\$value = $value, encoded to ===> $urlencode_value<br>";
    ?>
    <img src="qrcodeimage.php?code=<?php echo $urlencode_value; ?>"/>
    <?php
    echo "<br>";
    echo "======================================================<br>";
}
echo "<br>";


//        ${$key} = $value;
//        // echo "$key : $value\n"."<br>";