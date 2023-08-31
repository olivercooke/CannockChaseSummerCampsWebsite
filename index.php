<?php
  include('session.php');

   $sql = "SELECT userID, name, childName, email FROM user WHERE userID = '$_SESSION[login_user]'";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   mysqli_close($conn);

?>

<head>
  <title>Cannock Chase Summer Camps</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="css/mystyle.css">
</head>

<body>
  <div class="container">
    <a href=".."><h1 class="display-1 companyName text-center">Cannock Chase Summer Camps</h1></a>
    
    <div class="row">
      <div class="col-sm bg-danger"><a href="about.php"><h3 class="text-center">About</h3></a></div>
      <div class="col-sm bg-success"><a href="gallery.php"><h3 class="text-center">Gallery</h3></a></div>
      <div class="col-sm bg-primary"><a href="camps.php"><h3 class="text-center">Camps</h3></a></div>
      <div class="col-sm bg-warning"><a href="blog.php"><h3 class="text-center">Blog</h3></a></div>
    </div>
  </div>

  <br>
  
  <img src="assets/forest.jpg" class="img-fluid" alt="Responsive image">
  
  <nav class="navbar fixed-bottom navbar-dark bg-dark">
    <div class="container">
        <div>      
          <p class="navbar-text">Email: Support@CannockChaseSummerCamps.co.uk<br>Phone: +44 070 8696 9534</p>
        </div>
        
          <div>
            <?php 
              if(isset($row)){
                echo "<p class='Navbar-text'>Logged in as: ". $row['name'] . "</p>";
                echo '<a href="logout.php"><button type="button" class="btn btn-outline-primary login">Log Out</button></a>';
              }
              else{
                echo '<a href="login.php"><button type="button" class="btn btn-outline-primary login">Login</button></a>';
              }
            ?>
          </div>
    </div>
  </nav>
</body>