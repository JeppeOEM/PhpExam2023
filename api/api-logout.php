<?php
session_start();
session_destroy();
header("Location: login.php");
var_dump("ddddd");
exit();
