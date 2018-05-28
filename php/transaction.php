<?php

    define("DB_MSG_ERROR", 'Could not connect!<br />Please contact the site\'s administrator.');
    require('connect.php');
    $conn=$dbc;
    $username = $_POST['username'];
    $project_id = $_POST['project_id'];
    $data = $_POST['data'];
    try {
        // First of all, let's begin a transaction
        $dbc->begin_transaction();

        // A set of queries; if one fails, an exception should be thrown
        $dbc->query("UPDATE userlogin SET fame=fame-'$data' WHERE username='$username'");
        $dbc->query("UPDATE project SET fame_fund=fame_fund+'$data' WHERE project_id='$project_id'");
        $query = "SELECT fame FROM userlogin WHERE username = '$username'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $fame = $row['fame'];
        if($fame < 0 or $data < 0){
            $dbc->rollback();
        }
        else{
            $dbc->commit();
        }
        
    } catch (Exception $e) {

        $dbc->rollback();
    } 
?>

