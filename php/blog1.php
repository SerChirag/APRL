<?php

// This file is for showing blogs which are obtained by clicking in Top Blogs container in landing page
session_start();
if(isset($_SESSION['username'])){

    require('connect.php');
    define('APRL_UPLOADPATH', '../assets/img/');
    // require_once('likesIncr');
    // $blogId = 1;
    $blogId= $_POST['hidden_name'];
    $uname = $_SESSION['username'];
    if(!is_dir(APRL_UPLOADPATH."blog/".$blogId.'/')) {
                mkdir(APRL_UPLOADPATH."blog/".$blogId); 
            }
    if(!empty($_FILES['Image'])){
        $img = $_FILES['Image'];
        $img_name = $img['name'];
        $target = APRL_UPLOADPATH.'blog/'.$blogId.'/'.$img_name;
    move_uploaded_file($_FILES['Image']['tmp_name'], $target);
    }
    else $img_name ="";
    if(!empty($_FILES['Video'])){
        $vid = $_FILES['Video'];
        $vid_name = $vid['name'];
        $target = APRL_UPLOADPATH.'blog/'.$blogId.'/'.$vid_name;
     move_uploaded_file($_FILES['Video']['tmp_name'], $target);
    }
    else $vid_name ="";
    // $blogId = 1;
    //echo $vid['name'];
    //echo $vid_name.$img_name;
    $query = "UPDATE blog SET image_url = '$img_name', video_url = '$vid_name' WHERE blog_id = '$blogId'";
    $result = mysqli_query($dbc,$query)
    or die("Unable to request added blog from database");
    //$blogId = 1;
    
    
     
    // echo $blogId;
    // $blogId = $_POST['blog_id'];

    $query = "SELECT * FROM blog WHERE blog_id ='$blogId'";
    $result = mysqli_query($dbc,$query)
    or die("Unable to request latest blog from database");
    $rowBlog = mysqli_fetch_array($result);
    $title = $rowBlog['title'];
    // echo $title;
    $description = $rowBlog['description'];
    $video_url = $rowBlog['video_url'];
    // echo $description;
    $GLOBALS['desc']=$description;
    $date = $rowBlog['date'];
    $url = $rowBlog['image_url'];
    $spam = $rowBlog['spam'];
    //likes,reads row added in database blog table
    $likes = $rowBlog['likes']; 
    $reads = $rowBlog['reads'];
    // echo "error yahn hai ";
    // echo $blogId;
    echo "<input type='hidden' id='hidden_input_blog' name='hidden_input' value='$blogId'></input>";
    // echo "error yah to ni hai ";
    // echo $blogId;
    // echo $reads;
    // $readr = $reads + 1;
    // echo $readr;

    // $queryr2 = "UPDATE blog SET reads = '$readr' WHERE blog_id = '$blogId'"; 
    // if(mysqli_query($dbc,$queryr2)){}
    // else{
    //     echo "Unable to update read data";
    // }
    //comments table still to be added

    // $query2 = "SELECT studentinfo.image_url FROM studentinfo INNER JOIN userblog ON userblog.user_id = studentinfo.username WHERE userblog.blog_id = '$blogId'";
    // $result2 = mysqli_query($dbc,$query2)
    // or die("Unable to request image url from database");
    // $imageUrl = $result2;
        
    $query3 = "SELECT blog.offeredby FROM blog WHERE blog_id = '$blogId'";
    $result3 = mysqli_query($dbc,$query3)
    or die("Unable to request image url from database");
    $offer = mysqli_fetch_assoc($result3);
    $offeredby = $offer['offeredby'];
}

else{
    $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/login-page.php';
    header('Location:'.$url);
}


function getTags(){
    require('connect.php');
    // require_once('likesIncr');
    // $dbc = mysqli_connect('localhost', 'root', NULL, 'aprl')
    // or die('Unable to connect to database');
    $blogId = $_POST['hidden_name'];

        $query3 = "SELECT tagname FROM tag INNER JOIN blogtag ON blogtag.tag_id = tag.tag_id WHERE blogtag.blog_id = 
    '$blogId' ";
        $result3 = mysqli_query($dbc,$query3)
        or die("Unable to request tags from database");
        // $rowTag = mysqli_fetch_assoc($result3);
        // echo $rowTag['tagname'];
        // $col = mysqli_fetch_array($rowTag);
        while($rowTag = mysqli_fetch_assoc($result3)){
            echo "<span>
                <button class='btn btn-primary btn-simple btn-round btn-sm' type='button'>".$rowTag['tagname']."</button>
            </span>";
        }
        // while($rowTag = mysqli_fetch_array($result3)){
        // for($x=0;$x<count($rowTag);$x++){
        //     echo $rowTag[$x]; 
}

