<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config/session_manager.php';

$conn = new sample_class();
$ID_No = trim($_SESSION['ID_No']);
$user = $conn->fetchUser($ID_No);

if (!$user) {
  session_unset();
  session_destroy();
  header("Location: login.php?message=Session expired");
  exit();
}
$is_verified = $user['Role'] === 'verified';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    .container {
      display: flex;
    }

    nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    nav {
      position: sticky;
      top: 0;
      bottom: 0;
      height: 100vh;
      width: 300px;
      background: linear-gradient(180deg, #4ad489, #34af6d);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: width 0.5s ease-in-out;
    }

    .logo {
      text-align: center;
      display: flex;
      color: #000000;
      margin: 5px 0 0 5px;
      padding-bottom: 3rem;
    }

    .logo img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
    }

    nav a {
      text-decoration: none;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 15px 20px;
      transition: background-color 0.3s ease;
      font-size: 1rem;
    }

    nav a:hover {
      background-color: #34af6d;
      border-left: 5px solid #fff;
    }

    nav i {
      margin-right: 15px;
    }

    .nav-item {
      text-transform: uppercase;
      font-size: 0.9rem;
      margin-left: 10px;
    }

    .main {
      padding: 20px;
      width: 100%;
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

    .data-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
    }

    .card {
      width: 25%;
      margin: 10px;
      background: #fff;
      text-align: center;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
    }

    .card h4 {
      text-transform: uppercase;
      margin-bottom: 15px;
      color: #333;
    }

    .card p {
      color: #666;
    }

    .card button {
      margin-top: 15px;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      background-color: #4ad489;
      color: #fff;
      border: none;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .card button:hover {
      background-color: #34af6d;
      transform: translateY(-3px);
    }

    .main-top i {
      margin: 10px 30px;
      color: #666;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <body data-is-verified="<?php echo $is_verified; ?>">
  <div class="container">
    <nav>
      <ul>
        <li>
          <a href="" class="logo">
          <img src="../assets/pics/logo.png" alt="Logo">
          </a>
        </li>
        <li><a href="residentdashboard.php">
          <i class="fas fa-home"></i>
          <span class="nav-item">Dashboard</span>
        </a></li>
        <li><a href="News.php">
          <i class="fas fa-newspaper"></i>
          <span class="nav-item">News</span>
        </a></li>
        <li><a href="Profile_edit.php">
          <i class="fas fa-cogs"></i>
          <span class="nav-item">Settings</span>
        </a></li>
        <li><a href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>

    <section class="main">
      <a class="main-top">
        <h1>Barangay Dashboard</h1>
      </a>

      <div class="data-section">
        <div class="card">
          <h4>File a Complaint</h4>
          <button class="action-btn" data-action="file_complaint.php">View Details</button>
        </div>

        <div class="card">
          <h4>Request Record</h4>
          <button class="action-btn" data-action="request_record.php">View Details</button>
        </div>

        <div class="card">
          <h4>File Blotter Case</h4>
          <button class="action-btn" data-action="blotter.php">View Details</button>
        </div>

        <div class="card">
          <h4>Total Population</h4>
          <button>View Details</button>
        </div>

        <div class="card">
          <h4>Faqs</h4>
          <button>View Details</button>
        </div>

        <div class="card">
          <h4>Barangay Contacts</h4>
          <button>View Details</button>
        </div>
      </div>
    </section>
  </div>

  <script>
    const isVerified = document.body.dataset.isVerified === '1';

    function showBlockedMessage() {
        alert("Your account is still unverified, please verify your account first on account settings.");
    }
    document.querySelectorAll('.action-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            if (!isVerified) {
                e.preventDefault();
                showBlockedMessage();
            } else {
                window.location.href = this.getAttribute('data-action');
            }
        });
    });
    document.querySelectorAll('.card button').forEach(button => {
        button.addEventListener('click', () => {
            const category = button.parentNode.querySelector('h4').innerText;
            handleButtonClick(category);
        });
    });
    function handleButtonClick(category) {
        const totalElement = document.querySelector(`#${category}-total`);
        if (totalElement) {
            let totalCount = parseInt(totalElement.innerText.split(': ')[1]);
            totalCount++;
            totalElement.innerText = `Total ${category}: ${totalCount}`;
        }
    }
    function openModal(category) {
        const modal = document.createElement('div');
        modal.classList.add('modal');
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>${category}</h2>
                <p>Additional details about ${category}</p>
            </div>
        `;
        document.body.appendChild(modal);
        const closeBtn = modal.querySelector('.close-btn');
        closeBtn.addEventListener('click', () => {
            modal.remove();
        });
    }
  </script>
</body>
</html>
