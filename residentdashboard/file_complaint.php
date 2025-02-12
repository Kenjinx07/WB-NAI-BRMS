<?php 
    include '../config/session_manager.php';
    $conn = new sample_class();
    $ID_No = trim($_SESSION['ID_No']);
    $user = $conn->fetchUser($ID_No);

    if(isset($_SESSION['ID_No'])) {
        $ID_No = trim($_SESSION['ID_No']);
        $user = $conn->fetchUser($ID_No);

        if($user) {
            $F_Name = $user['F_Name'];
            $M_Name = $user['M_Name'];
            $L_Name = $user['L_Name'];
            $Email = $user['Email'];
            $Contact_No = $user['Contact_No'];
        } else {
            $F_Name = "";
            $M_Name = "";
            $L_Name = "";
            $Email = "";
            $Contact_No = "";
        }
    } else {
        header("Location: login.php");
        exit();
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/pics/logo.png" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        .btn-custom {
            background-color: #28a745;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            padding: 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        .form-control {
            border: 2px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:hover {
            border-color: #80bdff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.25);
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        #complaint {
            resize: none;
            border-radius: 5px;
        }

        #complaint:hover {
            border-color: #80bdff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.25);
        }

        .container:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .btn-custom {
                font-size: 16px;
                padding: 10px;
            }
            .btn-cancel {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <div class="header">
            <h1>Complaint Form</h1>
        </div>
        <form id="complaintForm" method="post" action="" onsubmit="return confirmSubmit()">
            <div class="form-group mt-4">
                <label for="CF_Name">First Name:</label>
                <input type="text" class="form-control" id="CF_Name" name="CF_Name" value="<?php echo $F_Name; ?>" required>
            </div>
            <div class="form-group mt-4">
                <label for="CM_Name">Middle Name:</label>
                <input type="text" class="form-control" id="CM_Name" name="CM_Name" value="<?php echo $M_Name; ?>" required>
            </div>
            <div class="form-group mt-4">
                <label for="CL_Name">Last Name:</label>
                <input type="text" class="form-control" id="CL_Name" name="CL_Name" value="<?php echo $L_Name; ?>" required>
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" class="form-control" id="email" name="Email" value="<?php echo $Email; ?>" required>
            </div>
            <div class="form-group">
                <label for="C_Description">Complaint:</label>
                <textarea class="form-control" id="complaint" name="C_Description" rows="3" required></textarea>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-custom">Submit Complaint</button>
                <button type="button" class="btn btn-cancel" onclick="cancelForm()">Cancel</button>
            </div>
        </form>

        <script>
            function confirmSubmit() {
                return confirm('Are you sure you want to submit the form?');
            }

            function cancelForm() {
                if (confirm('Are you sure you want to cancel? Any unsaved data will be lost.')) {
                    window.location.href = 'residentdashboard.php';
                }
            }

            (function () {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }
                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $conn = new sample_class();

                $CF_Name = $_POST['CF_Name'];
                $CM_Name = $_POST['CM_Name'];
                $CL_Name = $_POST['CL_Name'];
                $Email = $_POST['Email'];
                $C_Description = $_POST['C_Description'];

                $add = $conn->add_complaint($CF_Name, $CM_Name, $CL_Name, $Email, $C_Description);

                if($add == TRUE) {
                    echo "<div class='alert alert-success' role='alert'>Complaint Filed Successfully! <script>setTimeout(function(){ location.replace('file_complaint.php'); }, 1000);</script></div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Complaint Filing Failed! <script>setTimeout(function(){ location.replace('file_complaint.php'); }, 1000);</script></div>";
                }
            }
        ?>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
