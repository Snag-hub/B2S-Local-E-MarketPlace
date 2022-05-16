<?php
include_once("includes/functions.php");
include_once("includes/config.php");
if(isLogged() !== 2){
    header("Location: index.php "); 

}
?>
<!DOCTYPE html>
<head>
<title>links</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<script>

    function getareas(cid){
        $(document).ready(function(){
            $.get("getAreas.php?cid="+cid, function(data, status){
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

<div class="container">       
<h2 class="m-3">Users Account </h2>
   
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>UserID</th>
        <th>UserName</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
<?php
    $result = mysqli_query($clink, "SELECT * FROM `users` ORDER BY `users`.`UserID` ASC  ");
					if(mysqli_num_rows($result)>1){
						//Show them

						while($row = mysqli_fetch_array($result)){
                        echo "<tr '>
                                    <td>{$row['UserID']}</td>
                                    <td>{$row['UserName']}</td>
                                    <td>{$row['Email']}</td>
                                    <td>{$row['Phone']}</td>
                                    <td> ";
                                    if ($row['Status'] == 1 ){
                                        echo "<a href='usershoworhide.php?UserID={$row['UserID']}' class='btn btn-danger ml-2 ' >Hide<a>";
                                    }else if  ($row['Status'] == 0 ) {
                                        echo "<a href='usershoworhide.php?UserID={$row['UserID']}' class='btn btn-primary ml-2  ' >Show<a>";
    
                                    }
                                    echo "</td> </tr>"   ; 
                        }
                    }else{
						outputMessage("No Account Users found in our Database",'warning');
					}
?>
    </tbody>
  </table>
</div>
<div class="">       
<h2 class="m-3">Advertisments Account </h2> 
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>AdsID</th>
        <th>Date</th>
        <th>Details</th>
        <th>Price</th>
        <th>Image</th>
        <th>Status</th>
        <th>Title</th>
        <th>CategoryID</th>
        <th>UserID</th>
        <th>areaName</th>
      </tr>
    </thead>
    <tbody>
<?php
    $result = mysqli_query($clink, "SELECT * FROM `advertisments` ORDER BY `advertisments`.`AdsID` ASC  ");
          if(mysqli_num_rows($result)>1){
            //Show them

            while($row = mysqli_fetch_array($result)){
                        echo "<tr '>
                                    <td>{$row['AdsID']}</td>
                                    <td>{$row['Date']}</td>
                                    <td>{$row['Details']}</td>
                                    <td>{$row['Price']}</td>
                                    <td>{$row['Image']}</td>
                                    <td> ";
                                    if ($row['Status'] == 1 ){
                                        echo "<a href='adsShoworHide.php?AdsID={$row['AdsID']}' class='btn btn-danger ml-2 ' >Hide<a>";
                                    }else if  ($row['Status'] == 0 ) {
                                        echo "<a href='adsShoworHide.php?AdsID={$row['AdsID']}' class='btn btn-primary ml-2  ' >Show<a>";
    
                                    }
                                    echo "</td>
                                    <td>{$row['Title']}</td>
                                    <td>{$row['CategoryID']}</td>
                                    <td>{$row['UserID']}</td>
                                    <td>{$row['areaName']}</td>
                                    </tr>"   ; 
                        }
                    }else{
            outputMessage("No Account Users found in our Database",'warning');
          }
?>
    </tbody>
  </table>
</div>

<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>