<?php
  include ("dbConfig.php");
class mobileNumber
{
  public function register($firstname,$Surname,$alias,$title,$email,$phone,$occupation)
    {

       try
       {
         $DBH =  new dbConfig();
         $con = $DBH->connect();


          $stmt =$con->prepare("INSERT INTO empmodel(empCode,Surname,firstname,alias,title,email,phone,occupation)
          VALUES(:empCode,:Surname,:firstname,:alias,:title,:email,:phone,:occupation)");

           $stmt->bindparam(":empCode", $empCode);
           $stmt->bindparam(":Surname", $Surname);
           $stmt->bindparam(":firstname", $firstname);
           $stmt->bindparam(":alias", $alias);
           $stmt->bindparam(":title", $title);
           $stmt->bindparam(":email", $email);
           $stmt->bindparam(":phone", $phone);
           $stmt->bindparam(":occupation", $occupation);
           $stmt->execute();
           self::insertIntoUser($email,$email,'Employee',1);
         }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
       return $stmt;
    }



   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }

   public function redirect($url)
   {
       header("Location: $url");
   }

   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }

   public function insertIntoUser($UserName, $Password, $role,$status){

     $DBH =  new dbConfig();
     $con = $DBH->connect();
      $stmt = $con->prepare("INSERT INTO usermodel(UserName,Password,Role,Status) VALUES(:UserName,:Password,:Role,:Status)");
      $stmt->bindparam(":UserName", $UserName);
      $stmt->bindparam(":Password", $Password);
      $stmt->bindparam(":Role", $role);
      $stmt->bindparam(":Status", $status);
      $stmt->execute();


   }
   public function UpdateEmployeemodel($empCode,$Surname,$firstname,$alias,$title,$email,$phone,$occupation){
     $DBH =  new dbConfig();
     $con = $DBH->connect();
      $stmt = $con->prepare("UPDATE INTO empmodel((empCode,Surname,firstname,alias,title,email,phone,occupation)
      VALUES(:empCode,:Surname,:firstname,:alias,:title,:email,:phone,:occupation)");

      $stmt->bindparam(":empCode", $empCode);
      $stmt->bindparam(":Surname", $Surname);
      $stmt->bindparam(":firstname", $firstname);
      $stmt->bindparam(":alias", $alias);
      $stmt->bindparam(":title", $title);
      $stmt->bindparam(":email", $email);
      $stmt->bindparam(":phone", $phone);
      $stmt->bindparam(":occupation", $occupation);
      $stmt->execute();

   }
   public function ViewallData($empCode,$Surname,$firstname,$alias,$title,$email,$phone,$occupation){
     $DBH =  new dbConfig();
    $query = "SELECT * fROM empmodel";
      $con = $DBH->pdoObj()->prepare( $query);
   $con->execute();
   $stmt = $con->fetchAll( PDO::FETCH_ASSOC);

      return $stmt;

    }

   public function DeletebyempCode($empCode,$Surname,$firstname,$alias,$title,$email,$phone,$occupation){
     $DBH =  new dbConfig();
     $con = $DBH->connect();
      $stmt = $con->prepare("DELETE FROM empmodel WHERE empCode = :empCode");

      $stmt->bindparam(":empCode", $empCode);

      $stmt->execute();


   }
   public function ViewbyempCode($empCode,$Surname,$firstname,$alias,$title,$email,$phone,$occupation){
     $DBH =  new dbConfig();
     $con = $DBH->pdoObj();
      $stmt = $con->prepare("SELECT * FROM empmodel WHERE empCode = :empCode");
    $stmt->bindparam(":empCode", $empCode);

   $stmt = $con->fetchAll( PDO::FETCH_ASSOC);
      $stmt->execute();
    }
}
?>
