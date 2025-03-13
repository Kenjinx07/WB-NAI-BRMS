<?php 

require_once "config/sample_class.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Email = isset($_POST['Email']) ? ($_POST['Email']) : '';
    $Password = isset($_POST['Password']) ? htmlspecialchars($_POST['Password']) : '';
    $PasswordConfirm = isset($_POST['PasswordConfirm']) ? htmlspecialchars($_POST['PasswordConfirm']) : '';
    $F_Name = isset($_POST['F_Name']) ? ($_POST['F_Name']) : '';
    $M_Name = isset($_POST['M_Name']) ? ($_POST['M_Name']) : '';
    $L_Name = isset($_POST['L_Name']) ? ($_POST['L_Name']) : '';
    $BirthDate = isset($_POST['BirthDate']) ? $_POST['BirthDate'] : '';
    $Contact_No = isset($_POST['Contact_No']) ? ($_POST['Contact_No']) : '';
    $Gender = isset($_POST['Gender']) ? ($_POST['Gender']) : '';
    $Civil_Status = isset($_POST['Civil_Status']) ? ($_POST['Civil_Status']) : '';
    $Nationality = isset($_POST['Nationality']) ? ($_POST['Nationality']) : '';
    $Is_pwd = isset($_POST['Is_pwd']) ? ($_POST['Is_pwd']) : '';
    $City = isset($_POST['City']) ? ($_POST['City']) : '';
    $Barangay = isset($_POST['Barangay']) ? ($_POST['Barangay']) : '';
    $Subdivision = isset($_POST['Subdivision']) ? ($_POST['Subdivision']) : '';
    $Street_Name = isset($_POST['Street_Name']) ? ($_POST['Street_Name']) : '';
    $Block = isset($_POST['Block']) ? ($_POST['Block']) : '';
    $Lot = isset($_POST['Lot']) ? ($_POST['Lot']) : '';
    
    if ($Password !== $PasswordConfirm) {
        echo "<div class='alert alert-danger' role='alert'>Passwords do not match! <script>setTimeout(function(){ location.replace('index.php'); }, 1000);</script></div>";
        exit;
    }

    $PasswordHash = password_hash($Password, PASSWORD_DEFAULT);
    $Role = 'unverified';  

    $conn = new sample_class();
    $add = $conn->add_user($Email, $PasswordHash, $F_Name, $M_Name, $L_Name, $BirthDate, $Contact_No, $Gender, $Civil_Status, $Nationality, $Is_pwd, $City, $Barangay, $Subdivision, $Street_Name, $Block, $Lot, $Role);
    
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
