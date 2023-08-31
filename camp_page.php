<?php
  include('session.php');

   $sql = "SELECT userID, name, childName, email FROM user WHERE userID = '$_SESSION[login_user]'";
   $result = mysqli_query($conn,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
   $camp_sql = "SELECT campID, name, location, capacity, description, image, pricePerDay, startdate, enddate FROM camp WHERE campID =" . $_GET["campID"];
   $camp_result = mysqli_query($conn,$camp_sql);
   $camp_row = mysqli_fetch_array($camp_result,MYSQLI_ASSOC);

   $counter_query ="SELECT COUNT(bookingID) FROM booking WHERE campID =" . $_GET["campID"];
   $counter_result = mysqli_query($conn,$counter_query);
   $counter_row = mysqli_fetch_array($counter_result, MYSQLI_ASSOC);

   $places_left = $camp_row['capacity'];
   $places_left = $places_left - $counter_row['COUNT(bookingID)']; 

   $temp = 0;

   if ($camp_row['startdate'] == $camp_row['enddate']){
     $staying_length =  $camp_row['startdate'] . ' - (1 Day)';
     $temp = 1;
   }
   
   else{
     $temp = strtotime($camp_row['enddate']) - strtotime($camp_row['startdate']);
     $temp = $temp/ 60 / 60 / 24;
     $staying_length = $camp_row['startdate'] . ' to ' . $camp_row['enddate'] . ' (' . $temp. ' Days)';
   }
  
   $logged_in = "";
   $cost = 0;
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     if(isset($row)){
          $userid = $row['userID'];
          $campid = $camp_row['campID'];
          $cost = $camp_row['pricePerDay'] * $temp;
          $sql = "INSERT INTO booking (userID, campID, cost) VALUES ('$userid','$campid','$cost')";

       
          if ($conn->query($sql) === TRUE) {

            $booking_sql = "SELECT bookingID FROM booking WHERE campID = $campid AND userID = $userid and $cost = cost ORDER BY bookingID Desc";
            $booking_result = mysqli_query($conn,$booking_sql);
            $booking_row = mysqli_fetch_array($booking_result,MYSQLI_ASSOC);
            
            $redirect = "location: reciept.php/bookingID=" . $booking_row['bookingID'];
            header($redirect); 
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
      else{
          $logged_in = '<div class="d-flex justify-content-center"><a href="login.php">To book a stay at this camp, log in here.</a></div>';
        }     
   }

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
  
  <div class="container">
  <?php
    echo '<div class="row"> <div class="col-6"><h1 class="text-center">'. $camp_row['name'] . '</h1> <h4 class="text-center">' . $camp_row['location'] . ' • £' . $camp_row['pricePerDay'] . ' per day • ' . $places_left . ' places left' . '</h4> <h4 class="text-center">Length of Stay: ' . $staying_length . '</h4><br> <p> ' . $camp_row['description'] . '</p> <div class="text-center d-flex justify-content-center">     
    <form action="" method="post"> <input class="btn btn-primary " type="submit" value="Book Now!"> <br>' . $logged_in .' </form> </div> </div> <div class="col-6"> <img src="' . $camp_row['image'] . '"class="img-fluid"  alt="Responsive image"> </div> </div> ';

  ?>
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