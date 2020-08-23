<?php
// Initialize the session
session_start(); 
if($_SESSION["loggedin"]!==true)
{ 
  $_SESSION = array(); 
// Destroy the session
session_destroy(); 
// Redirect to login page
header("location: signin.php");
exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width= device-width , initial-scale=1">
<title>About</title>
<!-- The css link for the bootstrap. -->
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- css file needed for padding the top of the page -->
<link href="css/blog-home.css" rel="stylesheet">

</head>
<body>

 <!-- Navigation bar containing all the tabs (home, about ,contact , sign in) -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <!-- navbar-brand name has been changed according to the specification of the assignment "Daily Journal" -->
      <a class="navbar-brand" href="#">Daily Journal</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!--This div consist of the tabs in the collapsible navbar -->
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home </a>
          </li>
          <!-- The current page is About so it is made to be active -->
          <li class="nav-item active">
            <a class="nav-link" href="#">About
                <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addpost.php">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signin.php">Sign In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

 <!-- Page Content has been divided into columns -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">About Me</h1>

        

        <!-- Post Content  will contain description of the author-->
        
          <?php
            //initiating the connection with mysql using object approach
            require_once 'login.php';
           
            $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
              if ($conn->connect_error)
               { 
                echo"<p>Connection failed!" . mysqli_connect_error()."</p>"; 
               }
               $myquery= "SELECT * FROM Users";

               
               //query database
               if ($result =  mysqli_query($conn,$myquery)) 
               {
                while ($row = $result->fetch_assoc()) 
                {//result as assoc. array
                 $text=sprintf("%s", $row["Profile"]);
                 $image=sprintf("%s", $row["ImageFName"]);
                // Preview Image
                   echo" <img class=\"img-fluid rounded\" src=\"Files/".$image."\" alt=\"\">

                      <hr>";
                 echo "<p class=\"lead\">".$text."</p>";

               }
              }

              
             $conn->close();


          ?>
        
        <hr>


      </div>
  <!-- Sidebar Widgets Column contains the 3 widgets
  1. Search Widget containing the search are that the user can use to search for the posts
  2. Categories Widget: containg the categories of the posts and can choose accordingly to interests.
  3. Side Widget will help in designing more stuff in future assignments and work as a place holder for them.-->
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget for future usage in the assignments. It will work
    as a container. -->
        <div class="card my-4">
        <h5 class="card-header">Log Out</h5>
        <div class="card-body">
          Logout of your account.
          <br>
          <br>
          
          <form method="POST">
            
            <button type="submit" class="btn btn-primary" name="log" value="logout">Log Out</button>
        </form>
          <?php
          //logout works on 2 clicks
            if($_POST['log']=="logout")
            {
              session_destroy(); 
              $_SESSION["loggedin"]=false;
            }
          ?>
         
        </div>
      </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>
<!--JS link for the bootstrap-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>