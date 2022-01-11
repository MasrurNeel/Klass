<?php
 class User{
     private $username, $phone_number;

     /**
      * @param mixed $username
      */
     public function setUsername($username)
     {
         $this->username = $username;
     }
     public function setPhoneNumber($phone_number)
     {
         if(strlen($phone_number) === 11) {
             $this->phone_number = $phone_number;
         }
     }

     /**
      * @return mixed
      */
     public function getUsername()
     {
         return $this->username;
     }

     /**
      * @return mixed
      */
     public function getPhoneNumber()
     {
         return $this->phone_number;
     }
 }
 $shohan = new User();
 $shoharto->setUsername('Shoharto');
 $shoharto->setPhoneNumber('02222222222');
 echo $shoharto->getPhoneNumber();
 echo '<br/>';

$shohan = new User();
$shoharto->setUsername('Shoharto');
$shoharto->setPhoneNumber('02222222222');
echo $shoharto->getPhoneNumber();

?>