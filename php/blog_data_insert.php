<?php
	session_start();
	require('connect.php');
    // $dbc = mysqli_connect('localhost', 'root', NULL, 'aprl')
    // or die('Unable to connect to database');
		// echo "I'm inside hahaha";
	$descripdata = $_POST['description'];
	$titledata = $_POST['title'];
	$arr = $_POST['tagsrr'];
	// echo $descripdata;
 //    echo $titledata;
 //    echo $arr[0];
		// $data = json_decode(stripslashes($_POST['data']));

	 //  // here i would like use foreach:
	$meranaam =  $_SESSION['username'];
    // echo $meranaam;

// $date = date('Y-m-d H:i:s');
	$query = "INSERT INTO blog(`description`,`date`, `spam`, `likes`, `reads`, `title`, `offeredby`) VALUES ('$descripdata',current_timestamp,'0', '0','0','$titledata','$meranaam')";
	// echo  "INSERT INTO blog(`description`,`date`, `spam`, `likes`, `reads`, `title`, `offeredby`) VALUES ('$descripdata',current_timestamp,'0', '0','0','$titledata','$meranaam')";
	// INSERT INTO `blog` (`blog_id`, `offeredby`, `description`, `date`, `image_url`, `spam`, `likes`, `reads`, `title`, `keywords`, `video_url`) VALUES (NULL, '2', 'ferfer', CURRENT_TIMESTAMP, '', '1', '3', '2', 'xffdfver', '', '');
	$result = mysqli_query($dbc,$query);
	if(!$result){
		echo("Errorcode: in date query" . mysqli_errno($dbc));
	}

	$qb = "SELECT blog_id FROM blog WHERE blog.title = '$titledata'";
	$resultb = mysqli_query($dbc,$qb)
	or die("Unable to read blogid from database");
	$blogidArr = mysqli_fetch_assoc($resultb);
	// echo $blogidArr['blog_id'];


    foreach($arr as $d){
    	$usr = json_decode($d);
    	// echo $d;
    	// $queer = "INSERT INTO tag(tagname) VALUES ('$d')";
    	// $restapi = mysqli_query($dbc,$queer);
    	// if(!$restapi){
    	// 	echo("Errorcode: " . mysqli_errno($dbc));
    	// }
    	// echo $usr;
    	$teddy = "SELECT tag.tag_id FROM tag WHERE tag.tagname = '$d'";
    	$reddy = mysqli_query($dbc,$teddy)
    	or die("Unable to read blogid from database");
    	$tagiddy = mysqli_fetch_assoc($reddy);
    	// echo $tagiddy['tag_id'];


    	$beera = "INSERT INTO blogtag(blog_id,tag_id) VALUES ('$blogidArr[blog_id]','$tagiddy[tag_id]')";
    	$reera = mysqli_query($dbc,$beera);
    	if(!$reera){
    		echo("Errorcode: " . mysqli_errno($dbc));
    	}
    	// echo $d;
    }
    echo $blogidArr['blog_id'];
    
    echo shell_exec("/usr/bin/python /home/prabhakar/Source/APRL/php/td.py 2>&1");

?>