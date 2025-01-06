<?php
session_start();
require_once './config/sample_class.php';
$conn = new sample_class();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $conn->login_users($Email, $Password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="assets/pics/logo.png" />
    <title>Barangay Pasong Buaya 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin-top: 100px;
        }
        form {
            margin: 0 auto;
            width: 100%;
            max-width: 350px;
            padding: 30px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        form:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: all 0.3s ease-in-out;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        input[type="submit"]:active {
            background-color: #3e8e41;
            transform: scale(0.98);
        }

        input[type="text"]:hover, input[type="password"]:hover {
            border-color: #999;
        }

        form:hover {
            transform: scale(1.02);
        }

        #loader{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('assets/loading/Dual Ring-1s-200px.png') 50% 50% no-repeat rgb(249,249,249);
            opacity: 1;
        }
        @media (max-width: 600px) {
            form {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
    <script src="assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).on('load', function(){
            setTimeout(function(){
                $('#loader').fadeOut('slow');
            },1000);
        });
    </script>
</head>
<body>
    <form method="POST">
        <h2>Login</h2>
        <label for="Email">Email:</label>
        <input type="text" id="Email" name="Email" required>
        <label for="Password">Password:</label>
        <input type="Password" id="Password" name="Password" required>
        <input type="submit" value="Login">
    </form>
</body>
</html>
