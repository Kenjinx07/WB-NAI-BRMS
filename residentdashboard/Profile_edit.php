<?php
ob_start(); 
include '../config/session_manager.php';


if (!isset($_SESSION['ID_No'])) {
    header("Location: login.php");
    exit();
}

$user_ID = trim($_SESSION['ID_No']);
$user = $conn->fetchUser($user_ID);

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
if (isset($_SESSION['success_msg'])) {
    echo '<div class="alert alert-success text-center">' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']);
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
  <title>Edit Profile</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="../assets/pics/logo.png?v=1.0">
  <style>
    body {
      font-family: verdana, geneva, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }
    .profile-edit-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      margin: auto;
    }
    .profile-edit-container h1 {
      margin-bottom: 20px;
      margin-top: 25px;
      font-size: 24px;
      text-align: center;
    }
    .profile-edit-container .btn {
      font-size: 16px;
    }
    .footer {
      text-align: center;
      padding: 10px;
      background-color: #fff;
      border-top: 1px solid #e0e0e0;
    }

    .profile-edit-container input:hover, 
    .profile-edit-container select:hover,
    .profile-edit-container textarea:hover {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .profile-edit-container input:focus, 
    .profile-edit-container select:focus,
    .profile-edit-container textarea:focus {
      border-color: #0056b3;
      box-shadow: 0 0 10px rgba(0, 86, 179, 0.5);
    }

    .profile-edit-container .btn:hover {
      background-color: #0056b3;
      border-color: #004494;
    }

    .profile-edit-container .btn-danger:hover {
      background-color: #d9534f;
      border-color: #c9302c;
    }

    .input-group-text:hover {
      background-color: #e9ecef;
    }
  </style>
</head>
<body>
<div class="profile-edit-container">
  <h1>Edit Profile</h1>
    <h2 class="text-center"> Verify Identification </h2>

    <form action="predict_front.php" method="POST" enctype="multipart/form-data">
    <label>Upload Front ID:</label>
    <input type="file" name="front_id" required>
    <button type="submit">Verify Front</button>
</form>

<form action="predict_back.php" method="POST" enctype="multipart/form-data">
    <label>Upload Back ID:</label>
    <input type="file" name="back_id" required>
    <button type="submit">Verify Back</button>
</form>

  <div id="loading" style="display: none;">
        <p>Verifying identification...</p>
    </div>

    <div id="result"></div>

    <script>
    $(document).ready(function() {
        $('#uploadForm').on('submit', function(event) {
            event.preventDefault();
            
            var formData = new FormData(this);
            $('#loading').show();

            $.ajax({
                url: 'http://localhost:5000/verify',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#loading').hide();
                    $('#result').html(response);
                },
                error: function() {
                    $('#loading').hide();
                    $('#result').html('<p>Error occurred.</p>');
                }
            });
        });
    });
</script>

</form>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
    <input type="hidden" name="user_id" value="<?php echo $user_ID; ?>" />
    <div class="mb-3">
      <label for="F_Name" class="form-label"><br> First Name</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input type="text" class="form-control" id="F_Name" name="F_Name" value="<?php echo $F_Name; ?>" required>
        <div class="invalid-feedback">Please enter your first name.</div>
      </div>
    </div>

    <div class="mb-3">
      <label for="M_Name" class="form-label">Middle Name</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input type="text" class="form-control" id="M_Name" name="M_Name" value="<?php echo $M_Name; ?>">
      </div>
    </div>

    <div class="mb-3">
      <label for="L_Name" class="form-label">Last Name</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input type="text" class="form-control" id="L_Name" name="L_Name" value="<?php echo $L_Name; ?>" required>
        <div class="invalid-feedback">Please enter your last name.</div>
      </div>
    </div>

    <div class="mb-3">
      <label for="Email" class="form-label">Email</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $Email; ?>" required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
      </div>
    </div>

    <div class="mb-3">
      <label for="Contact_No" class="form-label">Phone Number</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
        <input type="tel" class="form-control" id="Contact_No" name="Contact_No" value="<?php echo $Contact_No; ?>" required>
        <div class="invalid-feedback">Please enter your phone number.</div>
      </div>
    </div>

    <div class="mb-3">
      <label for="Password" class="form-label">Password</label>
      <div class="input-group">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
        <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your password">
        <div class="invalid-feedback">Please enter your password.</div>
      </div>
    </div>

    <button type="submit" class="btn btn-success w-100 mb-3">Save Changes</button>
    <button type="button" class="btn btn-danger w-100" onclick="window.location.href='residentdashboard.php';">Cancel</button>
