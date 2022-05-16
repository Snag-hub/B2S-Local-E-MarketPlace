<?php
include_once("includes/functions.php");
include_once("includes/config.php");
$isLogged = isLogged();
if ($isLogged == 3) {
  header("Location:index.php ");
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- form for edit profile -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Edit Profile</title>

  <!-- Bootstrap cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/profile.css">
</head>

<body>
  <?php
  drawHeader();

  $UserID = $_SESSION['loggedInUserId'];
  $result = mysqli_query($clink, "SELECT * FROM `users`,areas WHERE UserID=$UserID and users.areaId=areas.areaID");
  $row = mysqli_fetch_assoc($result);
  $UserName = $row['UserName'];
  $Email = $row['Email'];
  $Phone = $row['Phone'];
  $City = $row['cityName'];
  $Area = $row['areaName'];
  ?>
  ?>
  <!-- form for edit profile -->
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Profile</h5>
            <form action="editprofile.php" method="post">
              <div class="form-group">
                <label for="UserName">User Name</label>
                <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo $UserName; ?>">
              </div>
              <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>">
              </div>
              <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" class="form-control" id="Phone" name="Phone" value="<?php echo $Phone; ?>">
              </div>
              <div class="form-group">
                <label for="City">City</label>
                <select class="form-control" id="City" name="City">
                  <?php
                  $result = mysqli_query($clink, "SELECT * FROM `cities`");
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <option value="<?php echo $row['cityID']; ?>" <?php if ($row['cityID'] == $City) { echo "selected"; } ?>
                    ><?php echo $row['cityName']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="Area">Area</label>
                <select class="form-control" id="Area" name="Area">
                  <?php
                  $result = mysqli_query($clink, "SELECT * FROM `areas`");
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <option value="<?php echo $row['areaID']; ?>" <?php if ($row['areaID'] == $Area) { echo "selected"; } ?>
                    ><?php echo $row['areaName']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
    //  Update database with new data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $UserName = $_POST['UserName'];
      $Email = $_POST['Email'];
      $Phone = $_POST['Phone'];
      $City = $_POST['City'];
      $Area = $_POST['Area'];
      $result = mysqli_query($clink, "UPDATE `users` SET `UserName`='$UserName',`Email`='$Email',`Phone`='$Phone',`cityName`='$City',`areaID`='$Area' WHERE UserID=$UserID");
      if ($result) {
        echo '<div class="alert alert-success" role="alert">
        Your profile has been updated successfully!
      </div>';
      } else {
        echo '<div class="alert alert-danger" role="alert">
        Your profile has not been updated!
      </div>';
      }
    }
    ?>
</body>