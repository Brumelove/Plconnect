<?php
require "test.php";
$obj = new test();
$result = $obj->insert();
print_r(['message'=>$result]);
?>