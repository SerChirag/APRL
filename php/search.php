<?php
session_start();
if(!isset($_SESSION['username'])){
    $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login-page.php';
    header('Location:'.$url);
}
// else{
//     if(!empty($_POST['Title']) && !empty($_POST['Description']) && !empty($_POST['LastDate']) && !empty($_POST['Incentive'])){
//         require('connect.php');
//         $title = $_POST['Title'];
//         $description = $_POST['Description'];
//         $lastdate = $_POST['LastDate'];
//         $incentive = $_POST['Incentive'];
//         $username = $_SESSION['username'];

//         $query = "INSERT INTO applyproject(title, description, lastdate, incentive, status, username, adddate) VALUES ('$title', '$description', '$lastdate', '$incentive', 'available', '$username', now())";
//         mysqli_query($dbc, $query)
//         or die('unable to query applyprojects');
//         echo 'Added successfully!';
//         $row = mysqli_fetch_array($result);
//         $firstname = $row['firstname'];
//         $lastname = $row['lastname'];
//         $name = $firstname.' '.$lastname;
//         $credential = $row['credential'];
//         $image = $row['image_url'];
//         $description = $row['description'];
//         $email = $row['email'];
//         if($image!='fb_avatar_male.jpg')
//             $image = $username.'/'.$image;
//         mysqli_close($dbc);

//     }
// }
$username = $_SESSION['username'];
if(isset($_GET['username'])){
    $username = $_GET['username'];
}
    // echo $username;
    require('connect.php');

    $query = "SELECT profession FROM userlogin WHERE username = '$username'";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $profession = $row['profession'];
    $var=$profession."info";
    $query = "SELECT * FROM $var WHERE username = '$username'";
    $result = mysqli_query($dbc, $query)
    or die('Unable to query studentinfo' );

    $row = mysqli_fetch_array($result);
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $credential = $row['credential'];
    $image = $row['image_url'];
    $description = $row['description'];
    $email = $row['email'];
    // if($image!='fb_avatar_male.jpg')
    //     $image = $username.'/'.$image;
    // mysqli_close($dbc);

?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demos.creative-tim.com/now-ui-kit-pro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Oct 2017 16:36:29 GMT -->
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/favicon/favicon-16x16.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Search Page</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit3.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <!-- Canonical SEO -->
    <link href="../assets/css/daddy.css" rel="stylesheet" />
    <!--  Social tags      -->
    

</head>

<style type="text/css">

html, body {
    max-width: 100%;
    overflow-x: hidden;
}



</style>

<body class="index-page">
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="landing-page.php"  data-placement="bottom" >
                    <img src="../assets/favicon/invert.png" id="logo_id">
                </a>  
            </div>
            <a class="dropdown-item" href="project.php">All Projects</a>
            <a class="dropdown-item" href="myproject.php">My Projects</a>
            <a class="dropdown-item" href="myblog.php">My Blogs</a>
            <a class="dropdown-item" href="blogInput.php">New Blog</a>
            <a class="dropdown-item" href="profile-page.php">Profile</a>
            
            <div class="dropdown button-dropdown">
                <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
                    <img class="photo-container" src= <?php echo '"../assets/img/user/'.$image.'"'?> alt="Profile Picture" id="daddy_image">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" data-placement="left">
                    <?php if($profession=='faculty') echo '<a class="dropdown-item" href="addproject.php" >New Project</a>'; ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="edit-profile.php" >Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <br>

    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="media media-post">
                <div class="media-body">
                    <form action="" id="search_form" method="post">
                    <div id = "search" class="input-group">
                        
                            <span class="input-group-addon">
                                <i class="fa fa-user-circle"></i>
                            </span>

                            <input type="text" name="search" id = "search_field" class="form-control" text-align = "center" placeholder="Search...">
                        
                    </div>
                    </form>
                </div>
            </div>   
        </div>


    </div>
   

    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="media media-post">
                <div class="media-body">
                	<br>
                    <div class="row" id="checkRadios">
                        <div class="col-sm-6 col-lg-3">
                            <p class="category">Category</p>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" id="check4" name = "group_check" type="checkbox" checked>
                                    <span class="form-check-sign"></span>
                                    Tags
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" id="check1" name = "group_check" type="checkbox" checked>
                                    <span class="form-check-sign"></span>
                                    Projects
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" id="check2" type="checkbox" name = "group_check" checked>
                                    <span class="form-check-sign"></span>
                                    Blogs
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" id="check3" type="checkbox" name = "group_check" checked>
                                    <span class="form-check-sign"></span>
                                    Users
                                </label>
                            </div>
                            
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <p class="category">Sort By</p>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" id="radio1" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <span class="form-check-sign"></span>
                                    Relevance
                                </label>
                            </div>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" id="radio2" name="exampleRadios" id="exampleRadios1" value="option1">
                                    <span class="form-check-sign"></span>
                                    Time
                                </label>
                            </div>
                                   
                        </div>


                        
                    
                    </div>

                </div>
            </div>   
        </div>


    </div>



    <div class="main"></div>

    

    	<div class="blogs-5" >
                <div class="container">
                    <div class="row">


                        <div class="col-md-10 ml-auto mr-auto">
                            <br>
                            <br>
                        	<h2 class="title" text-align = "center">Search Results</h2>
                        	
                        	<br>
                        	<br>
                            
                            <div class="row" id="result_display">
                                


                               <!--  <div class="col-md-4">
                                    <div class="card card-blog">
                                        <div class="card-image">
                                            <a href="#pablo">
                                                <img class="img rounded" src="../assets/img/card-blog2.jpg">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="category text-primary">Features</h6>
                                            <h5 class="card-title">
                                                That’s One Way To Ditch Your Passenger
                                            </h5>
                                            <p class="card-description">
                                                As near as we can tell, this guy must have thought he was going over backwards and tapped the rear...
                                            </p>
                                            <div class="card-footer">
                                                <div class="author">
                                                    <img src="../assets/img/julie.jpg" alt="..." class="avatar img-raised">
                                                    <span>Mike John</span>
                                                </div>
                                                <div class="stats stats-right">
                                                    <i class="now-ui-icons tech_watch-time"></i> 5 min read
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-blog">
                                        <div class="card-image">
                                            <a href="#pablo">
                                                <img class="img rounded" src="../assets/img/card-blog3.jpg">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="category text-danger">Animals</h6>
                                            <h5 class="card-title">
                                                Shark Week: How to Watch It Like a Scientist
                                            </h5>
                                            <p class="card-description">
                                                Just when you thought it was safe to turn on your television, the Discovery Channel's "Shark Week"...
                                            </p>
                                            <div class="card-footer">
                                                <div class="author">
                                                    <img src="../assets/img/julie.jpg" alt="..." class="avatar img-raised">
                                                    <span>Mike John</span>
                                                </div>
                                                <div class="stats stats-right">
                                                    <i class="now-ui-icons tech_watch-time"></i> 5 min read
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-blog">
                                        <div class="card-image">
                                            <a href="#pablo">
                                                <img class="img rounded" src="../assets/img/bg26.jpg">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="category text-primary">Cars</h6>
                                            <h5 class="card-title">
                                                Who's Afraid of the Self-Driving Car?
                                            </h5>
                                            <p class="card-description">
                                                It's been 60 years since the cover of Popular Mechanics magazine gave us the promise of flying cars...
                                            </p>
                                            <div class="card-footer">
                                                <div class="author">
                                                    <img src="../assets/img/olivia.jpg" alt="..." class="avatar img-raised">
                                                    <span>Johanna Zmud</span>
                                                </div>
                                                <div class="stats stats-right">
                                                    <i class="now-ui-icons ui-2_favourite-28"></i> 2.4K
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    

    <div class="wrapper">
    <footer class="footer footer-default">
        <div class="container">
           
            <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>, View Code at
                <a href="http://www.github.com/SerChirag/APRL" target="_blank">GitHub</a>
            </div>
        </div>
    </footer>
