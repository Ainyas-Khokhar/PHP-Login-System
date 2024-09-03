<?php
require_once "Backend.inc.php";
content_Page();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Page</title>

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
<header>
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
        <a href="profile.php" target="_blank" ><button type="button"  class="btn  btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  <?php
  $fullName = $_SESSION['username'];
  $nameParts = explode(' ', $fullName);
  $firstName = $nameParts[0];
   echo htmlspecialchars($firstName); 
   ?>
</button></a>
<form action="logut.inc.php"><button type="submit"  class="btn btn-outline-danger  ms-4">Log out</button></form>
</nav>
<!-- Modal Structure -->
<div class="modal" id="myModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Task</h2>
            <button class="close" id="closeBtn">&times;</button>
        </div>
        <form method="post" action="ToDoList.inc.php">
            <div class="modal-body">
                <div class="grid-header">
                    <div>userID</div>
                    <div></div>
                    <div>Title</div>
                    <div>Description</div>
                    <div>Status</div>
                </div>
                <div class="grid-row">
                    <div><?php
                      echo $_SESSION['user_id'];
                      ?></div>
                    <div></div>
                    <div><input type="text" required name="title" placeholder="Enter title"></div>
                    <div><input type="text" required name="description" placeholder="Enter description" maxlength="100"></div>
                    <div>
                        <select name="status">
                            <option value="none" selected>None</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="custom-modal" id="myCustomModal">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <h2>Your Tasks</h2>
            <button class="custom-close" id="customCloseBtn">&times;</button>
        </div>
        <div class="custom-modal-body">
            <div class="custom-grid-header">
                <div>userID</div>
                <div>TaskID</div>
                <div>Title</div>
                <div>Description</div>
                <div>Status</div>
            </div>
            <?php
            $pdo = Db_Connection();
            $userId = $_SESSION['user_id'];
            $query = "SELECT * FROM userActivity WHERE userId = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$userId]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='custom-grid-row'>";
                echo "<div>" . htmlspecialchars($row['userId']) . "</div>";
                echo "<div>" . htmlspecialchars($row['taskId']) . "</div>";
                echo "<div>" . htmlspecialchars($row['title']) . "</div>";
                echo "<div>" . htmlspecialchars($row['description']) . "</div>";
                echo "<div>" . htmlspecialchars($row['status']) . "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="custom-modal-footer">
            <button   type="button" class="btn btn-danger" class="custom-close-btn" id="customCloseFooterBtn">Close</button>
        </div>
    </div>
</div>
    </header>
    <h1>
        <?php
         echo "Welcome! ". $_SESSION['username']."(" . $_SESSION['user_role'].")";
         ?> 
    </h1>
    <p>You are now viewing the protected content page.</p>
    <div>
    </div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Your custom JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"       integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</body>
</html>