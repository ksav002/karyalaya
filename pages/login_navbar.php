<?php
    error_reporting();
    include_once '../database/value_pull.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $userDetails = getDetails($loggedInUsername);
    //print_r($userDetails);
    foreach($userDetails as $detail){
        $name = $detail['fname'] . ' ' . $detail['lname'];
    }
?>

<div class="nav-header">
    <div class="logo">
        <img src="../images/logo.svg" alt="Assignment Digitalization">
    </div>
    <div class="nav-welcome">
        <p>
            Hi, <?php echo $name; ?>
            <!-- <br>
            <em>//<?php echo $_SESSION['title']; ?></em> -->
        </p>
    </div>
    <div class="nav-button">
        <button onclick="window.location.href='sign_out.php';">Sign Out</button>
    </div>
</div>

