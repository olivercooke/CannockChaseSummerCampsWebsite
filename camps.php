<?php
  include('session.php');

   $sql = "SELECT userID, name, childName, email FROM user WHERE userID = '$_SESSION[login_user]'";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   $sql2 = "SELECT campID, name, location, image, pricePerDay FROM camp";

   $result2 = mysqli_query($conn, $sql2);
   $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

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
  
  <div class="container">
    <div>
      <?php
        if(count($row2) != 0){
          echo '<div class = "col"> <a href="camp_page.php?campID=' . $row2['campID'] . '"> <div class="jumbotron " id="j' . $row2["campID"] . '"> <h1>' . $row2['name'] . '</h1> <h3>' . $row2["location"]. ' • £' . $row2["pricePerDay"] . ' per day</h3> </div> </a> </div> <style> #j' . $row2["campID"] . '{background-image: url("' . $row2["image"] . '"); background-size: cover; background-position: center;} .jumbotron h1{ color: white; text-shadow: 4px 4px #000000;padding-top:10%;} .jumbotron h3{ color: white; text-shadow: 4px 4px #000000;margin-top:10%;padding-bottom:10%;} .jumbotron{margin-top:5%;height:auto;text-align: center;position:relative;}</style>';
        }
        if ($result2->num_rows > 0) {
           // output data of each row
          while($row2 = $result2->fetch_assoc()) {
            
          echo '<div class = "col"> <a href="camp_page.php?campID=' . $row2['campID'] . '"> <div class="jumbotron" id="j' . $row2["campID"] . '"> <h1>' . $row2['name'] . '</h1> <h3>' . $row2["location"]. '• £' . $row2["pricePerDay"] . ' per day</h3> </div> </a> </div> <style> #j' . $row2["campID"] . '{background-image: url("' . $row2["image"] . '"); background-size: cover; background-position: center;} </style>';
          }
        }
      
      ?>
    </div>
  </div>
  
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


      <?php
        if(count($row2) != 0){
          echo '<div class = "col"> <a href="camp_page.php?campID=' . $row2['campID'] . '"> <div class="jumbotron " id="j' . $row2["campID"] . '"> <h1>' . $row2['name'] . '</h1> <h3>' . $row2["location"]. ' • £' . $row2["pricePerDay"] . ' per day</h3> </div> </a> </div> <style> #j' . $row2["campID"] . '{background-image: url("' . $row2["image"] . '"); background-size: cover; background-position: center;} .jumbotron h1{ color: white; text-shadow: 4px 4px #000000;padding-top:10%;} .jumbotron h3{ color: white; text-shadow: 4px 4px #000000;margin-top:10%;padding-bottom:10%;} .jumbotron{margin-top:5%;height:auto;text-align: center;position:relative;}</style>';
        }
        if ($recentresult->num_rows > 0) {
           // output data of each row
          while($recentrow = $recentresult->fetch_assoc()) {
            
          echo '<div class="col-2"> <img class="img-fluid" src= '. $recentrow["poster"].' > </div>';
          }
        }
      
      ?>
	  
	        <?php
                echo '<div class="col-2"> <img class="img-fluid" src= '. $popularrow["poster"].' > </div>';
                
                if ($popularresult->num_rows > 0) {
                // output data of each row
                while($popularrow = $popularresult->fetch_assoc()) {
                    echo '<div class="col-2"> <img class="img-fluid" src= '. $popularrow["poster"].' > </div>';
                }
            }?>