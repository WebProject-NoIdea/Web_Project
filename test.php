<?php

$pwd64 = base64_encode("12345678");
$password = md5($pwd64);
echo $password;