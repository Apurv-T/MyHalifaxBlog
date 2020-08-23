<?php
// Initialize the session
session_start(); 



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width= device-width , initial-scale=1">
<title>Add Post</title>
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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="About.php">About</a>
          </li>
          <!-- The current page is Contact so it is made to be active -->
          <li class="nav-item active">
            <a class="nav-link" href="#">Add Post
            <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signin.php">Sign In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content has been divided into columns
  This template is the post.php template.
  The changes that have been made are for the container page is mainly removing the comment part,
  leave a comment part, nested comments.-->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">Add a Post</h1>
       <!--The post contents have been changed to a line of introduction for the contact us page.
       -->
        <!-- Post Content -->
        <!--This is the form that will be used by the user to enter his name and email id to 
        contact the owner of the post. 
        This template was taken from:
        https://getbootstrap.com/docs/4.0/components/forms/
        On: 30th September 2019
        link form the assignment1.
        -->
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="title"aria-describedby="emailHelp" placeholder="Title ">
            </div>
            <label for="exampleInputEmail1">Your Post</label>
                <br>
                <textarea rows="4" cols="80" name="post"> Add here input</textarea>
                <br>
                <label for="exampleInputEmail1">Image Name</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="img" placeholder="Image name Input">
                <br>
                <br>
            
            
                <button type="submit" class="btn btn-primary" name="formSubmit" value="Submit">Submit</button>
        </form>
        <?php
            require_once 'login.php';
           
            $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
              if ($conn->connect_error)
                { 
                  echo"<p>Connection failed!" . mysqli_connect_error()."</p>"; 
                }
              if(isset($_POST['formSubmit'])){
                if($_POST['formSubmit'] == "Submit"){
                 
                        $myquery="INSERT INTO Posts
                        (UserID, Title, ImageFName, Post) 
                        VALUES('". $_SESSION["userid"]."','".$_POST['title']."', '".$_POST['img']."', '".$_POST['post']."' )";
                        $result=mysqli_query($conn,$myquery);

                      }
                    }
                  
                      $conn->close();
                  
        ?>

        </div>
        <!--Sidebar has the same specifications as the homepage or index.php-->
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
