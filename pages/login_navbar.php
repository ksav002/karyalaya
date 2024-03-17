<?php
    include_once '../database/value_pull.php';

    $userDetails = getDetails($loggedInUsername);
    //print_r($userDetails);
    foreach($userDetails as $detail){
        $name = $detail['fname'] . ' ' . $detail['lname'];
    }
?>

<link rel="stylesheet" href="css/style.css">
<div class="nav-header">
    <div class="logo">
        <img src="../images/logo.svg" alt="Assignment Digitalization">
    </div>
    <div class="nav-welcome">
        <p>Hi, <?php echo $name; ?></p>
    </div>
    <div class="nav-button">
        <button onclick="window.location.href='sign_out.php';">Sign Out</button>
    </div>
</div>

