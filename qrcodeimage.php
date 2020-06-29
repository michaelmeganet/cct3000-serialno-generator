<?php
include_once('phpqrcode-2010100721_1.1.4/phpqrcode/qrlib.php');
if (isset($_GET['code'])){
    $code = urldecode($_GET['code']);
    $filename = false; //if don't want to have filename, must be FALSE, not '' / string(0);
    $err_correction = ''; 
    $code_pixel_size = 4; //the size of the QRCode;
    $outside_border_range = 0; //border around the QRCode.
}

QRcode::png($code, $filename, $err_correction, $code_pixel_size, $outside_border_range);//value, output filename, error correction, each code square pixel, outside border range
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

