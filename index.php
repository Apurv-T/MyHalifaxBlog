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
  <title>HomePage</title>
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
            <!-- The current page is Home so it is made to be active -->
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="addPost.php">Add Post</a>
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

  <!-- Blog Entries Column -->
  <div class="col-md-8">

    <h1 class="my-4">Dalhousie Blog
      <small><a href="about.php">Apurv Tripathi</a></small>
    </h1>

    <!-- Blog Post are containers of Post Title and followed by 20 words of the post and then there is a button Read More
    which has been connected to the post.php that contains currently static data about the full post -->
   
    <div class="card mb-4">
      <!--php used to display the data of the post using posts.csv file-->
    <?php
      

      require_once 'login.php';
           
            $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
      if ($conn->connect_error)
       { 
        echo"<p>Connection failed!" . mysqli_connect_error()."</p>"; 
       }
       $myquery= "SELECT * 
                  FROM Posts 
                  ORDER BY Date DESC";
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
         $title=sprintf("%s", $row["Title"]);
         $image=sprintf("%s", $row["ImageFName"]);
         $post=sprintf("%s", $row["Post"]);
         date_default_timezone_set('America/Halifax');
         $post=substr($post, 0, 252);
         $date=sprintf("%d", $row["Date"]);
         
        // Preview Image
          

            echo "<img class=\"card-img-top\" src=\"Files/$image\" alt=\"Card image cap\">";
            echo "<div class=\"card-body\">";
            echo "<h2 class=\"card-title\">$title</h2>";
           
            echo "<p class=\"card-text\" >$post</p>";
            
            echo "<a href=\"post.php?title=$title\" class=\"btn btn-primary\">Read More &rarr;</a></div>";
            echo "<div class=\"card-footer text-muted\">Posted on ". date("F j, Y", $date) ." by <a href=\"about.php\">$author</a></div>";
            // Close the file
           
            echo "</div> <div class=\"card mb-4\">";

       }
      }

      
     $conn->close();

      ?>
 
    </div>


    <!-- Pagination contains the 2 links that will take the user to older and newer 
    posts-->
    

  </div>

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
          <p>Logout of your account.</p>
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