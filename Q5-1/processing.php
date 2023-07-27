<?php
require_once('tools.php');
session_start();




// Process Signup Process
function signupProcessing()
{

    // if data was entered (no empty fields) --> let's process
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confpassword']) && !empty($_POST['name'])) {

        $email = '';
        $name = $_POST['name'];
        $password = $_POST['password'];
        $pass_confirm = $_POST['confpassword'];

        //Validating data (email)
        $filtered_email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)); // filters (cleans) email from any white spaces
        if ($valid_email = filter_var($filtered_email, FILTER_VALIDATE_EMAIL)) { // validates email is valid
            $email = $valid_email;
        } else {
            redirect_page('form.php?status=invalid_email&signupform=yes');
            die('exit');
        }

        //validate password confirmation
        if ($password == $pass_confirm) {

            //at this point, data is valid 

            // -- check if a user with that email already exists or not
            //false --> can enter, true --> someone with same email exists
            $result = find_signup($email);
            if (!$result) {

                //1) insert user into database
                $id = create_user($name,$email,$password);
                
                setcookie('id', $id, time() + 60 * 60 * 24 * 365, '/');
                setcookie('name', $name, time() + 60 * 60 * 24 * 365, '/');
                //3) store in session (for access allowance for other pages)
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;

            } else {
                redirect_page('form.php?status=already_exists&signupform=yes'); // handle status
            }
        } else {
            redirect_page('form.php?status=dismatch&signupform=yes'); // handle status
            die('exit');
        }
    } else {
        redirect_page('form.php?status=empty&signupform=yes'); //to display alert message in case of empty fields (use BS modal)
    }
}


// Process Login
function loginProcessing()
{
    // if data was entered (no empty fields) --> let's process
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = '';
        $password = $_POST['password'];

        //Validating data (email)
        $filtered_email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)); //filters (cleans) email from any white spaces
        if ($valid_email = filter_var($filtered_email, FILTER_VALIDATE_EMAIL)) { //validates email is valid
            $email = $valid_email;
        } else {
            redirect_page('form.php?status=invalid_email&loginform=yes');
        }

        //at this point, data is valid and we can check existence of this user in system

        $result = find_login($email, $password);
        if ($result) {


            // Store credentials in cookies
            setcookie('name', $result->name, time() + 60 * 60 * 24 * 365, "/");
            setcookie('id', $result->user_id, time() + 60 * 60 * 24 * 365, "/");

            //to propagate user's data throughout pages
            $_SESSION['name'] = $result->name;
            $_SESSION['id'] = $result->user_id;

        } else {
            redirect_page('form.php?status=not_found&loginform=yes');
        }
    } else {
        redirect_page('form.php?status=empty&loginform=yes');
    }
}


// Credentials Check
function credentialsCheck()
{

    if (empty($_SESSION['name'])) {
        // me7tageen n3aby el session

        if (!empty($_COOKIE['name'])) { //y3ny ana already logged in bs lesa ba2ol besmellah habda2 el session
            $_SESSION['name'] = $_COOKIE['name'];
            $_SESSION['id'] = $_COOKIE['id'];
        } else { // illegal access state - msh 3amel login w by7awel y access el page de
            redirect_page('login.php');
        }
    }
}


// Process Logout
function logoutProcessing()
{
    session_destroy();
    setcookie('name', null, time(), "/");
    setcookie('id', null, time(), "/");
    redirect_page('login.php');
}


// return name for session
function get_username()
{
    return $_SESSION['name'];
}

// return name for session
function get_id()
{
    return $_SESSION['id'];
}









if (!empty($_GET['mode'])) {
    if ($_GET['mode'] == "logout") {
        logoutProcessing();
    }
}

