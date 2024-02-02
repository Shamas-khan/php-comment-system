<?php

$host = "localhost";
$username = 'id21854173_root';
$password = 'skt@noli123S';
$dbname = 'product_review';

$con = mysqli_connect($host, $username, $password, $dbname);


if (!($con)) {
    echo "Not Connected!!";
}