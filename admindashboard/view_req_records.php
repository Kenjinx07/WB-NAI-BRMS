<?php 
    include '../config/session_manager.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "records_management_system_db"; 
    $conn=mysqli_connect($servername, $username, $password, $database);
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM request_records";
    
    if (isset($_GET['delete_id'])) {
      $R_ID = $_GET['delete_id'];
      $sql_delete = "DELETE FROM `request_records` WHERE `R_ID` = ?";
      $stmt = $conn->prepare($sql_delete);
      $stmt->bind_param('i', $R_ID);
      
      if ($stmt->execute()) {
          echo "<script>alert('Request record successfully deleted.');</script>";
      } else {
          echo "<script>alert('Failed to remove the request.');</script>";
      }
      
      $stmt->close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Barangay Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="icon" type="image/png" href="../assets/pics/logo.png" />
  <style>
    body {
      font-family: Verdana, Geneva, sans-serif;
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
      margin-left: 220px;
      padding: 20px;
      background-color: #f2eeee;
      min-height: 100vh;
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      text-align: center;
    }

    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #333;
      color: white;
      text-align: center;
    }
    td {
    background-color: #222;
    color: white;
    }

    a {
    color: #4da6ff; /* Ensures links are visible */
    text-decoration: none;
    }

    a:hover {
    text-decoration: underline;
    }

    table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    table tr:hover {
      background-color: #ddd;
    }

    .delete-link {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }

    .delete-link:hover {
      color: darkred;
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
  <script>
    function confirmDeletionR(R_ID) {
        if (confirm('Are you sure you want to delete this request?')) {
            window.location.href = 'view_req_records.php?delete_id=' + R_ID;
        }
    }
</script>
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
      <h1>Barangay Request Record</h1>
    </div>

    <?php
    function viewRequestRecords($conn, $sql)
    {
        $row = "";
      
      if($query = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($query) > 0){
            while($result = mysqli_fetch_array($query)){
                $R_ID = $result['R_ID'];
                $RF_Name = $result ['RF_Name'];
                $RM_Name = $result ['RM_Name'];
                $RL_Name = $result ['RL_Name'];
                $Request_Type = $result['Request_Type'];
                $Request_Reason = $result['Request_Reason'];
                $R_Date = $result['R_Date'];
                $Status = $result['Status'];
            
                $row .= "<tr>
                    <td>$RF_Name</td>
                    <td>$RM_Name</td>
                    <td>$RL_Name</td>
                    <td>$Request_Type</td>
                    <td>$Request_Reason</td>
                    <td>$R_Date</td>
                    <td>$Status</td>
                    <td><a href='generate_pdf.php?R_ID=$R_ID' target='_blank'>Print</a></td>
                    <td><a href=''>Modify</a></td>
                    <td><a onclick='confirmDeletionR($R_ID)'>Delete</a></td>
                    </tr>";
                }
            }
            mysqli_free_result($query);    
        }
        return $row;
    }

  
$s = viewRequestRecords($conn, $sql);
    echo "<table>
    <tr>
      <th>First Name</th>
      <th>Middle Name</th>
      <th>Last Name</th>
      <th>Request Type</th>
      <th>Reason of Request</th>
      <th>Request Date</th>
      <th>Status</th>
      <th>Print</th>
      <th>Modify</th>
      <th>Delete Request</th>
    </tr>".$s."
    </table>";
    ?></div>
  </body>
</html>