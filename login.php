<?php
require_once "Backend.inc.php";
login_form();
?>
<!DOCTYPE html>
<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>

    <header>
        <div class="header">
            <a href="#default" class="logo">LOG-IN SYSTEM</a>
            <div class="header-right">
              <a class="active" href="index.php">Home</a>
              <a href="#contact" >Contact</a>
              <a href="#about">About</a>
            </div>
          </div>
         <!-- <div class="button"> <a href="signup.html"><button type="button" class="btn btn-outline-primary">Create an account</button></a></div> -->
    </header>

    <div class="main">
        <div class="work">

            <form action="login.php" method="post">
                <h1>Login</h1>
                <div class="inputbox">
                    <!-- <label for="name">Name</label> -->
                    <input type="email" id="name" name="email" placeholder="E-Mail" required autofocus ><i class="fa-solid fa-user"></i>
                    <!-- <label for="pass">Password</label> --> 
                    <input type="password" id="pass"  name="password" placeholder="Password"  required><i class="fa-solid fa-key"></i>
                </div>
                <div class="btn">
                    <button type="submit">Login</button>
                </div>
                <hr>
                <div class="login">
                    <p>Don't have an account?<a href="index.php">Register</a> </p>
                </div>

            </form>
        </div>
    </div>

    <footer>
        <div class="footer">
            <div class="footer-left">
                <div>
                <a href="#contact"  id="contact">Contact</a> <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus in sapiente ullam eligendi minima cum maxime ipsum sit nostrum incidunt?</p>
            </div>
                <div>
                <a href="#about"  id="about">About</a>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Assumenda deleniti voluptatum, vitae quae facilis nostrum eveniet architecto repellat inventore.</p>
            </div>
            </div>
            <div class="footer-right">
                <p>&copy; 2024 Company Name. All rights reserved.</p>
            </div>
        </div>
        
    </footer>
</body>
</html>