<?php 
    include '../config/session_manager.php';
    $conn = new sample_class();
    $ID_No = trim($_SESSION['ID_No']);
    $user = $conn->fetchUser($ID_No);

    if($user) {
        $F_Name = $user['F_Name'];
        $M_Name = $user['M_Name'];
        $L_Name = $user['L_Name'];
        $Email = $user['Email'];
    } else {
        $F_Name = "";
        $M_Name = "";
        $L_Name = "";
        $Email = "";
    }

    $alertMessage = "";
    $alertClass = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $BF_Name = $_POST['BF_Name'];
        $BM_Name = $_POST['BM_Name'];
        $BL_Name = $_POST['BL_Name'];
        $B_Email = $_POST['B_Email'];
        $B_Type = $_POST['B_Type'];
        $B_Description = $_POST['B_Description'];

        $conn = new sample_class();
        $add = $conn->add_blotter($BF_Name, $BM_Name,$BL_Name, $B_Email, $B_Type, $B_Description);

        if($add == TRUE) {
            $alertMessage = "File Blotter Successfully!";
            $alertClass = "alert-success";
        } else {
            $alertMessage = "File Blotter Failed!";
            $alertClass = "alert-danger";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title>Records Request</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/pics/logo.png" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 100%;
            max-width: 700px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-group label {
            font-weight: bold;
            color: #495057;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .alert-message {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: 50%;
            text-align: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s, visibility 0.5s;
        }
        .alert-message.show {
            opacity: 1;
            visibility: visible;
        }
        .btn-custom, .btn-cancel {
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-custom {
            background-color: #28a745;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-cancel:hover {
            background-color: #c82333;
        }
        .form-control {
            border: 2px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:hover, .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
        #complaint {
            resize: none;
            border-radius: 5px;
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            .btn-custom, .btn-cancel {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="alert-message alert <?php echo $alertClass; ?>" role="alert">
        <?php echo $alertMessage; ?>
    </div>
<body>
    <div class="container">
        <div class="header">
            <h1>Blotter Form</h1>
        </div>
        <form id="complaintForm" method="post" action="" onsubmit="return confirmSubmit()">
    <div class="form-group mt-4">
        <label for="BF_Name">First Name:</label>
        <input type="text" class="form-control" id="BF_Name" name="BF_Name" value="<?php echo $F_Name; ?>" required>
    </div>
    <div class="form-group mt-4">
        <label for="BM_Name">Middle Name:</label>
        <input type="text" class="form-control" id="BM_Name" name="BM_Name" value="<?php echo $M_Name; ?>" required>
    </div>
    <div class="form-group mt-4">
        <label for="BL_Name">Last Name:</label>
        <input type="text" class="form-control" id="BL_Name" name="BL_Name" value="<?php echo $L_Name; ?>" required>
    </div>
    <div class="form-group">
        <label for="B_Email">Email:</label>
        <input type="email" class="form-control" id="B_Email" name="B_Email" value="<?php echo $Email; ?>" required>
    </div>
    <div class="form-group">
        <label for="B_Type">Case Type:</label>
        <select class="form-control" id="B_Type" name="B_Type" required>
            <option value="">Select Case Type</option>
            <option value="Theft">Theft or burglary reports</option>
            <option value="Assault">Assault</option>
            <option value="Fraud">Fraud or scam reports</option>
            <option value="Drug">Drug-related offenses</option>
            <option value="Custody">Child custody or welfare concerns</option>
            <option value="MissingPerson">Reports of missing persons</option>
            <option value="Noise">Noise control requests for parties or events</option>
            <option value="Harassment">Harassment or stalking incidents</option>
        </select>
    </div>
    <div class="form-group">
        <label for="B_Description">Complaint:</label>
        <textarea class="form-control" id="B_Description" name="B_Description" rows="3" required></textarea>
    </div>
    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-custom">Submit Blotter</button>
        <button type="button" class="btn btn-cancel" onclick="cancelForm()">Cancel</button>
    </div>
</form>
<script>
        window.onload = function() {
            var alertMessage = document.querySelector('.alert-message');
            if (alertMessage.textContent.trim() !== "") {
                alertMessage.classList.add('show');
                setTimeout(function(){
                    location.replace('blotter.php');
                }, 1000);
            }
        };

        function confirmSubmit() {
            return confirm('Are you sure you want to submit the form?');
        }

        function cancelForm() {
            if (confirm('Are you sure you want to cancel? Any unsaved data will be lost.')) {
                window.location.href = 'residentdashboard.php';
            }
        }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
