<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Registration</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/pics/logo.png" />
    <style>
        body {
            background: linear-gradient(to right, #4ad489, #3d68b2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
        }
        .form-container {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            z-index: 2;
        }
        .btn-cancel {
            background-color: #d3d3d3;
            border: none;
        }
        .success-message {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4caf50;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: none;
        z-index: 1000;
        }
    </style>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<body>
    <div class="overlay"></div>
    <div class="form-container">
        <h4 class="text-center mb-4">Resident Registration</h4>
        <form id="msg" action="registration.php" method="POST">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" id="Email" name="Email" class="form-control" placeholder="Enter email" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" id="Password" name="Password" class="form-control" placeholder="Enter password" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="PasswordConfirm" class="form-label">Confirm Password</label>
                    <input type="password" id="PasswordConfirm" name="PasswordConfirm" class="form-control" placeholder="Confirm password" required>
                </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="F_Name" class="form-label">First Name</label>
                    <input type="text" id="F_Name" name="F_Name" class="form-control" placeholder="Enter first name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="M_Name" class="form-label">Middle Name</label>
                    <input type="text" id="M_Name" name="M_Name" class="form-control" placeholder="Enter middle name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="L_Name" class="form-label">Last Name</label>
                    <input type="text" id="L_Name" name="L_Name" class="form-control" placeholder="Enter last name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="BirthDate" class="form-label">Birthdate</label>
                    <input type="date" id="Birthdate" name="BirthDate" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="Civil_Status" class="form-label">Civil Status</label>
                    <select id="Civil_Status" name="Civil_Status" class="form-control" required>
                        <option value="" disabled selected>Choose your civil status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="widowed">Widowed</option>
                        <option value="divorced">Divorced</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="Nationality" class="form-label">Nationality</label>
                    <input type="text" id="Nationality" name="Nationality" class="form-control" placeholder="Enter nationality" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="Block" class="form-label">Block</label>
                    <input type="text" id="Block" name="Block" class="form-control" placeholder="Enter block number">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="Lot" class="form-label">Lot</label>
                    <input type="text" id="Lot" name="Lot" class="form-control" placeholder="Enter lot number">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="Street" class="form-label">Street</label>
                    <input type="text" id="Street" name="Street" class="form-control" placeholder="Enter street">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="Subdivision" class="form-label">Subdivision</label>
                    <input type="text" id="Subdivision" name="Subdivision" class="form-control" placeholder="Enter subdivision">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="Barangay" class="form-label">Barangay</label>
                    <input type="text" id="Barangay" name="Barangay" class="form-control" placeholder="Enter barangay">
                </div>
                <div class="col-md-3 mb-3">
                    <label For="City" class="form-label">City</label>
                    <input type="text" id="City" name="City" class="form-control" placeholder="Enter city">
                </div>
                <div class="col-md-6 mb-3">
                    <label For="Contact_No" class="form-label">Phone Number</label>
                    <input type="tel" id="Contact_No" name="Contact_No" class="form-control" placeholder="Enter phone number" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Gender" class="form-label">Gender</label><br>
                    <input id="Gender" type="radio" name="gender" value="male"> Male
                    <input id="Gender" type="radio" name="gender" value="female"> Female
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="Is_pwd" class="form-label">Are you a person with disability?</label><br>
                    <input id="Is_pwd" type="checkbox" name="pwd" value="yes"> Yes
                    <input id="Is_pwd" type="checkbox" name="pwd" value="no"> No
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="Index.php"> <button class="btn btn-primary px-4" type="button">Cancel</button></a>
                <button type="submit" class="btn btn-primary px-4">Register</button>
            </div>
        </form>
        <div id="msg" a href></div>
    </div>
</script>
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
    
                    $("#msg").submit(function (e) {
            e.preventDefault(); // Prevent traditional submission
            if (!isValidF_Name() || !isValidM_Name() || !isValidL_Name() || !isValidEmail() || !isValidPassword()) {
                return;
            }
            var data1 = new FormData(this);
            $.ajax({
                url: "registration.php",
                type: "POST",
                data: data1,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log("Success:", res);
                    $("#msg").html(res);
                },
                error: function(res) {
                    console.log("Failed");
                }
            });
        });
        });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    
    <div id="successMessage" class="registration-success" style="display: none;">Registration Complete!</div>
</body>
</html>