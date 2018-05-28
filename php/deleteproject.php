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
  $query = "DELETE FROM applicant WHERE project_id ='$id'";
  mysqli_query($dbc, $query);
  $query = "DELETE FROM project WHERE project_id ='$id'";
  mysqli_query($dbc, $query);
  $query = "DELETE FROM projectimage WHERE project_id ='$id'";
  mysqli_query($dbc, $query);
  $query = "DELETE FROM projecttag WHERE project_id ='$id'";
  mysqli_query($dbc, $query);
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
