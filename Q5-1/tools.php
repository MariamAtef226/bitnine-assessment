<?php
require_once('config.php');

   function find_signup($email)
   {
       try {
           $connect = pdo_connect();
           $statment = $connect->prepare("select * FROM `user` WHERE (email = :email)");
           $statment->bindValue("email", $email);
           $statment->execute();

           // if found
           if ($user = $statment->fetchObject()) {
               $connect = null; //end connection before return
               return true;
           } else {
               $connect = null;
               return false;
           }
       } catch (PDOException $e) {
           catchErrorToFile($e->getMessage(), $e->getCode());
           return false;
       }
   }

   function find_login($email, $password)
   {
       try {
           $connect = pdo_connect();
           $statment = $connect->prepare("select * FROM `user` WHERE email = :email and password = :password");
           $statment->bindValue("email", $email);
           $statment->bindValue("password", md5($password));
           $statment->execute();
           // if found
           if ($user = $statment->fetchObject()) {
               $connect = null; //end connection before return                
               return $user;
           } else {
               $connect = null;
               return null;
           }
       } catch (PDOException $e) {
           catchErrorToFile($e->getMessage(), $e->getCode());
           return false;
       }
   }


   function create_user($name,$email, $password)
   {
       try {
           $connect = pdo_connect();
           //use prepare to prevent SQL injection

           // Insert the user to the database
           $statment = $connect->prepare("INSERT INTO `user`(`name`, `email`, `password`, `alert_percent`)
         VALUES (:username,:email,:password, 100)");
           $statment->bindValue("username", $name);
           $statment->bindValue("email", $email);
           $statment->bindValue("password", md5($password));
           $statment->execute();

           // retrieve the created id for this user
           $statment = $connect->prepare("select user_id from `user` where email = :email");
           $statment->bindValue("email", $email);
           $statment->execute();

           $user = $statment->fetchObject();
           $id = $user->user_id;


           $connect = null; //to end connection
           return $id; // return the id of the retrieved user
       } catch (PDOException $e) {
           catchErrorToFile($e->getMessage(), $e->getCode());
           return false;
       }
   }