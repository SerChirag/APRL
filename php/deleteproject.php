<?php
  $id = $_POST['id'];
  echo $id;
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
  return "<div class='alert alert-success' role='alert' hidden='true'>
     <div class='container'>
       <div class='alert-icon'>
             <i class='now-ui-icons ui-2_like'></i>
       </div>
       <strong>Well done!</strong> You successfully read this important alert message.
         <button type='button' class='closé' data-dismiss='alert' aria-label='Close'>
         <span aria-hidden='true'>
           <i class='now-ui-icons ui-1_simple-remove'></i>
         </span>
       </button>
     </div>
   </div>";
?>
