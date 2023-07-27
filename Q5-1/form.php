<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css" />

    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <title>Login/Sign-up</title>
</head>



<body>
    <div class="outer-container bg-light p-5">
        <h1 class="text-center mb-4 title">Login</h1>

        <div class="btn-group d-flex justify-content-center mb-3 switch" role="group" aria-label="Basic checkbox toggle button group">
            <button class="btn no-shadow btn-outline-secondary w-50 active login-btn">Login</button>
            <button class="btn no-shadow  btn-outline-secondary w-50 signup-btn">Sign Up</button>
        </div>

        <form action="index.php" method="post" class="d-flex flex-column login-form">
        
            <input class="p-2 mb-2 mt-2 border-0" placeholder="Email Address" name="email">
            <input type="hidden" name="loginn" value="yes">
            <input class="p-2 mb-2 mt-2 border-0" type="password" placeholder="Password" name="password">
            <div class="m-2 mb-3 text-center forgot"> <a class="link" href="#">Forgot your password?</a></div>
            <input class="btn active btn-outline-primary border-0" type="submit" value="Login">
            <div class="m-3 mt-4 text-center">Not a member? <button class="link border-0 bg-light signup-btn">Sign Up Now!</button></div>
            <?php
             if (!empty($_GET['loginform']) && !empty($_GET['status'])) {
                if ($_GET['status'] == 'invalid_email')
                    echo "<div class='text-center text-warning'>Invalid Email! Try Again</div>";
                else if ($_GET['status'] == 'not_found')
                    echo "<div class='text-center text-warning'>This Email isn't registered! Try Another One</div>";
                else if ($_GET['status'] == 'empty')
                    echo "<div class='text-center text-warning'>Make sure you leave no empty fields! Try Again</div>";
            }
            ?>
        </form>

        <form action="index.php" method="post" class="d-flex flex-column signup-form d-none">
            <input class="p-2 mb-2 mt-2 border-0" placeholder="Name" name="name">
            <input  type='hidden' name="signup" value='yes'>
            <input class="p-2 mb-2 mt-2 border-0" placeholder="Email Address" name="email">
            <input class="p-2 mb-2 mt-2 border-0" type="password" placeholder="Password" name="password">
            <input class="p-2 mb-3 mt-2 border-0" type="password" placeholder="Confirm Password" name="confpassword">
            <input class="btn active btn-outline-primary border-0" type="submit" value="Sign Up">
            <div class="m-2 mt-3 text-center">Already a member? <button class="link border-0 bg-light login-btn">Log in!</button></div>
            <?php
            if (!empty($_GET['signupform']) && !empty($_GET['status'])) {
                if ($_GET['status'] == 'invalid_email')
                    echo "<div class='text-center text-warning'>Invalid Email! Try Again</div>";
                else if ($_GET['status'] == 'already_exists')
                    echo "<div class='text-center text-warning'>This Email is already registerd! Try Another One</div>";
                else if ($_GET['status'] == 'dismatch')
                    echo "<div class='text-center text-warning'>Password and password confirmation mismatch! Try again</div>";
                else if ($_GET['status'] == 'empty')
                    echo "<div class='text-center text-warning'>Make sure you leave no empty fields! Try Again</div>";
            }

            ?>
        </form>

    </div>

    <?php
    if (empty($_GET['signupform'])) {
        echo '<script> loginSetup(); </script>';
    } else {
        echo '<script> signupSetup(); </script>';
    }
    ?>
</body>

</html>