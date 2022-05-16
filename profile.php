<?php
include_once("includes/functions.php");
include_once("includes/config.php");
$isLogged = isLogged();
if ($isLogged == 3) {
    header("Location:index.php ");
}

// db connection
// $host = "localhost";
// $user = "root";
// $pass = "";
// $db = "olx0";
// $clink = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");

?>
<!DOCTYPE html>

<head>
    <!-- dynamic title -->
    <title>
        Profile
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/profile.css" />
</head>

<body>

    <?php
    drawHeader();
    ?>
    <section class="Profile">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- get userid details from database -->
                    <?php
                    //get userid details from session
                    $UserID = $_SESSION['loggedInUserId'];
                    $result = mysqli_query($clink, "SELECT * FROM `users`,areas WHERE UserID=$UserID and users.areaId=areas.areaID");
                    $row = mysqli_fetch_assoc($result);
                    $UserName = $row['UserName'];
                    $Email = $row['Email'];
                    $Phone = $row['Phone'];
                    $City = $row['cityName'];
                    $Area = $row['areaName'];
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">User Details</h5>
                                   
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>User Name: <?php echo $UserName; ?></p>
                                            <p>Email: <?php echo $Email; ?></p>
                                            <p>Phone: <?php echo $Phone; ?></p>
                                            <p>City: <?php echo $City; ?></p>
                                            <p>Area: <?php echo $Area; ?></p>

                                        </div>
                                    </div>
                                    <a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
                                    <a href="deleteaccount.php" class="btn btn-danger">Delete Account</a>
                                    <a href="changepassword.php" class="btn btn-warning">Change Password</a>
                                </div>
                            </div>
                        </div>

    </section>
    <section class="tabs px-5 pt-3 ">
        <div class="container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">ADS</a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane container active tab1" id="home">
                    <div class="row">


                        <?php
                        //Get UserID by session
                        $UserID = $_SESSION['loggedInUserId'];

                        //Get DB products and display them
                        $result = mysqli_query($clink, "SELECT * FROM `advertisments` WHERE UserID=$UserID");
                        if (mysqli_num_rows($result) > 0) {
                            //Show them

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['Status'] == 1) {
                                    echo " <div class='col-md-4 col-sm-6 ' >
                            <div class='card  ' >
                            <img class='' src='assets/img/{$row['Image']}' class='card-img-top' alt='...'>
                            <span class='float-left'> $ {$row['Price']}</span>
                                <div class='card-body'>
                                <h5 class='card-title'>{$row['Title']}</h5>
                                <p class='card-text'>{$row['Details']}</p>
                                <a href='pageads.php?ADS-ID={$row['AdsID']}' class='btn btn-primary '>More Details</a>
                                <a href='Editads.php?ADS-ID={$row['AdsID']}' class='btn btn-primary '>Edit Details</a>
                            </div> </div></div>";
                                } else {
                                    echo "
                            <div class='col-md-4 col-sm-6 ' ><div class='card  ' >
                                    <img class='' src='assets/img/{$row['Image']}' class='card-img-top' alt='...'>
                                        <div class='card-body'>
                                        <h5 class='card-title'>The advertisments has been suspened from Admin ,please check your inbox</h5>
                                        <a href='Editads.php?ADS-ID={$row['AdsID']}' class='btn btn-primary '>Edit Details</a>
                                    </div></div>
                                    </div>";
                                }
                            }
                        } else {
                            outputMessage("No products found in our catalog", 'warning');
                        }
                        ?>

                    </div>

                </div>

            </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>