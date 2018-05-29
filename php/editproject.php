<?php 
session_start();
if(!isset($_SESSION['username'])){
    $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login-page.php';
    header('Location:'.$url);
}
else{
    $username = $_SESSION['username'];

}
define('APRL_UPLOADPATH', '../assets/img/');
$username = $_SESSION['username'];
require('connect.php');
if(isset($_POST['id']))
  $id = $_POST['id'];
else if(isset($_GET['id']))
  $id = $_GET['id'];
else
  $id=-1;

$queryl1 = "LOCK TABLES project WRITE";
if(mysqli_query($dbc, $queryl1)) {}

$query = "SELECT * FROM project WHERE project_id = '$id'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
$oldtitle = $row['title'];
$olddescription = $row['description'];
$oldlastdate = $row['lastdate'];
$oldincentive = $row['incentive'];

if($id!=-1){
  if(isset($_POST['submit'])){
          //echo "HELLo4";
      $title = $_POST['title'];
      $incentive = $_POST['incentive'];
      $lastdate = $_POST['lastdate'];
      $desc = $_POST['description'];
     // $status = $_POST['status'];

      $image = $_FILES['Image']['name'];
      $query = "UPDATE project SET title='$title', description='$desc',incentive='$incentive', lastdate='$lastdate'
      WHERE project_id='$id'";
      mysqli_query($dbc, $query)
      or die('Unable to addproject');

      if(!is_dir(APRL_UPLOADPATH."project/")) {
          mkdir(APRL_UPLOADPATH.'project'); 
      }
      if(!is_dir(APRL_UPLOADPATH."project/".$id.'/')) {
          mkdir(APRL_UPLOADPATH.'project/'.$id); 
      }

      $queryl2 = "LOCK TABLES projectimage WRITE";
        if(mysqli_query($dbc, $queryl2)) {}

      $query = "INSERT INTO `projectimage`(`project_id`, `imageurl`) VALUES
      ('$id','$image')";
      mysqli_query($dbc, $query)
      or die('Unable to addproject image');
      if($image!=''){
          $target = APRL_UPLOADPATH.'project/'.$id.'/'.$image;
          //echo $target;  



          move_uploaded_file($_FILES['Image']['tmp_name'], $target);
      }
          //echo 'Update successful!';

       echo '<h1>Updated Project successfully.</p1><br><h3>You will be automatically redirected to the other page.</h3>';
       $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/myproject.php';
    header('Location:'.$url); 
  }

  $queryl3 = "UNLOCK TABLES";
  if(mysqli_query($dbc, $queryl3)) {}
}
else{
 $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/myproject.php';
    header('Location:'.$url); 

  $queryl4 = "UNLOCK TABLES";
  if(mysqli_query($dbc, $queryl4)) {}
}

 echo '
        <div class="section">
            <div class="container">
                <form enctype="multipart/form-data" method="post" action= "editproject.php/?id='.$id.'" >
                    <div class="row">
                        <div class="col-md-6">
                            <label>title</label>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Title" name="title" value="'.$oldtitle.'" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>lastdate</label>
                                <input type="date" class="form-control" placeholder="Last Date" name="lastdate" value="'.$oldlastdate.'"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>incentive</label>
                                <input type="text" class="form-control" placeholder="Incentive" name="incentive" value="'.$oldincentive.'"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>description</label>
                            <div class="form-group">
                                <textarea type="text" class="form-control" placeholder="Description" name="description" value="'.$olddescription.'"></textarea>
                            </div>
                            <div id="textareaTags">
                        <div id="tag" class="row">
                            <div  class="col-md-6">
                                <div class="title">
                                    <h4>Tags</h4>
                                </div>
                                <input type="text" value="Amsterdam" class="tagsinput" data-role="tagsinput" data-color="success" />
                                <!-- You can change data-color="rose" with one of our colors primary | warning | info | danger | success -->
                            </div>
                        </div>
                    </div>
                        </div>
                       <!-- <div class="col-md-6">
                           <div class="radio">
                                <input name="status" id="radio1" value="available" type="radio">
                                <label for="radio1">
                                    Available
                                </label>
                            </div>
                            <div class="radio">
                                <input name="status" id="radio2" value="finished" type="radio">
                                <label for="radio2">
                                    Finished
                                </label>
                            </div>
                        </div>  
                        </div>-->
                        <div class="col-md-6">
                            <label>Project picture</label>
                            <div class="input-group form-group-no-border input-lg">
                            <input type="file" class="form-control" id="Image" name="Image" accept="image/*|.jpg|.png|.jpeg|.gif">
                        </div>  
                        </div>
                    </div>
                    <div class="media-footer">
                        <input type="submit" class="btn btn-primary pull-right" value="Save" name="submit">
                    </div>
                </form>
            </div>
        </div>';
?>
