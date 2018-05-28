<?php
session_start();
if(!isset($_SESSION['username'])){
  $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login-page.php';
  header('Location:'.$url);
}
else{
  $username = $_SESSION['username'];
}

if(isset($_POST["id"])){
  $pid = $_POST['id'];
	show_project($_POST["id"]);
}
function show_project($id){
    $username = $_SESSION['username'];
    require('connect.php');
//  $dbc = mysqli_connect("localhost", "root", NULL, "aprl")
//  or die("Unable to connect to database");
$query = "SELECT profession FROM userlogin WHERE username = '$username'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
$profession = $row['profession'];

 $query = "SELECT * FROM `project` where project_id='$id'";
 $result = mysqli_query($dbc, $query)
 or die('Unable to query project-ppage' );

 $query2 = "SELECT MIN(`project_id`),MAX(`project_id`) FROM `project` ";
 $result2 = mysqli_query($dbc, $query2)
 or die('Unable to query next and prev projects' );
 $min_max = mysqli_fetch_assoc($result2);
 $previd = $min_max['MIN(`project_id`)'];
 $nextid = $min_max['MAX(`project_id`)'];

 while($row = mysqli_fetch_assoc($result)){
   echo "
    <div class='container tim-container' style='max-width:800px; padding-top:10px'>
   <div id='confirmation'></div>
   <h1 class='text-center'>$row[title]</h1>";
   if($username==$row['offeredby']){
   echo "<div class='col-md-10'>
      <button class='btn btn-primary btn-round' type='button' id='edit' onclick='editProject(".$_POST['id'].");'>
       <i class='now-ui-icons design-2_ruler-pencil'></i> Edit
     </button>
       <button class='btn btn-primary btn-round' type='button' id='delete' data-toggle='modal' data-target='#confirm-delete'>
         <i class='now-ui-icons ui-1_simple-delete'></i> Delete
       </button>
   </div>";}

   echo "<h6 class='col text-right'>Offered By - <a href='profile-page.php?username=$row[offeredby]'>$row[offeredby]</a>
   <br> Posted on - $row[addedon]
   </h6>";
   if($row['status'] == "available" and $profession!='faculty'){
            echo"
                <!--collapse -->
                            <div id='collapse'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div id='accordion' role='tablist' aria-multiselectable='true' class='card-collapse'>
                                            <div class='card card-plain'>
                                                <div class='card-header' role='tab' id='headingOne'>
                                                    <a data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                                                        Apply for project
                                                        <i class='now-ui-icons arrows-1_minimal-down'></i>
                                                    </a>
                                                    <a >Last Date To Apply : $row[lastdate]</a>
                                                </div>
                                                <div id='collapseOne' class='collapse ' role='tabpanel' aria-labelledby='headingOne'>
                                                    <div class='card-body'>
                                                       <input hidden id='p_id' value='$row[project_id]'><p><b>Why are you interested in this project?</b></p>
                                                            <textarea class='form-control' id='interested'></textarea>
                                                            <div class='col text-left'>
                                                                <button id = 'apply_form' class='btn btn-primary ' type='button'>
                                                                <i class='now-ui-icons ui-2_favourite-28'></i> Apply
                                                                </button>
                                                            </div>
                                                            <span id='apply$row[project_id]'></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--  end collapse -->";
  }
  echo "
  <!--    Display Current Projects -->
  <p>$row[description]</p>

  <span >";
  $query1 = "SELECT tag.tagname from project join projecttag on project.project_id = projecttag.project_id join tag on projecttag.tag_id=tag.tag_id where project.project_id=$row[project_id]" ;
  $result_tag = mysqli_query($dbc, $query1)
  or die('Unable to query tagname' );
  while($tag = mysqli_fetch_assoc($result_tag)){
    echo    "<span >
    <a href='search.php?id=\"$tag[tagname]\"' class='btn btn-primary btn-round btn-sm' >$tag[tagname]</a>
    </span>";
  }
  $current_id = $row["project_id"];
  
  $query3 = "SELECT fame_fund FROM project WHERE project_id = '$current_id'";
  $result3 = mysqli_query($dbc, $query3);
  $row3 = mysqli_fetch_array($result3);
  $fame_fund = $row['fame_fund'];
  echo "Current Funding : ".$fame_fund;
  
  $nextquery= "SELECT `project_id` FROM `project` WHERE `project_id` > $current_id ORDER BY `project_id` ASC LIMIT 1";
  $nextresult = mysqli_query($dbc,$nextquery)
  or die("Unable to get next project_id");
  if(mysqli_num_rows($nextresult) > 0)
  {
    $nextrow = mysqli_fetch_assoc($nextresult);
    $nextid  = $nextrow["project_id"];
  }

  $prevquery= "SELECT `project_id` FROM `project` WHERE `project_id` = (SELECT MAX(`project_id`) FROM `project` WHERE `project_id`< $current_id)";
  $prevresult = mysqli_query($dbc,$prevquery)
  or die("Unable to get prev project_id");
  if(mysqli_num_rows($prevresult) > 0)
  {
    $prevrow = mysqli_fetch_assoc($prevresult);
    $previd  = $prevrow['project_id'];
  }
  echo
  "
  <br> 
  </span>
  <!--     end extras --> 
  <div class='col text-center'> 
  <br>
  <input type='text' value='' id='fame_form' placeholder='Regular' class='form-control' />
  <a id='fame_support' onclick='showFame(\"$current_id\")' class='btn btn-primary btn-round btn-lg'>Support</a> 
  <br>
  <a onclick='showPage(\"$previd\")' class='btn btn-primary btn-round btn-lg'>Previous Project</a>
  <a onclick='showPage(\"$nextid\")' class='btn btn-primary btn-round btn-lg'>Next Project</a>
  </div>
  </div>
  <div class='modal fade modal-mini modal-primary' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' style='display: none;'' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <p>Are you sure you want to delete the project?</p>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-link btn-neutral' onclick='deleteProject($current_id );'>Yes</button>
                        <button type='button' class='btn btn-link btn-neutral' data-dismiss='modal'>Cancel</button>
                    </div>
                </div>
            </div>
        </div>

  ";
}
// mysqli_close($dbc);
}
?>
