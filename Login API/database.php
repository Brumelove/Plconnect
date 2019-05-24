<?php
  include ("dbConfig.php");
class database {
    // attempts to delete existing entries and save verification code in DB with phone number
    public function updateDatabase($phoneNumber, $code) {
        $DBH =  new dbConfig();
        $con = $DBH->connect();
        if (!is_a($con, 'PDO')) {
            echo 'PDO is false';
          return $con;
        }

        // Assuming US country code for example
        $params = [ 'phoneNumber' => '1' . $phoneNumber ];

        try {
            $stmt = $con->prepare("DELETE FROM mobilenumbers WHERE phone_number=:phoneNumber");
            $stmt->execute($params);

            $params['code'] = $code;
            $stmt = $con->prepare("INSERT INTO mobilenumbers (phone_number, verification_code) VALUES(:phoneNumber, :code)");
            $stmt->execute($params);

        } catch(PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        }

        return $code;
    }

    public function matchVerificationCode($phoneNumber, $code) {
        $DBH =  new dbConfig();
        $con = $DBH->connect();
        if (!is_a($con, PDO::class)) {
            echo 'ERROR: PDO is false';
            return 'ERROR: PDO is false '.$con;
        }

        $params = [ 'phoneNumber' => $phoneNumber ];

        try {
            $stmt = $con->prepare("SELECT * FROM mobilenumbers WHERE phone_number=:phoneNumber");
            $stmt->execute($params);

            $result = $stmt->fetch();
            $response = 'unverified';
            if ($result['verification_code'] == $code) {
                $stmt = $con->prepare("UPDATE mobilenumbers SET verified = 1 WHERE phone_number=:phoneNumber");
                $stmt->execute($params);
                $response = 'verified';
            }

            return $response;

        } catch(PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }

    public function statusIs($phoneNumber) {

        $DBH =  new dbConfig();
        $con = $DBH->connect();
        if (!is_a($con, 'PDO')) {
            echo 'PDO is false';
            return $con;
        }

        $params = [ 'phoneNumber' => $phoneNumber ];

        try {
            $stmt = $con->prepare("SELECT * FROM mobilenumbers WHERE phone_number=:phoneNumber");
            $stmt->execute($params);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result['verified'] == 1) {
                return 'verified';
            }

            return 'unverified';

        } catch(PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }
}
?>