function suggestTag(){
    require('connect.php');
    // $dbc = mysqli_connect('localhost', 'root', NULL, 'aprl')
    // or die('Unable to connect to database');
    $blogId = $_POST['hidden_name'];

    $query3 = "SELECT tagname FROM tag INNER JOIN blogtag ON blogtag.tag_id = tag.tag_id WHERE blogtag.blog_id = 
    '$blogId' ";
        $result3 = mysqli_query($dbc,$query3)
        or die("Unable to request tags from database");
        // $rowTag = mysqli_fetch_assoc($result3);
        // echo $rowTag['tagname'];
        // $col = mysqli_fetch_array($rowTag);
        while($rowTag = mysqli_fetch_assoc($result3)){
            echo "<span>
                <button class='btn btn-primary btn-simple btn-round btn-sm' type='button'>".$rowTag[tagname]."</button>
            </span>";
        }
}

?>




<!DOCTYPE html>
<html lang="en">

<head >
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/favicon/favicon-16x16.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Blog Page</title>
    
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link href="../assets/css/daddy.css" rel="stylesheet" />
     <!-- <script src="jquery-3.2.1.min.js"></script> -->

<script>

var blog_id;

window.onload = updateRead();
function updateRead(){

  blog_id = $('#hidden_input_blog').val();
  console.log("blog id is  " + blog_id);

  var xmlhttp1 = new XMLHttpRequest();
  xmlhttp1.onreadystatechange = function() {
        if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
                // alert(xmlhttp1.responseText);
                document.getElementById('readsCountId').innerHTML = xmlhttp1.responseText;;
                // console.log("The response reads - ");
                // console.log( xmlhttp1.responseText);
        }
    };
        var id = blog_id;
        // console.log("The value of id passed is - " + id);
        xmlhttp1.open("GET", "readsIncr.php?id=" +id, true);
        xmlhttp1.send();
}


function likesCount(){

    // console.log(1500*1500);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            // alert(xmlhttp.responseText);
            document.getElementById('likesCountId').innerHTML = xmlhttp.responseText;
            // console.log("likes response - " + xmlhttp.responseText);
        }
    };
    var id = blog_id;
    xmlhttp.open("GET", "likesIncr.php?id=" +id, true);
    xmlhttp.send();
}


// var x =0;
function spamCount(){
    // x = x+1;
    // if(x==2){
    //     return ;
    // }
    console.log(1500*1500);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            // alert(xmlhttp.responseText);
            document.getElementById('spamCountId').innerHTML = xmlhttp.responseText;
        }
    };
    var id = blog_id;
    xmlhttp.open("GET", "spamIncr.php?id=" +id, true);
    xmlhttp.send();
}

// function gotoprofile(){
    $(document).ready(function(){
    $("#titlekiid").click(function(){
        console.log("i have clicked");
        window.location = "profile-page.php?username=" + "<?php echo $offeredby ?>";
        // <?php
        // session_start();
        // $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/profile-page.php?username='.$title;
        // header('Location:'.$url);
        // ?> 
    }); 
});
   

// }

function clicksuggest(titleki){
console.log("im inside suggest");
    window.location = "blog.php?hidden_name=" + titleki;
}

// function getTags(){
//     // x = x+1;
//     // if(x==2){
//     //     return ;
//     // }
//     console.log(-1*1500);
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
//         {
//             // alert(xmlhttp.responseText);
//             document.getElementById('addTagsHere').innerHTML = xmlhttp.responseText;
//         }
//     };
//     var id =1;
//     xmlhttp.open("GET", "spamIncr.php?id=" +id, true);
//     xmlhttp.send();
// }

</script>


