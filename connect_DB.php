<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connect_DB = "localhost";
$database_connect_DB = "ferreteriacolmex";
$username_connect_DB = "root";
$password_connect_DB = "123456contra";
$connect_DB = mysql_pconnect($hostname_connect_DB, $username_connect_DB, $password_connect_DB) or trigger_error(mysql_error(),E_USER_ERROR); 
?>