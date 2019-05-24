<?php

require "dbConfig.php";


class test {
     public function insert() {
        $DBH = new dbConfig();
        $STH = $DBH->connect()->exec("INSERT INTO mobilenumbers (id,phone_number, verification_code, verified) VALUES(1,'08136915646', '675785', 1)");
        return 'Success';
    }
}

?>
