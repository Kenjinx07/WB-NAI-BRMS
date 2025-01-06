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
            <a class="nav-link" href="#">Link</a>
        </li>
    </ul>
        <div class="d-flex">
        <a href="login.php"> <button class="btn btn-outline-success" type="button">Login</button></a>
        </div>
    </div>
    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="container">
        <h1>Barangay Registration Form</h1>
        <form id=msg action=registration.php method="POST">
        <label for="F_Name">First Name:</label><br>
        <input type="text" id="F_Name" name="F_Name" required><br>

        <label for="M_Name">Middle Name:</label><br>
        <input type="text" id="M_Name" name="M_Name" required><br>

        <label for="L_Name">Last Name:</label><br>
        <input type="text" id="L_Name" name="L_Name" required><br>

        <label for="Email">Email:</label><br>
        <input type="email" id="Email" name="Email" required>
        
        <label for="Password">Password:</label><br>
        <input type="password" id="Password" name="Password" required>

        <label for="PasswordConfirm">Confirm Password:</label><br>
        <input type="password" id="PasswordConfirm" name="PasswordConfirm" required>

        <br><br><br>
        
        <label>Address</label><br><br>

        <label for="Subdivision">Subdivision:</label><br>
        <input type="text" id="Subdivision" name="Subdivision" required><br>

        <label for="Street_Name">Street:</label><br>
        <input type="text" id="Street_Name" name="Street_Name" required><br>

        <label for="Block">Block:</label><br>
        <input type="number" id="Block" name="Block" required><br><br>

        <label for="Lot">Lot:</label><br>
        <input type="number" id="Lot" name="Lot" required><br><br>

        <label for="Birth_Date">Date of Birth:</label><br>
        <input type="date" id="Birth_Date" name="Birth_Date" required><br>

        <label for="Contact_No">Contact Number:</label><br>
        <input type="tel" id="Contact_No" name="Contact_No" required><br>

        <label for="Gender">Gender:</label><br>
        <select id="Gender" name="Gender" required>
            <option value=""></option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>

        <label for="Civil_Status">Civil Status:</label><br>
        <select id="Civil_Status" name="Civil_Status" required>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
        </select><br>

        <label for="Nationality">Nationality:</label><br>
        <input type="text" id="Nationality" name="Nationality" required><br>

        <label for="Is_pwd">Are you a Person with Disability?</label><br>
        <select id="Is_pwd" name="Is_pwd" required>
            <option value="No">No</option>
            <option value="Yes">Yes</option>
        </select><br>

        <label for="Is_pregnant">Are you Pregnant?</label><br>
        <select id="Is_pregnant" name="Is_pregnant" required>
            <option value="No">No</option>
            <option value="Yes">Yes</option>
        </select>

        <input type="submit" value="Submit">
    </form>
    <div id="msg" a href></div>
        </div>

    <script>

        $(document).delegate("#btn-add", "click", function(e){
            e.preventDefault();
            
            const F_Name = document.querySelector('input[id=F_Name]').value;
            console.log("==========F_Name=========");
            console.log(F_Name);
            
            const M_Name = document.querySelector('input[id=M_Name]').value;
            console.log("==========M_Name=========");
            console.log(M_Name); 
            
            const L_Name = document.querySelector('input[id=L_Name]').value;
            console.log("==========L_Name=========");
            console.log(L_Name);
            
            const Email = document.querySelector('input[id=Email]').value;
            console.log("==========Email=========");
            console.log(Email);

            const Password = document.querySelector('input[id=Password]').value;
            console.log("==========Password=========");
            console.log(Password);

            var data1 = new FormData(this.form);

            data1.append('F_Name', F_Name);
            data1.append('M_Name', M_Name);
            data1.append('L_Name', L_Name);
            data1.append('Email', Email);
            data1.append('Password', Password);

            function isValidF_Name() {
                var pattern = /^[a-zA-Z ]+$/;
                var F_Name = $("#F_Name").val();
                if (pattern.test(F_Name) && F_Name !== "") {
                    $("#F_Name").removeClass("is-invalid").addClass("is-valid");
                    $("#F_Name-error").css("display", "none");
                    return true;
                } else {
                    $("#F_Name").removeClass("is-valid").addClass("is-invalid");
                    $("#F_Name-error").html("Please input valid characters").css({
                        "color": "red",
                        "font-size": "14px",
                        "display": "block"
                    });
                    return false;
                }
            }

            function isValidM_Name(){

                var pattern = /^[a-z A-Z ]+$/;
                var M_Name = $("#M_Name").val();
                if(pattern.test(M_Name) && M_Name !== ""){
                    $("#M_Name").removeClass("is-invalid").addClass("is-valid");
                    $("#M_Name-error").css({
                    "color": "green",
                    "font-size": "14px",
                    "display": "none"
                });
                return true;
            }else if(M_Name === ""){
                $("#M_Name").removeClass("is-valid").addClass("is-valid");
                $("#M_Name-error").html("Required Full Middle Name");
                    $("M_Name-error").css({
                        "color": "red",
                        "font-size": "14px",
                    });
            }else{
                $("#M_Name").removeClass("is-invalid").addClass("is-invalid");
                $("#M_Name-error").html("Please Input Character Only");
                    $("M_Name-error").css({
                    "color": "red",
                    "font-size": "14px",
                    "display": "block"
                    });
                }
            }

                function isValidL_Name(){

                    var pattern = /^[a-z A-Z ]+$/;
                    var L_Name = $("#First_Name").val();
                    if(pattern.test(L_Name) && L_Name !== ""){
                        $("#L_Name").removeClass("is-invalid").addClass("is-valid");
                        $("#L_Name-error").css({
                        "color": "green",
                        "font-size": "14px",
                        "display": "none"
                    });
                    return true;
                }else if(L_Name === ""){
                    $("#L_Name").removeClass("is-valid").addClass("is-valid");
                    $("#L_Name-error").html("Required Last Name");
                    $("#L_Name-error").css({
                        "color": "red",
                        "font-size": "14px",
                    });
                }else{
                    $("#L_Name").removeClass("is-invalid").addClass("is-invalid");
                    $("#L_Name-error").html("Please Input Character Only");
                    $("#L_Name-error").css({
                    "color": "red",
                    "font-size": "14px",
                    "display": "block"
                    });
                };
            }
    
            function isValidEmail(){

                var pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
                var Email = $("#Email").val();
                if(pattern.test(Email) && Email !== ""){
                    $("#Email").removeClass("isValid").addClass("isValid");
                    $("email-error").css({
                    "color": "green",
                    "font-size": "14px",
                    "display": "none"
                });
                return true;
                
            }else if(Email === ""){
                $("#Email").removeClass("is-valid").addClass("is-valid");
                $("Email-error").html("Required Full Email Address");
                    $("Email-error").css({
                        "color": "red",
                        "font-size": "14px",
                    });
            }else{
                $("#Email").removeClass("is-invalid").addClass("is-invalid");
                $("#Email-error").html("Please Input Unique Email Address");
                    $("#Email").css({
                    "color": "red",
                    "font-size": "14px",
                    "display": "block"
                });
            };
        }
    
        function isValidPassword(){

            var pattern = /^[A-Za-z0-9'\.\s\,# ]+$/;
            var Password = $("#Password").val();
            if(pattern.test(Password) && Password !== ""){
                $("#Password").removeClass("isValid").addClass("isValid");
                $("Pass-error").css({
                "color": "green",
                "font-size": "14px",
                "display": "none"
            });
            return true;
            
        }else if(Password === ""){
            $("#Password").removeClass("is-valid").addClass("is-valid");
            $("Pass-error").html("Required Password");
                $("#Pass-error").css({
                    "color": "red",
                    "font-size": "14px",
                });
        }else{
            $("#Password").removeClass("is-invalid").addClass("is-invalid");
            $("#Pass-error").html("Please Input Character/Number/Special/Character..");
                $("#Pass-error").css({
                "color": "red",
                "font-size": "14px",
                "display": "block"
            });
        };
    }

    isValidF_Name();
    isValidM_Name();
    isValidL_Name();
    isValidEmail();
    isValidPassword();


    
if(isValidF_Name()  === true &&  isValidM_Name() === true && isValidL_Name() === true && isValidEmail() === true && isValidPassword() === true){
    $.ajax({
        url: "config/registration.php",
        type: "POST",
        data: data1,
        processData: false,
        contentType: false,
        async: false,
        cache: false,
        success: function(res){
            console.log("Success:",res);
            $("#msg").html(res); 
        },
        error: function(res){
          console.log("Failed");
        }

            });
        }
    });    

$("#msg").submit(function (e) {
    if (!isValidF_Name() || !isValidM_Name() || !isValidL_Name() || !isValidEmail()) {
        e.preventDefault();
    }
});
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>