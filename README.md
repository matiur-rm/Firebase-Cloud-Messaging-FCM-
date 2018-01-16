# Firebase-Cloud-Messaging-FCM-
Firebase Cloud Messaging (commonly referred to as FCM), formerly known as Google Cloud Messaging (GCM), is a cross-platform solution for messages and notifications for Android, iOS, and web applications, which currently can be used at no cost.




```

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

?>

```
