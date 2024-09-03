<?php  
require_once "Backend.inc.php";
Change_Password();
Delete_Account();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="content.css">
    <link rel="stylesheet" href="todolist.css">
    <link rel="stylesheet" href="profile.css">
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
<form action="logut.inc.php"><button type="submit"  class="btn btn-outline-danger  ms-4">Log out</button></form>
</nav>
<h1> PROFILE </h1>
<div class="profile-container">
    <h2>My Profile</h2>
    <hr>
    <div class="profile-item img"> 
    <?php 
      $pdo  =  Db_Connection();
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $file_name  =  $_FILES['image']['name'];
            $tempname   =  $_FILES['image']['tmp_name'];
            $folder     =  "Images/".$file_name;
              $query    =  "UPDATE users SET picture=? WHERE id=?;";
              $stmt     =  $pdo->prepare($query);
              $stmt    ->  execute([$file_name,$_SESSION['user_id']]);
          }
     ?>
       <form action="" method="post" enctype="multipart/form-data">
       <span class="upload-icon">+</span>
       <input type="file"  name="image" id="profileImage" style="display: none;">
       <?php  
              $result  =  "SELECT picture FROM users WHERE id=?;";
              $stmt1   =  $pdo->prepare($result);
              $stmt1  ->  execute([$_SESSION['user_id']]);
                while($users  =  $stmt1->fetch(PDO::FETCH_ASSOC)){
       ?>
       <img src="Images/<?php echo htmlspecialchars($users['picture']); ?> " alt="" style="margin-top:32px">
       <?php } ?>
       <button style="position:relative;top:-30px;right: -110px;" type="submit" name="submit">submit</button>
       </form>
    </div>
    <div class="profile-details">
        <div class="profile-item">
            <label>Username:</label>
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
        <div class="profile-item">
            <label>Email:</label>
            <span><?php echo htmlspecialchars($_SESSION['email']); ?></span>
        </div>
        <div class="profile-item">
            <label>Status:</label>
            <span><?php echo htmlspecialchars($_SESSION['user_role']); ?></span>
        </div><hr>
        <div class="profile-item">
            <button class="btn-change-password" id="changePasswordBtn">Change Password</button>
        </div>
        <!-- Change Password Form -->
        <form action="profile.php" method="post">
        <div id="changePasswordForm" style="display: none;">
            <div class="profile-item">
                <label  style="font-size:12px;">Old Password:</label>
                <input type="password" id="oldPassword" name="oldPassword" placeholder="Old Password" required>
            </div>
            <div class="profile-item">
                <label  style="font-size:12px;">New Password:</label>
                <input type="password" id="newPassword" name="newPassword"  placeholder="New Password" required>
            </div>
            <div class="profile-item">
                <label  style="font-size:12px;">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <div class="profile-item">
                <button type="submit" class="btn-change-password">Submit</button>
            </div>
        </div>
        </form>
        <center><div>or</div></center>
        <div class="profile-item">
            <button class="btn-change-password" id="deleteAccountBtn">Delete Account</button>
        </div>
        <!-- Delete Account Form -->
        <form action="profile.php" method="post">
        <div id="deleteAccountForm" style="display: none;">
            <div class="profile-item">
                <label  style="font-size:12px;">Email:</label>
                <input type="email" id="deleteEmail" name="deleteEmail" placeholder="Email">
            </div>
            <div class="profile-item">
               <label  style="font-size:12px;">Password:</label>
                <input type="password" id="deletePassword" name="deletePassword" placeholder="Password">
            </div>
            <div class="profile-item">
                <button type="submit" class="btn-delete-account ">Delete Account</button>
            </div>
        </div>
    </div>
</div>
        </form>
<script>
  document.querySelector('.upload-icon').addEventListener('click', function() {
    document.getElementById('profileImage').click();
});

document.getElementById('changePasswordBtn').addEventListener('click', function() {
    document.getElementById('changePasswordForm').style.display = 'block';
    document.getElementById('deleteAccountForm').style.display = 'none';
});

document.getElementById('deleteAccountBtn').addEventListener('click', function() {
    document.getElementById('deleteAccountForm').style.display = 'block';
    document.getElementById('changePasswordForm').style.display = 'none';
});
</script>


<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Your custom JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>