</form>
<script>
  function showSuccessModal() {
      var successModal = new bootstrap.Modal(document.getElementById('successModal'));
      successModal.show();
  }

  function confirmSubmit() {
    return confirm('Are you sure you want to submit the form?');
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
  // Handle the front image
  if (isset($_FILES['front_image']) && $_FILES['front_image']['error'] == 0) {
      $allowed_types = ['image/jpeg', 'image/png'];
      $front_file = $_FILES['front_image'];

      if (in_array($front_file['type'], $allowed_types) && $front_file['size'] <= 5000000) { // Max 5MB file size
          $upload_dir = 'uploads/';
          $front_file_path = $upload_dir . basename($front_file['name']);

          if (!file_exists($upload_dir)) {
              mkdir($upload_dir, 0777, true); // Create the uploads directory if it does not exist
          }

          if (move_uploaded_file($front_file['tmp_name'], $front_file_path)) {
              echo "Front image uploaded successfully!";
          } else {
              echo "Error uploading front image.";
          }
      } else {
          echo "Invalid front image type or size.";
      }
  } else {
      echo "No front image uploaded or file upload error.";
  }

  // Handle the back image
  if (isset($_FILES['back_image']) && $_FILES['back_image']['error'] == 0) {
      $allowed_types = ['image/jpeg', 'image/png'];
      $back_file = $_FILES['back_image'];

      if (in_array($back_file['type'], $allowed_types) && $back_file['size'] <= 5000000) { // Max 5MB file size
          $upload_dir = 'uploads/';
          $back_file_path = $upload_dir . basename($back_file['name']);

          if (!file_exists($upload_dir)) {
              mkdir($upload_dir, 0777, true); // Create the uploads directory if it does not exist
          }

          if (move_uploaded_file($back_file['tmp_name'], $back_file_path)) {
              echo "Back image uploaded successfully!";
          } else {
              echo "Error uploading back image.";
          }
      } else {
          echo "Invalid back image type or size.";
      }
  } else {
      echo "No back image uploaded or file upload error.";
  }

  if (isset($_POST['user_id'])) {
      $user_id = $_POST['user_id'];
  } else {
      echo "No user ID provided.";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = new sample_class();
  $user_id = $_POST['user_id'];

  $F_Name = !empty($_POST['F_Name']) ? $_POST['F_Name'] : null;
  $M_Name = !empty($_POST['M_Name']) ? $_POST['M_Name'] : null;
  $L_Name = !empty($_POST['L_Name']) ? $_POST['L_Name'] : null;
  $Email = !empty($_POST['Email']) ? $_POST['Email'] : null;
  $Contact_No = !empty($_POST['Contact_No']) ? $_POST['Contact_No'] : null;

  $result = $conn->edit_my_account($user_id, $F_Name, $M_Name, $L_Name, $Email, $Contact_No);

  if ($result) {
        $_SESSION['success_msg'] = "Profile updated successfully.";
        header("Location: Profile_edit.php");
        exit();
    } else {
        echo "No changes were made.";
  }
}
ob_end_flush()
?>
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h5 class="modal-title" id="successModalLabel">File uploaded successfully!</h5>
        <button type="button" class="btn btn-success mt-3" data-bs-dismiss="modal" onclick="location.reload();">OK</button>
      </div>
    </div>
  </div>
</div>
<script>
  function showSuccessModal() {
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/onnxruntime-web/dist/ort.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
</body>
</html>
