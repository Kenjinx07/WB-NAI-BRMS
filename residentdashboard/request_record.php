<?php 
    include '../config/session_manager.php';
    
    $conn = new sample_class();
    $ID_No = trim($_SESSION['ID_No']);
    $user = $conn->fetchUser($ID_No);

    $conn = new sample_class();

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
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new sample_class();

        $RF_Name = $_POST['RF_Name'];
        $RM_Name = $_POST['RM_Name'];
        $RL_Name = $_POST['RL_Name']; 
        $Request_Type = $_POST['Request_Type'];
        $Request_Reason = $_POST['Request_Reason'];

        $add = $conn->add_requestRecord($RF_Name, $RM_Name, $RL_Name, $Request_Type, $Request_Reason);

        if($add == TRUE) {
            echo "<div class='alert alert-success' role='alert'>Request Record Successfully! <script>setTimeout(function(){ location.replace('request_record.php'); }, 1000);</script></div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Request Record Failed! <script>setTimeout(function(){ location.replace('request_record.php'); }, 1000);</script></div>";
        }
    }

?>  
<script>
function showSuccessModal() {
      var successModal = new bootstrap.Modal(document.getElementById('successModal'));
      successModal.show();
}

function confirmSubmit() {
    return confirm('Are you sure you want to submit the form?');
}

function confirmCancel() {
    return confirm('Are you sure you want to cancel and leave this page?');
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
          } else if (!confirmSubmit()) {
            event.preventDefault();
          }
          form.classList.add('was-validated')
        }, false)
      })
  })()
</script>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="expires" content="0">
    <title>Request Record</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/pics/logo.png" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }
        form {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .request-info {
            margin-bottom: 20px;
        }
        .request-info label {
            font-weight: bold;
            color: #495057;
        }
        .request-info input,
        .request-info select,
        .request-info textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 2px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .request-info input:hover,
        .request-info select:hover,
        .request-info textarea:hover {
            border-color: #80bdff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
        }

        .request-info input:focus,
        .request-info select:focus,
        .request-info textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .submit-btn, .cancel-btn {
            width: 48%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .cancel-btn {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .submit-btn, .cancel-btn {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Request Record Form</h1><br>
    <form id="requestForm" method="post" action="">

        <div class="request-info">
            <label for="RF_Name">First Name:</label>
            <input type="text" id="RF_Name" name="RF_Name" value="<?php echo $F_Name; ?>" required>
            <label for="RM_Name">Middle Name:</label>
            <input type="text" id="RM_Name" name="RM_Name" value="<?php echo $M_Name; ?>" required>
            <label for="RL_Name">Last Name:</label>
            <input type="text" id="RL_Name" name="RL_Name" value="<?php echo $L_Name; ?>" required>
        </div>
        <div class="request-info">
            <label for="Request_Type">Record Type:</label>
            <select id="Request_Type" name="Request_Type" required>
                <option value="" disabled selected>Select Request Type</option>
                <option value="Barangay Clearance">Barangay Clearance</option>
                <option value="Barangay Residency">Barangay Residency</option>
                <option value="Indigence Certificate">Indigence Certificate</option>
                <option value="Mother and Child Record">Mother and Child Record</option>
                <option value="Health Record">Health Record</option>
            </select>
        </div>
        <div class="request-info">
            <label for="Request_Reason">Request Description:</label>
            <textarea id="Request_Reason" name="Request_Reason" rows="3" required></textarea>
        </div>

        <div class="action-buttons">
        <button type="button" class="cancel-btn" onclick="if(confirmCancel()) window.location.href='residentdashboard.php'">Cancel</button>
            <button type="submit" class="submit-btn" onclick="return confirmSubmit()">Submit Request</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
