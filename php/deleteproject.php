<?php
session_start();
if(!isset($_SESSION['username'])){
    $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login-page.php';
    header('Location:'.$url);
}
else{
    $username = $_SESSION['username'];

}
  $id = $_POST['id'];
  //echo $id;
  require('connect.php');

  $queryl1 = "LOCK TABLES applicant WRITE";
  if(mysqli_query($dbc, $queryl1)) {}

  $query = "DELETE FROM applicant WHERE project_id ='$id'";
  mysqli_query($dbc, $query);

  $queryl2 = "LOCK TABLES project WRITE";
  if(mysqli_query($dbc, $queryl2)) {}

  $query = "DELETE FROM project WHERE project_id ='$id'";
  mysqli_query($dbc, $query);

  $queryl3 = "LOCK TABLES projectimage WRITE";
  if(mysqli_query($dbc, $queryl3)) {}

  $query = "DELETE FROM projectimage WHERE project_id ='$id'";
  mysqli_query($dbc, $query);

  $queryl4 = "LOCK TABLES projecttag WRITE";
  if(mysqli_query($dbc, $queryl4)) {}

  $query = "DELETE FROM projecttag WHERE project_id ='$id'";
  mysqli_query($dbc, $query);

  $queryl5 = "UNLOCK TABLES";
  if(mysqli_query($dbc, $queryl5)) {}

  mysqli_close($dbc);
  echo '<div class="alert alert-success" role="alert">
                    <div class="container">
                        <div class="alert-icon">
                            <i class="now-ui-icons ui-2_like"></i>
                        </div>
                        <strong>Well done!</strong> You successfully deleted the project.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </span>
                        </button>
                    </div>
                </div>';         
  ?>