</div>

</body>

<!--   Core JS Files   -->


<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="../assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="../assets/js/plugins/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<!-- Plugins for Presentation Page -->
<!-- Sharrre Library -->

<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/now-ui-kit.js" type="text/javascript"></script>

<script type="text/javascript">


    function initialize(event) {
       
       $.ajax({
           type: "POST",
           url: "search_init.php",
           success: function(data) {
                if(data.length == 1) {   
                    return;
                }
                $("#result_display").html(data);
           }
      });
        
       return false;
    }

    function generate_link(elem){

        var id = $(elem).attr("id");
        alert(id);

    }


    function search(event) {
       var search_name=$('#search_field').val();
       var check1 = 0;
       var check2 = 0;
       var check3 = 0;
       var check4 = 0;
       var radio_button = 0;
       if($("#check1").prop('checked') == true){
            check1 = 1;
       }


        if($("#check2").prop('checked') == true){
            check2 = 1;
        }

        if($("#check3").prop('checked') == true){
            check3 = 1;
        }

        if($("#check4").prop('checked') == true){
            check4 = 1;
       }

        if($("#radio1").prop('checked') == true){
            //console.log("yeah");
            radio_button = 1;
        }

        if($("#radio2").prop('checked') == true){
            //console.log("yeah2");
            radio_button = 2;
        }

       
       $.ajax({
           type: "POST",
           url: "search_algo_offeredby.php",
           data: {value: search_name, check1: check1, check2: check2, check3: check3, check4: check4, radio_button: radio_button},
           
           success: function(data) {
                if(data.length == 1) {
                    return;
                }  
                $("#result_display").html(data);
           }
      });
        
       return false;
    }



    $(document).ready(function() {

        
        $("#radio1").on('change', function() {
            
            search();
            
        });   

        $("#radio2").on('change', function() {

        
            search();
            
        });     

        $("#check1").on('change', function() {
            
            if ($("[name=group_check]:checked").length > 0){
                search();                
            }
            else{
                this.checked=true;
            }
        });

        $("#check2").on('change', function() {
           
            if ($("[name=group_check]:checked").length > 0){
                search();                
            }
            else{
                this.checked=true;
            }
        });

        $("#check3").on('change', function() {
            
            if ($("[name=group_check]:checked").length > 0){
                search();
                
            }
            else{
                this.checked=true;
            }
        });

        $("#check4").on('change', function() {
            
            if ($("[name=group_check]:checked").length > 0){
                search();
                
            }
            else{
                this.checked=true;
            }
        });

        initialize();
        var url = window.location + '';
        var link = url.split('?')[1];
        if(link){
            $('#search_field').val(link.split('=')[1]);
            search();
        }

        $('#search_field').keyup(function(e) {
            clearTimeout($.data(this, 'timer'));
            $(this).data('timer', setTimeout(search, 500));
        });

       $("#search_form").submit(function( event ) {  

            event.preventDefault();
            search();
        });
    });

</script>


<!-- Mirrored from demos.creative-tim.com/now-ui-kit-pro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Oct 2017 16:46:49 GMT -->
</html>
