<?php

$password = "iphpixxelhouse123@";
$password2 = "iphpixxelhouse13@";
$decrypt =  password_hash($password,PASSWORD_DEFAULT);
echo $decrypt;