<!-- //newly added  -->
<meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> Blog Posts - Now UI Kit Pro by Creative Tim | Premium Bootstrap 4 UI Kit </title>
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
    <link rel="canonical" href="https://www.creative-tim.com/product/now-ui-kit-pro" />
    <!--  Social tags      -->
    <meta name="keywords" content="bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, now ui, now ui kit pro, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit">
    <meta name="description" content="Start your development with a beautiful Bootstrap 4 UI kit.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Now UI Kit Pro by Creative Tim">
    <meta itemprop="description" content="Start your development with a beautiful Bootstrap 4 UI kit.">
    <meta itemprop="image" content="http://s3.amazonaws.com/creativetim_bucket/products/62/original/opt_nukp_thumbnail.jpg">


    
</head>

<body class="profile-page sidebar-collapse" >


	<!-- <script src="blogScript.js" ></script> -->
    <!-- Navbar -->
    <?php $nav_bar = include_once ("nav.php"); echo $nav_bar; ?>
    <!-- End Navbar -->
    <div class="wrapper">
        <div class="page-header page-header-small">
            <div class="page-header-image" data-parallax="true" style="background-image: url('../assets/img/bg5.jpg');">
        </div>
            <div class="container">

                
                <div class="content-center" id="one">
                    <h2 class="title"><?php echo $title ?></h3>
                    <br>
                    <div class="content">
                        <div class="social-description">
                            <h2 id="readsCountId"><?php echo $reads ?></h2>
                            <p>Reads</p>
                        </div>
                        <div class="social-description">
                            <h2 id="likesCountId"><?php echo $likes ?></h2>
                            <p>Likes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="button-container">

                    <div class="photo-container">
                        <img src="../assets/img/ryan.jpg" alt="">
                    </div>

                    <p class="category" id="titlekiid"><?php echo $offeredby ?></p>
                    <p class="category" ><?php echo $date ?></p>

                </div>

               <div class="container tim-container" style="max-width:800px; padding-top:1px">

                   <!-- <h1 class="text-center">Awesome looking header <br> just for my friends</h1> -->
                   
                   <span id = "addTagsHere">
                    
                    <?php getTags()?>
                        <!-- span >
                            <button class="btn btn-primary btn-simple btn-round btn-sm" type="button" >HTML</button>
                        </span>
                
                                            
                        <span >
                            <button class="btn btn-primary btn-simple btn-round btn-sm" type="button">CSS</button>
                        </span>
                        <span >
                            <button class="btn btn-primary btn-simple btn-round btn-sm" type="button">JavaScript</button>
                        </span> -->
                    </span>
                    
                    <?php

                    // $video_url = "../assets/img/blog/".$blogId."/".$video_url;

                    // echo ' <video width="800" height="400" controls text-align = "center">
                    //             <source src='. $video_url.' type="video/mp4">
                    //               Your browser does not support the video tag.
                    //         </video>';
                    ?>
                    
                    <br>
                   <p><?php echo $GLOBALS['desc']; ?></p>
                   <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->      
                   <!--     end extras --> 


                  
                   <div class="col text-center" id="two">
                        <!-- <a href="#pablo" class="btn btn-primary btn-round btn-lg"</a>  -->
                        <br>
                        <h8>Like</h8>
                        <button class="btn btn-primary btn-round btn-lg" type="button" onclick="likesCount()" >
                            <i class="now-ui-icons ui-2_favourite-28" ></i> 
                        </button>
                   </div>
                   <br><br>
                    <div class="col text-center"> 
                        <a href="#pablo" class="btn btn-primary btn-round btn-lg">Comments</a> 
                        <button class="btn btn-primary btn-round btn-lg" type="button">
                            10
                        </button>
                   </div>

              </div>
              <br><br><br><br>


              <!-- <iframe height="200px" width="100%" src="suggest_blog.htm" name="iframe_a"></iframe> -->

<div class="section">


<?php 
    require('connect.php');

