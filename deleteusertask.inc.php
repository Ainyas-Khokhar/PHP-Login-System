<?php
require_once "Backend.inc.php";
    CheckIfSessionSet();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $action  =  $_POST['action'];
            $id      =  $_POST['taskid'];
        try{
            $pdo  =  Db_Connection();
        if($action == 'delete'){
            $query  =   "DELETE FROM userActivity WHERE taskId=?;";
            $stmt   =   $pdo->prepare($query);
            $stmt   ->  execute([$id]);
            header("Location:showuserstask.php");
            exit();
        }
        }catch(PDOException $e){
            die("Query Failed".$e->getMessage());
        }
        }