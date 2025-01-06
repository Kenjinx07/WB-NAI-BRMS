<?php 

require_once "config/sample_class.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $Password = htmlspecialchars($_POST['Password']);
    $PasswordConfirm = htmlspecialchars($_POST['PasswordConfirm']);
    $F_Name = htmlspecialchars($_POST['F_Name']);
    $M_Name = htmlspecialchars($_POST['M_Name']);
    $L_Name = htmlspecialchars($_POST['L_Name']);
    $Birth_Date = $_POST['Birth_Date']; 
    $Contact_No = htmlspecialchars($_POST['Contact_No']);
    $Gender = htmlspecialchars($_POST['Gender']);
    $Civil_Status = htmlspecialchars($_POST['Civil_Status']);
    $Nationality = htmlspecialchars($_POST['Nationality']);
    $Is_pwd = htmlspecialchars($_POST['Is_pwd']);
    $Is_pregnant = htmlspecialchars($_POST['Is_pregnant']);
    $Subdivision = htmlspecialchars($_POST['Subdivision']);
    $Street_Name = htmlspecialchars($_POST['Street_Name']);
    $Block = htmlspecialchars($_POST['Block']);
    $Lot = htmlspecialchars($_POST['Lot']);
    
    if ($Password !== $PasswordConfirm) {
        echo "<div class='alert alert-danger' role='alert'>Passwords do not match! <script>setTimeout(function(){ location.replace('index.php'); }, 1000);</script></div>";
        exit;
    }

    $PasswordHash = password_hash($Password, PASSWORD_DEFAULT);
    $Role = 'unverified';  

    $conn = new sample_class();
    $add = $conn->add_user($Email, $PasswordHash, $F_Name, $M_Name, $L_Name, $Birth_Date, $Contact_No, $Gender, $Civil_Status, $Nationality, $Is_pwd, $Is_pregnant, $Subdivision, $Street_Name, $Block, $Lot, $Role);
    
    if ($add === TRUE) {
        echo "
        <div class='alert alert-success' role='alert' style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 50%; text-align: center; z-index: 9999;'>
            Registered Successfully! 
            <script>
                setTimeout(function() {
                    var alertBox = document.querySelector('.alert');
                    alertBox.style.transition = 'opacity 0.5s';
                    alertBox.style.opacity = 0;
                    setTimeout(function() {
                        location.replace('index.php');
                    }, 500); // Redirect after fade-out
                }, 1000);
            </script>
        </div>";
    } else {
        echo "
        <div class='alert alert-danger' role='alert' style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 50%; text-align: center; z-index: 9999;'>
            Registration Failed! Please try again later.
        </div>";
    }    
}
?>
