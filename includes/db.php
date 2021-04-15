<?php

$db['db_host'] = "localhost";
$db['db_user'] = "kenny_admin";
$db['db_pass'] = "LwbiC2018";
$db['db_name'] = "blog";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if($connection) {
//     echo "We are connected";
// } else {
//     echo "Connection failed";
// }


?>