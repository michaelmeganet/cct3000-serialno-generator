<?php

include_once 'class/dbh.inc.php';
include_once 'class/variables.inc.php';
include_once 'class/phhdate.inc.php';
include_once 'IdGenerate.class.php';

function callSqlInsert($instancetid, $userid, $expiredate, $serialno, $datecreate) {
//    $instancetid,$userid, $expiredate, $serialno,$todaynow

    $insertArray = [];

    $insertArray['instancetid'] = $instancetid;
    $insertArray['userid'] = $userid;
    $insertArray['expiredate'] = $expiredate;
    $insertArray['serialno'] = $serialno;
    $insertArray['datecreate'] = $datecreate;
    $cnt = 0;
    foreach ($insertArray as $key => $value) {
        $cnt++;
        ${$key} = $value;
        echo "$cnt)  $key : $value\n" . "<br>";
//                    debug_to_console("$key => $value");
    }
    $arrayKeys = array_keys($insertArray);    //--> fetches the keys of array
    ##$lastArrayKey = array_pop($insertArray); //--> fetches the last key of the compiled keys of array
    end($insertArray); // move the internal pointer to the end of the array
    $lastArrayKey = key($insertArray);  // fetches the key of the element pointed to by the internal pointer
    $sqlInsert = "INSERT INTO serialtable SET ";
    #begin loop
    foreach ($insertArray as $key => $value) {

        ${$key} = trim($value);
        $columnHeader = $key; // creates new variable based on $key values
        //echo $columnHeader." = ".$$columnHeader."<br>";

        /* $dbg->review($columnHeader." = ".$$columnHeader."<br>"); */ //this is for debugging, not yet implemented

        $sqlInsert .= $columnHeader . "=:{$columnHeader}";     //--> adds the key as parameter
        if ($columnHeader != $lastArrayKey) {
            $sqlInsert .= ", ";      //--> if not final key, writes comma to separate between indexes
        } else {
            #do nothing         //--> if yes, do nothing
        }
    }
    # end loop

    echo "\$sqlInsert = $sqlInsert <br>";
    $objInsert = new SQLBINDPARAM($sqlInsert, $insertArray);
    print_r($objInsert);
    echo "<br>";
    $result = $objInsert->InsertData2();
    echo "$result <br>";
    return $result;
}

function insertSQL($instancetid, $userid, $expiredate, $serialno, $datecreate) {
    $sqlInsert = "INSERT INTO serialtable SET instanceid = '$instancetid', "
            . " userid = '$userid', expiredate = '$expiredate' , serialno = '$serialno',"
            . " datecreate = '$datecreate';";
    echo "$sqlInsert = $sqlInsert <br>";
    $objinsert = new SQL($sqlInsert);
    $result = $objinsert->InsertData();
    echo "$result<br>";
}

function generate_runno($j) {
    $date = new DateTime();
    $date->setDate(2020, 10, 3);
    echo $date->format('Y-m-d') . " | ";
    $expiredate = $date->format('Y-m-d');
    // $j = 1001; //only one user/machine ID
//    $datetimenow = time();
    $datecreate = date('Y-m-d H:i:s');

//    $datecreate = date("Y-m-d", strtotime($datetimenow));
    echo "$datecreate " . "<br>";
    $serialno = 0;
//    $instantid = [];
    for ($i = 1; $i < 10; $i++) {
        # code...
        //with in 100 time loop of $i

        $params = array('work_id' => $j,);
        $idGenerate = IdGenerate::getInstance($params);
        $instancetid = $idGenerate->generatorNextId();
        $serialno++;
        $sid = '';
        // return $id;
        // Prints the day, date, month, year, time, AM or PM
        insertSQL($instancetid, $j, $expiredate, $serialno, $datecreate);
        echo "work_id = $j, \$instancetid = $instancetid    |   " . $datecreate . " | expireddate = $expiredate | $serialno<br>";
        // echo "work_id = $j, \$id = $id    |   " . date("l jS \of F Y h:i:s A") . " <br>";date_format($expiredate, 'd/m/Y');
        // sleep(1);
    }
//    echo"<br>list down array \$instancetid<br>";
//    print_r($instancetid);
//    echo "<br>";
    return $instancetid;
}

$userid1 = 'cct3000';
$getID1 = generate_runno($userid1);

//$userid1 = 'cct3000';
//$userid2 = 'michael';
//$getID1 = generate_runno($userid1);
//$getID2 = generate_runno($userid2);
//$all_IDsets = array_merge($getID1, $getID2);
//echo"<br>list down array \$instantid<br>";
//$serialno = 0;
//foreach ($all_IDsets as $key => $value) {
//    $serialno++;
//    echo " $value | $serialno" . "<br>";
//}
//echo "<br>";
