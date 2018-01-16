<?php

function sendNotification($token, $payload){
    $url = "https://fcm.googleapis.com/fcm/send";
    $fields = array(
        'to' => $token,  //"/topics/test",//$tokens,
        'data' => $payload
    );
    
    $headers = array(
        'Authorization:key=AAAAQ0XnMtQ:APA91bF72jZCtKiQkrNPuzjXSCX3-hUUCqdRa74eofFh5F4nB3DWwHsVQKcAQsOjd05H-WPOf1HtT68yYtTCwZLaJsRM2qJ2RyMEWgvpzKP3knDSfWqCgfCT-2XQfWsbfrv75mABwT0h',
        'Content-Type:application/json'
    );

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
    $result = curl_exec($ch);
    if($result === FALSE){
        die('CURL FAILED '. curl_error($ch));
    }

    $info = curl_getinfo($ch);

    curl_close($ch);
    return array('result'=>$result,'status'=>$info['http_code']);
}

// $tokens = array("eQV5v7o79i0:APA91bHNXQqtRSk-Q69n--FY5J9a0pHkdgM6RHKfUAUJtj2jBX_XEexVH3NtA1s06lCjMqUWkMx_YGlRP1ZF-NwcgoyhYbTtpgAfJI1Pnf98oMhMXx-nXNoGp-AfxCIdDerMQ0CLNv8t","et9QawU1IoI:APA91bHBc7pvmNOAOfGQA7c_6iyp3o3EcVETwwkuummVotCIFIjaS882WBTJwNd6zL9s27SWIzaA_cucBGoJ-4zjb89i2SCHb3RHs9a9D2Yi2LQQmeqsmbc4d8Jk1IFd-EFoEKENHdC9","f_ouijyeKVY:APA91bFk1G9nfLQiwi6hov5NaKdNC7XPqjMCPE7QbS00swaS8ACXvPoWBH-ATr93R2JF5xeRuMcRBPpoT8wPHcAwLusj0rvnXkjIyzwhlxstHEzbEg9tGmIFlbVgqdOJkD8-KaNih9AM");

// $token = 'APA91bFgS50d1Icvov4YyEChp14eyKpC1ciWIxrEEBtYkEc-ATVvpvJ-MH0zFWueiyXCMSpyg7tyYjH-pwod2lTg_RIesUQo8ysz4jpe3cd4jhVcAfFxHJo';
$token = 'c9BBws7X5dw:APA91bFe1fpPdW1mHrJyju-vAIdD6PVAfzmGgEQSAqTgIJ4yRnFdcdNAN-bWfOqmwdCDEdqF4HUF9A52HkBoQEsaRLm7hv9CGXoHKRvHeZmPdmdHlP2F8esiL_SKIGe4SD6sQMpZ_gMC';

$message = array(
    'image'              => "http://www.connectingmass.com/notification_test/monpura.jpg",
    'notificationHeader' => 'Title Text',
    'notificationText'   => 'Body Text',
    'resourceUrl'        => 'http://google.com',
    'notificationType'   => 'SMALL'
);
$messageLarge = array(
    
    'image'              => "http://connectingmass.com/notification_test/jspromise.jpg",
    'notificationHeader' => 'Title Text',
    'notificationText'   => 'Body Text',
    'resourceUrl'        => 'http://google.com',
    'notificationType'   => 'LARGE'
);
$messageLogout = array(
    
    // 'image'              => "http://connectingmass.com/notification_test/jspromise.jpg",
    'notificationHeader' => 'New Login',
    'notificationText'   => 'Your account has been logged-in from another device',
    'resourceUrl'        => 'http://google.com',
    'notificationType'   => 'LOGOUT'
);

try{
    $sendResponse = sendNotification($token,$messageLarge);
    echo '<pre>';
    print_r($sendResponse);
}catch(Exception $ex){
    echo $ex->getMessage();
}