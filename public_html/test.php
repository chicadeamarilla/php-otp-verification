<?php


$pass = 123456;

$encrypt_pass = md5($pass);

echo $encrypt_pass."<br>";


$user_pass = 123456;



if(md5($user_pass)== $encrypt_pass){
    echo "pass OK<br>";
}else{
    echo "pass faield <br>";
    
}





