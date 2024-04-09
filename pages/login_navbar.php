<?php
    error_reporting();
    include_once '../database/value_pull.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $loggedInUsername = $_SESSION['username'];
    $userDetails = getDetails($loggedInUsername);
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
        <a href="sign_out.php"><button onclick="return confirm('Are you sure you want to sign out?');">Sign Out</button></a>
    </div>
</div>

