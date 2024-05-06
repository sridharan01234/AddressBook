<?php
require_once "../Model/UserModel.php";

$init = new UserModel();

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateRandomNumber($length) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

$data = [
    "name"=> generateRandomString(6),
    "address"=> generateRandomString(20),
    "age"=> random_int(20,30),
    "phone"=> generateRandomNumber(8),
    "pincode"=> generateRandomNumber(6),
    "user_id"=> 1,
    "country_id"=> 1,
    "state_id"=> 1,
];

var_dump($init->insert('contacts',$data,1));