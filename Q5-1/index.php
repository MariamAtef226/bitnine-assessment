<?php
require_once('processing.php');
$mode = '';
// authentication
if (!empty($_POST['signup'])) {
    $mode='s';
    signupProcessing();
} elseif (!empty($_POST['loginn'])) {
    $mode='l';
    loginProcessing();
} else {
    $mode='no';
    credentialsCheck();
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css" />

    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</head>


<body>
<div class="container-fluid bg-light outer-container p-3 text-center">
    <?php
    if($mode=='s'){
        echo "<div>Signup success</div>";
        echo "<a href='form.php' style='text-decoration:none;' class='mt-2 mb-2'>&larr; Go back to login page</a>";
        echo "<div id='countdown'>Redirecting in 10 seconds...</div>";

        echo "<script>

            // update the countdown and redirect when it reaches 0
            function updateCountdown(seconds) {
                const countdownElement = document.getElementById('countdown');
                countdownElement.textContent = 'Redirecting in '+ seconds +' seconds...';

                if (seconds <= 0) {
                    window.location.href = 'form.php';
                } else {
                    // Call the function again after 1 second (1000 milliseconds)
                    setTimeout(() => updateCountdown(seconds - 1), 1000);
                }
            }

            // Start the countdown with 10 seconds
            updateCountdown(10);

        </script>";
        
    }
    elseif ($mode=='l'){
        echo "<div>Hello, " . $_SESSION['name'] ."</div>";
    } 
    else{
        echo "<div>Access is unallowed</div>";
    }
    ?>
</div>
</body>

</html>