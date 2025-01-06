<?php
    include '../config/session_manager.php';
    
    header("Cache-Control: no-cache, no-store, must-revalidate"); 
    header("Pragma: no-cache");
    header("Expires: 0");
    
    if (!isset($_SESSION['ID_No'])) {
        header("Location: login.php");
        exit();
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Barangay Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="../assets/pics/logo.png" />
  <style>
    body {
      font-family: verdana, geneva, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }

    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      width: 200px;
      background: linear-gradient(180deg, #4ad489, #34af6d);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding-top: 20px;
    }

    .sidebar .logo {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar .logo img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
    }

    .sidebar .logo span {
      font-weight: bold;
      font-size: 18px;
      text-transform: uppercase;
      color: #fff;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar ul li {
      margin-bottom: 20px;
    }

    .sidebar ul li a {
      text-decoration: none;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 10px;
      transition: background-color 0.3s ease, transform 0.3s ease;
      border-radius: 5px;

    }

    .sidebar ul li a:hover {
      background-color: rgba(255, 255, 255, 0.2);
      transform: translateX(10px);
    }

    .sidebar ul li a i {
      margin-right: 10px;
    }

    .main {
      margin-left: 200px;
      padding: 20px;
      background-color: #f2eeee;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .main h1 {
      color: #333;
    }
    
    .main-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .card-custom {
      margin-bottom: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 10px;
    }

    .card-custom:hover {
      transform: translateY(-10px);
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
    }

    .card-custom .card-header {
      background-color: #4ad489;
      color: #fff;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .card-custom .card-body {
      text-align: center;
    }

    .card-custom .card-body button {
      margin-top: 15px;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      background-color: #4ad489;
      color: #fff;
      border: none;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .card-custom .card-body button:hover {
      background-color: #34af6d;
      transform: scale(1.1);
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo">
      <img src="../assets/pics/logo.png" alt="Logo">
      <span>Admin</span>
    </div>
    <ul>
      <li><a href="admindashboard.php">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
      </a></li>
      <li><a href="view_req_records.php">
        <i class="fas fa-users"></i>
        <span>View Request Records</span>
      </a></li>
      <li><a href="view_complaints.php">
        <i class="fas fa-users"></i>
        <span>View Barangay Complaints</span>
      </a></li>
      <li><a href="view_blotter.php">
        <i class="fas fa-file-alt"></i>
        <span>View Blotter Cases</span>
      </a></li>
      <li><a href="account_settings.php">
        <i class="fas fa-cogs"></i>
        <span>User Account Settings</span>
      </a></li>
      <li><a href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <span>Log out</span>
      </a></li>
    </ul>
  </div>

  <div class="main">
    <div class="main-top">
      <h1>Barangay Dashboard</h1>
      <i class="fas fa-user-cog"></i>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>Voters</h4>
          </div>
          <div class="card-body">
            <p>Total voters: 0</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>Female Population</h4>
          </div>
          <div class="card-body">
            <p>Total females: 0</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>Male Population</h4>
          </div>
          <div class="card-body">
            <p>Total males: 0</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>Total Population</h4>
          </div>
          <div class="card-body">
            <p>Total residents: 0</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>Non-voters</h4>
          </div>
          <div class="card-body">
            <p>Total non-voters: 0</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>View Statistics</h4>
          </div>
          <div class="card-body">
            <p>Statistics</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>PWD</h4>
          </div>
          <div class="card-body">
            <p>Total of PWD: 0</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>Senior</h4>
          </div>
          <div class="card-body">
            <p>Total of seniors: 0</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom">
          <div class="card-header">
            <h4>Pregnant</h4>
          </div>
          <div class="card-body">
            <p>Total of pregnants: 0</p>
            <button>View Details</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
