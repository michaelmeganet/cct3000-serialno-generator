<?php
include_once('phpqrcode-2010100721_1.1.4/phpqrcode/qrlib.php');
if (isset($_GET['code'])){
    $code = urldecode($_GET['code']);
}

QRcode::png($code, false, '', 4, 0);//jobcode, output filename, error correction, each code square pixel, outside border range
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

