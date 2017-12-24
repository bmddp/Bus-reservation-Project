<?php
/**
 * Created by PhpStorm.
 * User: fahim
 * Date: 4/21/17
 * Time: 10:38 PM
 */
session_start();
session_destroy();
header("location: index.php");
exit();

?>