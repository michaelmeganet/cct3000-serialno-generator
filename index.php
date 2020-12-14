<?php
include_once 'class/dbh.inc.php';
include_once 'class/variables.inc.php';
include_once 'class/phhdate.inc.php';
include_once 'IdGenerate.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>get a new running no </title>
        <script type="text/javascript">
            function submitform()
            {
                document.frmnewrunno.submit();
            }
        </script>
    </head>
    <body>
        <?php
## get lastest serial no
//if (isset($_POST('instance_id'))) {
//    if (isset($_POST('newrunno'))) {
//        $instance_id = $_POST('instance_id');
//        $new_runno = $_POST('newrunno');
//        echo "\$instance_id = $instance_id , \$new_runno = $new_runno <br> ";
//        if ($instance_id == $new_runno) {
//            header("Refresh:0");
//        }
//    }
//}
        $sql = "SELECT datecreate, instanceid, serialno, userid FROM serialtable ORDER BY sid DESC LIMIT 0, 1";
        $objRunno = new SQL($sql);
        $recordset = $objRunno->getResultOneRowArray();
        $serialno = $recordset['serialno'];
        $datecreate = $recordset['datecreate'];
        $instanceid = $recordset['instanceid'];
        $instanceid = (int) $instanceid;
        $userid = $recordset['userid'];

        echo "\$serialno = $serialno with instanceid = $instanceid, userid = $userid, created no $datecreate <br>";
        if (isset($userid) && isset($_SESSION['user'])) {
            if ($userid != $_SESSION['user']) {
                echo "Hello " . $_SESSION['user'] . " : <br>";
                echo "This runningno (serialno) $serialno have been taken by other user with user id $userid <br>";
            }
        }
//echo "newrunno = $newrunno <br>";
        echo "<hr>";

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
            echo "\$sqlInsert = $sqlInsert <br>";
            $objinsert = new SQL($sqlInsert);
            $result = $objinsert->InsertData();
            echo "$result<br>";
        }

        function generate_runno($j, $runno, $instanceid2) {
            $date = new DateTime();
            $date->setDate(2020, 10, 3);
            echo $date->format('Y-m-d') . " | ";
            $expiredate = $date->format('Y-m-d');
            // $j = 1001; //only one user/machine ID
//    $datetimenow = time();
            $datecreate = date('Y-m-d H:i:s');

//    $datecreate = date("Y-m-d", strtotime($datetimenow));
            echo "$datecreate " . "<br>";
            $serialno = $runno;
//    $instantid = [];
            for ($i = 1; $i < 2; $i++) {
                # code...
                //with in 100 time loop of $i

                $params = array('work_id' => $j,);
                $idGenerate = IdGenerate::getInstance($params);
                $instancetid = $idGenerate->generatorNextId();
                //$serialno++;
                $sid = '';
                // return $id;
                // Prints the day, date, month, year, time, AM or PM
                $sql = "SELECT datecreate, instanceid, serialno FROM serialtable ORDER BY sid DESC LIMIT 0, 1";
                $objcheckInstance = new SQL($sql);
                $recordset = $objcheckInstance->getResultOneRowArray();
                $instanceidcheck = $recordset['instanceid'];
                $serial_no = $recordset['serialno'];
                echo "\$instanceidcheck = $instanceidcheck , \$instanceid2 = $instanceid2 <br>";
                echo "\$serial_no = $serial_no <br>";
                $sql2 = "SELECT datecreate, instanceid, serialno FROM serialtable ORDER BY sid DESC LIMIT 0, 1";
                $objcheckInstance2 = new SQL($sql2);
                $recordset2 = $objcheckInstance2->getResultOneRowArray();
                $instanceidcheck2 = $recordset2['instanceid'];
                $serial_no2 = $recordset2['serialno'];
                $serial_no2 = (int) $serial_no2;
                $serial_no = (int) $serial_no;
                $serialno = (int) $serialno;
                echo "\$instanceidcheck2 = $instanceidcheck2 , \$instanceid2 = $instanceid2 <br>";
                echo "\$serial_no = $serial_no <br>";
                if ($serial_no2 > $serialno) {
                    $serialno = $serial_no2;
                }

                if ($instanceid2 != $instanceidcheck2) {
                    $serialno = $serial_no;
                    insertSQL($instancetid2, $j, $expiredate, $serialno, $datecreate);
                } else {
                    insertSQL($instancetid, $j, $expiredate, $serialno, $datecreate);
                }

                echo "work_id = $j, \$instancetid = $instancetid    |   " . $datecreate . " | expireddate = $expiredate | $serialno<br>";
            }
//    echo"<br>list down array \$instancetid<br>";
//    print_r($instancetid);
//    echo "<br>";
            return $serialno;
        }

        if (isset($_POST['newrunno'])) {
            if (isset($_POST['user'])) {
                $user = $_POST['user'];
                $user = trim(preg_replace('/\s+/', ' ', $user));
                echo "the user is id $user <br>";
                $stripped_userid = trim(preg_replace('/\s+/', ' ', $user));
                $_SESSION['user'] = $stripped_userid;
            }
            $instanceid = $recordset['instanceid'];
            $newrunno = $_POST['newrunno'];

            echo "newrunno = $newrunno, serialno = $serialno <br>";
            $newrunno = (int) $newrunno;
            //$newrunno++;
            if ($newrunno == $serialno) {
                header("Refresh:0");
            } elseif ($newrunno < $serialno) {
                header("Refresh:0");
            } elseif ($newrunno > $serialno) {


                $userid1 = $user;
                //$objGenerate = new IdGenerate($userid1);
                $getID1 = generate_runno($userid1, $newrunno, $instanceid);
                //var_dump($getID1);
                // submitform();
                echo '<script type="text/javascript">',
                'submitform();',
                '            function submitform()
            {
                document.frmnewrunno.submit();
            }',
                '</script>';
            }
            echo "<br>";
        } elseif (isset($serialno)) {

            $newrunno = $serialno;
            $newrunno++;
        }
        ?>

        <form action="" name="frmnewrunno" method="POST">
            <label for="fname">Running no:</label><br>
            <input type="text" style="text-align:left;" id="newrunno" name="newrunno"
            <?php
            if (isset($newrunno)) {
                ?>
                       value = "<?php echo $newrunno; ?>">
                       <?php
                   }
                   ?><br>
            <label for="fusername">User ID:</label><br>
            <input type="text" style="text-align:left;" id="user" name="user" value="
            <?php
            if (isset($_SESSION['user'])) {
                $stripped_userid = trim(preg_replace('/\s/', ' ', $_SESSION['user']));

                echo $stripped_userid;
            } else {

            }
            ?>">
            <input type="submit" value="Submit"><br>
            <input type="hidden" id="instance_id" name="instance_id" value="
                   <?php echo $instanceid; ?>"><br>

            <?php
//                   if (isset($userid) && isset($_SESSION['user'])) {
//                       $sessionuserid = $_SESSION['user'];
//                       $stripped_userid = trim(preg_replace('/\s+/', ' ', $userid));
//                       $stripped_sessionuserid = trim(preg_replace('/\s+/', ' ', $sessionuserid));
//                       if ($userid != $_SESSION['user']) {
//
//                       }
//                   }
            ?>

        </form>

    </body>
</html>
<?php
//$getID1 = generate_runno($userid1);
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
?>