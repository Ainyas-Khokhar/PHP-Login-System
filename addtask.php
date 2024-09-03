<?php  
require_once "Backend.inc.php";
Add_Task();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tasks</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="content.css">
    <link rel="stylesheet" href="todolist.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon bg-light"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active  text-light" aria-current="page" href="content.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-light" href="#">Link</a>
        </li>
            <?php 
            if($_SESSION['user_role'] == 'admin'){
              echo '<li class="nav-item dropdown">'.
                   '<a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">'.
                   ucfirst($_SESSION['user_role']).
                   '</a>'.
                   '<ul class="dropdown-menu text-light">'.
                   '<li><a class="dropdown-item" href="showusers.php">Show users</a></li>'.
                   '</ul>'.
                   '</li>';
            }
            ?>
<li>
<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    ToDo List
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="addtask.php" id="addTas kLink">Add Task</a></li>
    <hr class="my-2">
    <li><a class="dropdown-item" href="showtask.php" id="trigger ModalLink">Show Tasks</a></li>
  </ul>
</div>
</li>
      </ul>
        <!-- Button trigger modal -->
        <a href="profile.php" ><button type="button" target="_blank" class="btn  btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  <?php
  $fullName = $_SESSION['username'];
  $nameParts = explode(' ', $fullName);
  $firstName = $nameParts[0];
   echo htmlspecialchars($firstName); 
   ?>
</button></a>
<form action="logut.inc.php"><button type="submit"  class="btn btn-outline-danger  ms-4">Log out</button></form>
</nav>
<div class="mb-5"></div>
<div class="mb-5"></div>
<div class="container-sm border p-4  col-md-6" style="border-radius: 10px;background-color:white;">
    <div class="row justify-content-center">
        <div class="">
            <h3>ADD TASK</h3>
            <hr>
        <form action="addtask.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control"  name="title" required id="floatingInput" placeholder="Task Title">
                <label for="floatingInput">Title</label>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Description</span>
                <textarea class="form-control"    name="description" required   aria-label="With textarea"></textarea>
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text"style="height:48px;">Status</span>
            <select class="form-select form-select-lg mb-3"  name="status" required  aria-label="Large select example"> 
                <option value="none" selected>None     </option>
                <option value="Pending">      Pending  </option>
                <option value="Completed">    Completed</option>
            </select>
            </div>
            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>



<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Your custom JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
   integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
   integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
