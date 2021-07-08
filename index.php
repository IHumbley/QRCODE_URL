<?php
/*
DESCRIPE: ＱＲ ＣＯＤＥ ＭＡＫＥＲ ＡＰＩ
*/

header ('Content-Type: image/png');
$error_image_ong = 'https://img.pngio.com/rsbywbhealthgovin-images-error-png-250_250.png'; // it must be png when not work show error picture
$config = ["size"=>1000,"download"=>"imageUrl","file"=>"png",'config'=>[
    "body"=>"square",
    "eye"=>"frame0",
    "eyeBall"=>"ball0",
    "erf1"=>[],
    "erf2"=>[],
    "erf3"=>[],
    "brf1"=>[],
    "brf2"=>[],
    "brf3"=>[],
    "bodyColor"=>"#000000",
    "bgColor"=>"#FFFFFF",
    "eye1Color"=>"#000000",
    "eye2Color"=>"#000000",
    "eye3Color"=>"#000000",
    "eyeBall1Color"=>"#000000",
    "eyeBall2Color"=>"#000000",
    "eyeBall3Color"=>"#000000",
    "gradientColor1"=>"",
    "gradientColor2"=>"",
    "gradientType"=>"linear",
    "gradientOnEyes"=>"true",
    "logo"=>"", //if you want to show your logo in center of QR code please set url that you upload it
    "logoMode"=>"default"]
]; //you can change defult config value of QR output setting 

/*
DESCRIPE: ＱＲ ＣＯＤＥ ＭＡＫＥＲ ＡＰＩ
*/

function Qr_code_generator($url){
    if (preg_match('/(http:\/\/|https:\/\/)(.+)/i', $url)){
        global $config;
        global $error_image_ong;
        $config['data'] = $url;
        $ch=curl_init('https://api.qrcode-monkey.com/qr/custom');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($config));
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        if(!curl_error($ch)){
            $res = substr($res, curl_getinfo($ch, CURLINFO_HEADER_SIZE)+17,-2);
            $res = str_replace('\\',"",$res);
            return file_get_contents("https://".$res);}
        curl_close($ch);
    }
}
$url = $_GET['url']; 
/*
DESCRIPE: ＱＲ ＣＯＤＥ ＭＡＫＥＲ ＡＰＩ
*/
$outputAddress = Qr_code_generator($url);
echo $outputAddress;
echo file_get_contents($error_image_ong); //if not work
?>
