<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="assets/pics/logo.png" />
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            form {
                margin: 0 auto;
                width: 300px;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            input[type="text"], input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 3px;
            }
            input[type="submit"] {
                width: 100%;
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                margin: 10px 0;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }
            input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
<style>
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
</style>
<script src="assets/js/jquery.min.js"></script>
    <script type="text/javascript">
    $(window).on('load', function(){
        setTimeout(function(){
            $('#loader').fadeOut('slow');  
        });
    });
    </script>
    </head>
<body>
    <br><br><br>
<div id="loader"></div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Barangay Pasong Buaya 2</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Barangay Contacts</a>
        </li>
    </ul>
        <div class="d-flex">
        <a href="login.php"> <button class="btn btn-outline-success" type="button">Login</button></a>
        </div>
        <div class="c-flex">
        <a href="reg.php"> <button class="btn btn-outline-success" type="button">Register</button></a>    
        </div>
    </div>
    </div>
</nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>