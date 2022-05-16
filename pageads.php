<?php
include_once("includes/functions.php");
include_once("includes/config.php");


?>
<!DOCTYPE html>

<head>
    <title>
        Ads Profile | B2S
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/pageads.css" />

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

    <section class="ads">
        <?php
        // get id ads to get information ads
        $AdsID = $_GET['ADS-ID'];
        $clink;
        $resultADS = mysqli_query($clink, "SELECT Date,Details,Price,Image,Status,Title,CategoryID,UserID,areaName FROM advertisments WHERE AdsID=$AdsID");
        $rowADS = mysqli_fetch_assoc($resultADS);
        $UserID = $rowADS['UserID'];
        // admin only can to visit this page
        if ($rowADS['Status'] == 0 && isLogged() !== 2) {
            header('location:index.php');
        }
        ######################### get information user by UserID owner ADS
        $resultuser = mysqli_query($clink, "SELECT UserName,Email,Phone,areaID FROM users WHERE UserID=$UserID");
        $rowuser = mysqli_fetch_assoc($resultuser);
        ######################### get name area  by areasID
        $areaID = $rowuser['areaID'];
        $resultareas = mysqli_query($clink, "SELECT areaName,cityID FROM areas WHERE areaID=$areaID");
        $rowareas = mysqli_fetch_assoc($resultareas);
        ######################### get name city by cityID
        $cityID = $rowareas['cityID'];
        $resultcity = mysqli_query($clink, "SELECT cityName FROM cities WHERE cityID=$cityID");
        $rowcity = mysqli_fetch_assoc($resultcity);
        ####################################################################################
        ########################## get name categories ID
        $CategoryID = $rowADS['CategoryID'];
        $resultCategory = mysqli_query($clink, "SELECT CategoryName FROM categories WHERE CategoryID=$CategoryID");
        $rowCategory = mysqli_fetch_assoc($resultCategory);
        #############################################################################  get name report user ID
        $AdsID;
        
        ?>
        <div class="container">
            <hr>

            <div class="card">
                <div class="row">
                    <aside class="col-sm-5 border-right">
                        <div class="text-center "> <a href="#"><img src='assets/img/<?php echo $rowADS['Image']; ?>'></a></div>
                        <hr>
                        <div class=" pl-5">
                            <dl class="param param-feature">
                                <dt>Posted By</dt>
                                <dd><?php echo $rowuser['UserName']; ?></dd>
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Email </dt>
                                <dd><?php echo $rowuser['Email']; ?></dd>
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Phone Number</dt>
                                <dd><?php echo $rowuser['Phone']; ?></dd>
                            </dl> <!-- item-property-hor .// -->
                            </dl> <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Address</dt>
                                <dd><?php echo $rowcity['cityName'] . " , " . $rowareas['areaName']; ?></dd>
                            </dl> <!-- item-property-hor .// -->
                        </div> <!-- card-body.// -->
                    </aside>
                    <aside class="col-sm-7">
                        <article class="card-body p-5">
                            <h3 class="title mb-3"><?php echo $rowADS['Title']; ?></h3>
                            <dl class="item-property">
                                <dt>Description</dt>
                                <dd>
                                    <p><?php echo $rowADS['Details']; ?></p>
                                </dd>
                            </dl>
                            <dl class="param param-feature">
                                <dt>Price</dt>
                                <dd><?php echo $rowADS['Price']; ?></dd>
                                <dl class="param param-feature">
                                    <dt>Posted on</dt>
                                    <dd><?php echo $rowADS['Date']; ?></dd>
                                </dl> <!-- item-property-hor .// -->
                                <dl class="param param-feature">
                                    <dt>Category</dt>
                                    <dd><?php echo $rowCategory['CategoryName']; ?></dd>
                                </dl> <!-- item-property-hor .// -->
                                <hr>

                                
                                
                        </article> <!-- card-body.// -->
                    </aside> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card.// -->
        </div>
        <!--container.//-->

    </section>

    <script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>