<?php
include_once("includes/functions.php");
include_once("includes/config.php");
?>
<!DOCTYPE html>

<head>
    <title>Home | B2S</title>
    <link rel="shotcuticon" href="assets/img/olx.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <script>
        function getareas(cid) {
            $(document).ready(function() {
                $.get("getAreas.php?cid=" + cid, function(data, status) {
                    $("#areaDiv").html(data);
                });
            });
        }
    </script>
</head>

<body>

    <?php
    drawHeader();
    ?>

    <div class="container ">
        <div class="control d-flex  justify-content-around">
            <div class="search text-center">
                <!-- get all cities -->
                <?php
                $cities = getAllCities();
                for ($i = 0; $i < sizeof($cities); $i++) {
                    echo "<a href='index.php?city={$cities[$i][0]}' class='btn '>{$cities[$i][1]}</a>";
                }
                ?>
            </div>
        </div>
    </div>

        <div class='container'>
            <div class="btn-group btn-group-justified col-sm-12 m-2">
                <!-- get all categories -->
                <?php
                $categories = getAllCategories();
                for ($i = 0; $i < sizeof($categories); $i++) {
                    echo "<a href='index.php?Maincategory={$categories[$i][0]}' class='btn btnselect'>{$categories[$i][1]}</a>";
                }
                ?>
                <a href="index.php?New" class="btn btnselect ">New</a>
            </div>
        </div>
        <section class="ads">
            <div class="container">
                <div class="row ">
                    <?php
                    //Get DB products and display them
                    if (isset($_GET['New'])) {
                        $result = mysqli_query($clink, "SELECT * FROM `advertisments`,users, areas WHERE advertisments.userID=users.userID AND areas.areaID=advertisments.areaName AND advertisments.Status=1 ORDER BY advertisments.adsID DESC");
                    } else if (isset($_GET['Maincategory'] ) AND $_GET['Maincategory'] !=0){
                        $categoryID =$_GET['Maincategory'];
                        $result = mysqli_query($clink, "SELECT * FROM advertisments , categories, areas, users WHERE advertisments.CategoryID = categories.CategoryID AND advertisments.AreaName = areas.AreaID AND advertisments.UserID = users.UserID AND categories.CategoryID = $categoryID ORDER BY `advertisments`.`AdsID` DESC");
                    
                     } else if (isset($_GET['city']) AND $_GET['city'] != 0) {
                        $cityID = $_GET['city'];
                        $result = mysqli_query($clink, "SELECT * FROM advertisments, users, areas where users.UserID = advertisments.UserID and areas.AreaID = users.AreaID and areas.CityID = $cityID");
                    }
                     else {
                        $result = mysqli_query($clink, "SELECT * FROM `advertisments`,users,areas WHERE advertisments.UserID = users.UserID AND users.AreaID = areas.AreaID and users.userID=advertisments.userID");
                    }
                    if (mysqli_num_rows($result) > 0) {
                        //Show them

                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['Status'] == 1 || isLogged() == 2) {
                                echo "<div class='col-md-4 col-sm-6 '>
                            <div class='card ' > 
                            <img class='' src='assets/img/{$row['Image']}' class='card-img-top' alt='...'>
                            <span class='float-left'> ₹ {$row['Price']}</span>
                                <div class='card-body'>
                                <h6 style='padding:5px; color:#3B5998; font-size:20px; font-weight:bold; class='card-title'>{$row['Title']}</h6>
                                <h6 style='text-transform:uppercase; font-weight:bold;' class='card-title'>Listed by: {$row['UserName']}</h6>
                                <h6 class='card-text'>{$row['areaName']}, {$row['cityName']}</h6>
                                <a href='pageads.php?ADS-ID={$row['AdsID']}' class='btn btn-primary '>More Details</a>";
                                echo " </div> </div></div>";
                            }
                        }
                    } else {
                        outputMessage("No products found in our catalog", 'warning');
                    }
                    ?>


                </div>


            </div>
        </section>
        <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>