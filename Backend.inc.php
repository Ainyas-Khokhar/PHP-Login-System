

<?php
session_start();

    function Db_Connection(){
            $dsn = "mysql:host=localhost;dbname=login";
            $dbusername = "root";
            $dbpassword = "";   // use "root"
        try {
            $pdo = new PDO($dsn,$dbusername,$dbpassword);
            $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection Failed: ". $e->getMessage();
        }
    }

    function CheckIfSessionSet(){
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header("Location: login.php");
            exit();
        }
    }

    function Signup_form(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username  = trim($_POST['username']);
            $email     = trim($_POST['email']);
            $password  = trim($_POST['password']);
            
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format.");
        }
        if (empty($username) || empty($password)) {
            die("Username and password are required.");
        }
    
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
        try {
            $pdo = Db_Connection();
    
            $query = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?);";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $email, $passwordHash]);
    
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
    
            header("Location: login.php");
            exit();
    
        } catch (PDOException $e) {
            die("Query Failed: " . $e->getMessage());
        }
    }
    //  else {
    //     // header("Location: .php");
    //     exit();
    // }
    }

    function login_form(){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            if(isset($_POST['email']) && isset($_POST['password'])){
                $email    =   trim($_POST['email']);
                $password =   trim($_POST['password']);
            }
    
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                die("Invaid_Email");
        }
    
        if(empty($email) || empty($password)){
                die("Credentials are required.");
        }
    
        try{
        $pdo = Db_Connection();
            $query = " SELECT id,username,password_hash,user_role FROM users WHERE email=? LIMIT 1; ";
            $stmt  = $pdo->prepare($query);
            $stmt -> execute([$email]);
            $users = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($users){
           if(password_verify($password,$users['password_hash'])){
    
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id']   = $users['id'];
            $_SESSION['username']  = $users['username'];
            $_SESSION['email']     = $email;
            $_SESSION['user_role'] = $users['user_role'];
                            
            header("Location: content.php");
            exit();
        } else{
            header("Location:login.php?error=invalid_credentials");
            exit();
        }
        } else{
            header("Location:login.php?error=invalid_credentials");
            exit();
        }
        }catch(PDOException $e){
            die("Query Failed".$e->getMessage());
        }
        } 
        // else{
        //     header("Location:login.php");
        //     exit();
        // }
    }

    function Content_Page(){
        CheckIfSessionSet();

        if (isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true) {
        try{
        $pdo = Db_Connection();
            $query = " SELECT id,username,password_hash,user_role,profile_pic FROM users WHERE email=? LIMIT 1; ";
            $stmt  = $pdo->prepare($query);
            $users = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($users){
            if(password_verify($password,$users['password_hash'])){

                $_SESSION['logged_in']  = true;
                $_SESSION['user_id']    = $users['id'];
                $_SESSION['username']   = $users['username'];
                $_SESSION['email']      = $email;
                $_SESSION['user_role']  = $users['user_role'];
                $_SESSION['profile_pic']= $users['profile_pic']; 

            header("Location: content.php");
            exit();
        }
        }
        }catch(PDOException $e){
             die("Query Failed".$e->getMessage());
        }
        }
    }

    function Add_Task(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            CheckIfSessionSet();
            if (isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == true) {
                if(isset($_POST['title']) && isset($_POST['description']) && $_POST['status'] ){
                    $title        =   trim($_POST['title']);
                    $description  =   trim($_POST['description']);
                    $status       =   $_POST['status'];
                    $userid       =   $_SESSION['user_id'];
                    $taskid       =   $_SESSION['taskId'];
                }
                else{
                    echo"Fill all the Fields.";
                }
                try{
                $pdo = Db_Connection();
            
                    $query =  "INSERT INTO userActivity (title, description, userId,status) VALUES (?, ?,?, ?);";
                    $stmt  =  $pdo->prepare($query);
                    $stmt ->  execute([$title, $description, $userid,$status]);
            
                header("Location: addtask.php");
                } catch(PDOException $e){
                    die("Query Failed".$e->getMessage());
                }
            } 
        } 
        // else{
        //         header("Location:content.php");
        //         exit();
        // }
    }

    function Change_Password(){
        if($_SERVER['REQUEST_METHOD']  ==  'POST'){
            if(isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])){
                        $old     =  $_POST['oldPassword'];
                        $new     =  $_POST['newPassword'];
                        $confirm =  $_POST['confirmPassword'];
            }

            CheckIfSessionSet();

            if($new  ==  $confirm){
               $pdo = Db_Connection();
                        $query1 = " SELECT email,username,password_hash,user_role FROM users WHERE id=? LIMIT 1; ";
                        $stmt1  = $pdo->prepare($query1);
                        $stmt1 -> execute([$_SESSION['user_id']]);
                        $users = $stmt1 -> fetch(PDO::FETCH_ASSOC);
                try {
                    if($users && password_verify($old,$users['password_hash'])){
                        $confirmHash = password_hash($confirm,PASSWORD_DEFAULT);
                        $query  =  "UPDATE users SET password_hash =? WHERE id =? ;";
                        $stmt   =  $pdo->prepare($query);
                        $stmt  -> execute([$confirmHash,$_SESSION['user_id']]);
                        echo "password changed";
                    } else{
                        echo "Password not changed.";
                      }
                } catch(PDOException $e){
                        die("Query Failed". $e->getMessage());
                }
            } else{
                    echo "password doesn't match.";
            }
        }
        // else{
        //     echo "All fields are reqired.";
        // }
    }

    function Delete_Account(){
       CheckIfSessionSet();
        if($_SERVER['REQUEST_METHOD'] == 'POST' ){
                $email   = $_POST['deleteEmail'];
                $password = $_POST['deletePassword'];
            try {
                    $pdo = Db_Connection();
                    $query1 = " SELECT email,username,password_hash,user_role,profile_pic FROM users WHERE id=? LIMIT 1; ";
                    $stmt1  = $pdo->prepare($query1);
                    $stmt1 -> execute([$_SESSION['user_id']]);
                    $users = $stmt1 -> fetch(PDO::FETCH_ASSOC);
            if( $users['email'] ==  $email && $users && password_verify($password,$users['password_hash'])){
                    $query  =  "DELETE FROM users WHERE id=?;";
                    $stmt   =  $pdo->prepare($query);
                    $stmt  -> execute([$_SESSION['user_id']]);

                    session_unset();
                    session_destroy();
    
                    header("Location:index.php");
                    exit();
                    echo "Account Deleted";
            }
            } catch (PDOException $e) {
                    die("Query Failed".$e->getMesage());
            }
        }
    }

    function Delete_User(){
      CheckIfSessionSet();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $action  =  $_POST['action'];
                $id      =  $_POST['userid'];
        try{
            $pdo = Db_Connection();
            if($action == 'delete'){
                $query  =   "DELETE FROM users WHERE id=?;";
                $stmt   =   $pdo->prepare($query);
                $stmt   ->  execute([$id]);
                header("Location:showusers.php");
                echo"hello";
            }
        }catch(PDOException $e){
                    die("Query Failed".$e->getMessage());
        }
         }
    }

    function Update_User_Task(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $action      =  $_POST['action'];
                $userId      =  $_POST['user_id'];
                $taskId      =  $_POST['task_id'];
                $title       =  $_POST['title'];
                $description =  $_POST['description'];
                $status      =  $_POST['status'];
        try {
                $pdo  =  Db_Connection();
        if($action == 'edit'){
                $query = "UPDATE userActivity SET title = ?, description = ?, status = ? WHERE taskId = ? AND userId = ?;";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$title, $description, $status, $taskId,$userId]);
            
                header("Location: showuserstask.php?update=success");
                exit();
        }
        } catch (PDOException $e) {
                die("Update Failed: " . $e->getMessage());
        }
        }
    }

    