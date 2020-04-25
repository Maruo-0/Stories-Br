<?php
/*
define('DB_HOST', 'localhost');
define('DB_USER', 'id11678826_root');
define('DB_PASS', '123456789');
define('DB_NAME', 'id11678826_stories');*/
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'stories');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//check connection
if(mysqli_connect_errno()){
    //connection failed
    echo 'Failed to connect to MySQL'. mysqli_connect_errno();
}