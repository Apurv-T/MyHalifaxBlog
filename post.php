<?php
// Initialize the session
session_start(); 
if($_SESSION["loggedin"]===FALSE)
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
<title>Post</title>
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
        <!-- The current page is Post so Home is made to be active -->
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home
              
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addPost.php">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sign In</a>
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

        <?php
          
          require_once 'login.php';
           
          $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
          if ($conn->connect_error)
           { 
            echo"<p>Connection failed!" . mysqli_connect_error()."</p>"; 
           }
           $title=$_GET['title'];
           if($title=="It's almost summer!")
           {
               $title="It\'s almost summer!";
               $myquery="SELECT * 
                      FROM Posts 
                      WHERE Title='".$title."'";
           }
           else{
           $myquery="SELECT * 
                      FROM Posts 
                      WHERE Title='".$title."'";
           }

            $user_query="SELECT * 
                          FROM Users
                          WHERE UserID=1";

           $res =  mysqli_query($conn,$user_query);
           $user_row=$res->fetch_assoc();
             $author=sprintf("%s", $user_row["Name"]);
           //query database
           if ($result =  mysqli_query($conn,$myquery)) 
           {
            while ($row = $result->fetch_assoc()) 
            {//result as assoc. array
             $postID=sprintf("%s", $row["PostID"]);
             $image=sprintf("%s", $row["ImageFName"]);
             $post=sprintf("%s", $row["Post"]);
             date_default_timezone_set('America/Halifax');
             
             $date=sprintf("%d", $row["Date"]);
             
            // Preview Image
              
            //title
                echo" <h1 class=\"mt-4\">$title</h1>";
             //author
                echo"<p class=\"lead\">by <a href=\"About.php\">$author</a></p><hr>";
                //i tried printing the right date, but doesnt work the right way
                 echo"<p>".date("Y-m-d  G:i:s", $date)."</p><hr> ";
              //Preview Image is same which is provided to us with the assignment
                 echo "<img class=\"img-fluid rounded\" src=\"Files/$image\" alt=\"\"><hr>";
              //post content from the file provided to us.
                   echo "<p class=\"lead\">".$post."</p><hr>";

           }
          }
    
          
         $conn->close();


          //comments form
          echo "<div class=\"card my-4\"><h5 class=\"card-header\">Leave a Comment:</h5> <div class=\"card-body\"><div class=\"card-body\"><form><div class=\"form-group\"><textarea class=\"form-control\" rows=\"3\"></textarea> </div><button type=\"submit\" class=\"btn btn-primary\">Submit</button></form></div></div></div>";

         
          
          echo "<div class=\"media mb-4\"><img class=\"d-flex mr-3 rounded-circle\" src=\"http://placehold.it/50x50\" alt=\"\"><div class=\"media-body\"><h5 class=\"mt-0\">Commenter Name</h5>$chr
                 </div>
            </div>";
          



        ?>
        <!-- Comment with nested comments -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

          </div>
        </div>

      </div>
      

      

      <!-- Sidebar Widgets Column contains the 3 widgets
  1. Search Widget containing the search are that the user can use to search for the posts
  2. Categories Widget: containg the categories of the posts and can choose accordingly to interests.
  3. Side Widget will help in designing more stuff in future assignments and work as a place holder for them.-->
      <!-- Sidebar Widgets Column -->
       <!-- Sidebar Widgets Column contains the 3 widgets
  1. Search Widget containing the search are that the user can use to search for the posts
  2. Categories Widget: containg the categories of the posts and can choose accordingly to interests.
  3. Side Widget will help in designing more stuff in future assignments and work as a place holder for them.-->
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
          <button name="log" value="logout" class="btn btn-secondary" type="button" method="Post">Logout</button>
          <?php
            if($_POST['log']=="logout")
            {
            $_SESSION["loggedin"]=false;
            // Unset all of the session variables

            }
          ?>
        </div>
      </div>
</div>

</div>
<!-- /.row -->

</div>
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