//  $dbc = mysqli_connect('localhost', 'root', NULL, 'aprl')
//     or die('Unable to connect to database');
    $blogId = $_POST['hidden_name'];;

    $query3 = "SELECT tagname FROM tag INNER JOIN blogtag ON blogtag.tag_id = tag.tag_id WHERE blogtag.blog_id = 
    '$blogId' ";
        $result3 = mysqli_query($dbc,$query3)
        or die("Unable to request tags from database");

        echo "<h3 class="."title text-center".">You may also be interested in</h3>
        <br />
        <div class="."row".">" ;
        
        $rowTag1 = mysqli_fetch_assoc($result3);
        $rowTag2 = mysqli_fetch_assoc($result3);
        $rowTag3 = mysqli_fetch_assoc($result3);
        // echo $rowTag1['tagname'];
        // echo $rowTag2['tagname'];
        // echo $rowTag3['tagname'];

        $querya = "SELECT DISTINCT blog.blog_id,blog.title, blog.description FROM ((blogtag INNER JOIN tag ON 
        tag.tag_id = blogtag.tag_id ) INNER JOIN blog ON blog.blog_id = blogtag.blog_id) 
        WHERE (tag.tagname = '$rowTag1[tagname]' AND 
        tag.tagname = '$rowTag2[tagname]' OR tag.tagname = '$rowTag3[tagname]' AND (NOT blog.blog_id =
         '$blogId') ) ORDER BY blog.reads DESC";
        

        $resulta = mysqli_query($dbc,$querya);
        if(!$resulta){
            echo("Errorcode: " . mysqli_errno($dbc));
        }

        // or die("Unable to request tags from database");
        // $x = 0;
        $rowDataq = mysqli_fetch_assoc($resulta);
        if($rowDataq!=NULL){
           // while($rowData = mysqli_fetch_assoc($resulta)){
                        // $x++;

                       echo' <div class="col-md-4" onclick="clicksuggest('.$rowDataq['blog_id'].')">
                            <div class="card card-plain card-blog">
                                <div class="card-image">
                                        <img class="img rounded img-raised" src="../assets/img/bg5.jpg" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h6 class="category text-info">Blog</h6>
                                    <h4 class="card-title">
                                        <a >'.$rowDataq['title'].'</a>
                                    </h4>
                                    <p class="card-description">'.
                                        substr($rowDataq['description'],0,100).'
                                        <a >   .......      Read More </a>
                                    </p>
                                </div>
                            </div>
                        </div>';
                        // if($x == 3){
                        //     break;
                        // }
        // } 
        }
        

        $rowDatar = mysqli_fetch_assoc($resulta);
        if($rowDatar!=NULL){
            // while($rowData = mysqli_fetch_assoc($resulta)){
                        // $x++;

                       echo' <div class="col-md-4" onclick="clicksuggest('.$rowDatar['blog_id'].')">
                            <div class="card card-plain card-blog">
                                <div class="card-image">
                                        <img class="img rounded img-raised" src="../assets/img/bg5.jpg" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h6 class="category text-info">Blog</h6>
                                    <h4 class="card-title">
                                        <a >'.$rowDatar['title'].'</a>
                                    </h4>
                                    <p class="card-description">'.
                                        substr($rowDatar['description'],0,100).'
                                        <a >   .......      Read More </a>
                                    </p>
                                </div>
                            </div>
                        </div>';
                        // if($x == 3){
                        //     break;
                        // }
        // }
        }
        

        $rowDatas = mysqli_fetch_assoc($resulta);
        if($rowDatas!=NULL){
// while($rowData = mysqli_fetch_assoc($resulta)){
                        // $x++;

                       echo' <div class="col-md-4" onclick="clicksuggest('.$rowDatas['blog_id'].')">
                            <div class="card card-plain card-blog">
                                <div class="card-image">
                                        <img class="img rounded img-raised" src="../assets/img/bg5.jpg" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h6 class="category text-info">Blog</h6>
                                    <h4 class="card-title">
                                        <a >'.$rowDatas['title'].'</a>
                                    </h4>
                                    <p class="card-description">'.
                                        substr($rowDatas['description'],0,100).'
                                        <a >   .......      Read More </a>
                                    </p>
                                </div>
                            </div>
                        </div>';
                        // if($x == 3){
                        //     break;
                        // }
        // }
        
        }

        if($rowDatas==NULL && $rowDatar==NULL && $rowDataq==NULL){
            // echo "i'm here";

        $querya1 = "SELECT DISTINCT blog.blog_id,blog.title, blog.description FROM blog WHERE 
        (NOT blog.blog_id = '$blogId') ORDER BY blog.reads DESC";
        

        $resulta1 = mysqli_query($dbc,$querya1);
        if(!$resulta1){
            echo("Errorcode: " . mysqli_errno($dbc));
        }

        // or die("Unable to request tags from database");
        // $x = 0;
        $rowDataq1 = mysqli_fetch_assoc($resulta1);
        if($rowDataq1!=NULL){
           // while($rowData = mysqli_fetch_assoc($resulta)){
                        // $x++;

                       echo' <div class="col-md-4" onclick="clicksuggest('.$rowDataq1['blog_id'].')">
                            <div class="card card-plain card-blog">
                                <div class="card-image">
                                        <img class="img rounded img-raised" src="../assets/img/bg5.jpg" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h6 class="category text-info">Blog</h6>
                                    <h4 class="card-title">
                                        <a >'.$rowDataq1['title'].'</a>
                                    </h4>
                                    <p class="card-description">'.
                                        substr($rowDataq1['description'],0,100).'
                                        <a >   .......      Read More </a>
                                    </p>
                                </div>
                            </div>
                        </div>';
                        // if($x == 3){
                        //     break;
                        // }
        // } 
        }
        

        $rowDatar1 = mysqli_fetch_assoc($resulta1);
        if($rowDatar1!=NULL){
            // while($rowData = mysqli_fetch_assoc($resulta)){
                        // $x++;

                       echo' <div class="col-md-4" onclick="clicksuggest('.$rowDatar1['blog_id'].')">
                            <div class="card card-plain card-blog">
                                <div class="card-image">
                                        <img class="img rounded img-raised" src="../assets/img/bg5.jpg" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h6 class="category text-info">Blog</h6>
                                    <h4 class="card-title">
                                        <a >'.$rowDatar1['title'].'</a>
                                    </h4>
                                    <p class="card-description">'.
                                        substr($rowDatar1['description'],0,100).'
                                        <a >   .......      Read More </a>
                                    </p>
                                </div>
                            </div>
                        </div>';
                        // if($x == 3){
                        //     break;
                        // }
        // }
        }
        

        $rowDatas1 = mysqli_fetch_assoc($resulta1);
        if($rowDatas1!=NULL){
// while($rowData = mysqli_fetch_assoc($resulta)){
                        // $x++;

                       echo' <div class="col-md-4" onclick="clicksuggest('.$rowDatas1['blog_id'].')">
                            <div class="card card-plain card-blog">
                                <div class="card-image">
                                        <img class="img rounded img-raised" src="../assets/img/bg5.jpg" />
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h6 class="category text-info">Blog</h6>
                                    <h4 class="card-title">
                                        <a >'.$rowDatas1['title'].'</a>
                                    </h4>
                                    <p class="card-description">'.
                                        substr($rowDatas1['description'],0,100).'
                                        <a >   .......      Read More </a>
                                    </p>
                                </div>
                            </div>
                        </div>';
                        // if($x == 3){
                        //     break;
                        // }
        // }
        
        }
        }
        

    echo "</div>";

                   
                        
           
?>


   
            </div>
        </div>
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
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="../assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>


<script type="text/javascript">
$.fn.isInViewport = function() {
  var elementTop = $(this).offset().top;
  var elementBottom = elementTop + $(this).outerHeight();

  var viewportTop = $(window).scrollTop();
  var viewportBottom = viewportTop + $(window).height();

  return elementBottom > viewportTop && elementTop < viewportBottom;
};

var count1 = 0,
    count2 =0;
  $(window).on('resize scroll', function() {
    if ($('#one').isInViewport()) {
        if(count1 == 0){
        $.ajax({ 
                   type: "POST",
                    url: "blogStatus.php",
                    data: {
                        'blogid': <?php echo $blogId; ?>,
                        'id': 'one'
                    },
                    success: function(data){
                       // $('#one').html(data);
                    }
                });
            count1++;
    }
    }
    if ($('#two').isInViewport()) {
        if (count2==0) {
        $.ajax({ 
                   type: "POST",
                    url: "blogStatus.php",
                    data: {
                        'blogid': <?php echo $blogId; ?>,
                        'id': 'two'
                    },
                    success: function(data){
                        //$('#two').html(data);
                    }
                });
    }
    }
});
</script>

        </html>
