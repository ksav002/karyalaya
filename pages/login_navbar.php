<?php
    error_reporting();
    include_once '../database/value_pull.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $loggedInUsername = $_SESSION['username'];
    $userDetails = getDetails($loggedInUsername);
    foreach($userDetails as $detail){
        $name = $detail['fname']. ' ' .$detail['lname'];
    }
?>

<div class="nav-header">
    <div class="logo">
        <img src="../images/logo-without-name.svg" alt="Assignment Digitalization">
    </div>
    <div class="nav-time" id="nav-time">
        <!-- here comes the date -->
        <div class="date" id="nav-date"></div>
        <!-- here comes the time -->
        <div class="clock" id="nav-clock"></div>
    </div>
    <div class="nav-welcome">
        <p>
            <?php echo $name; ?>
            <br>
            <em><?php echo ucfirst(strtolower($_SESSION['title'])) ?></em>
        </p>
    </div>
    <div class="nav-button">
        <a href="sign_out.php"><button onclick="return confirm('Are you sure you want to sign out?');">Sign Out</button></a>
    </div>
</div>

<script type="text/javascript" src="../js/script.js"></script> 
<script>
    setInterval(updateTime, 1000);
    updateTime();
</script>