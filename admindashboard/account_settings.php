<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Account Management Settings </title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }

    .navbar-container {
      background-color: #f9f9f9;
      padding: 5px;
      border: none;
      width: 100%;
      margin: 0 auto;
    }

    .navbar {
      background-color: #333;
      overflow: hidden;
      display: flex;
      border-radius: 5px;
      justify-content: space-around;
    }

    .navbar a {
      display: block;
      color: white;
      text-align: center;
      padding: 7px 20px;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

    .navbar a:active {
      transform: scale(0.98);
      background-color: #555;
    }

    .container {
      margin: 20px auto;
      max-width: 1200px;
    }

    .card {
      padding: 20px;
      display: none;
    }

    .card.active {
      display: block;
    }

    .btn-block {
      width: 100%;
    }

    h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    h6 {
      font-size: 9px;
    }

    label {
      font-size: 12px;
    }

    #search-user {
      margin-left: 419px;
      margin-top: 10px;
    }

    #search-email {
      margin-left: 997px;
    }

    .cancel-button {
      position: absolute;
      top: 10px;
      left: 20px;
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
    }

    .cancel-button:hover {
      background-color: #c82333;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
      }
    }

    @media (orientation: landscape) {
      .form-row {
        display: flex;
        justify-content: space-between;
      }

      .form-group {
        flex-basis: 48%;
      }
    }
  </style>
</head>

<body>

  <div class="navbar-container">
    <div class="navbar">
      <a href="#AddAccount" class="add-account active" onclick="showForm('add-user-form')">Add Account</a>
      <a href="#ModifyAccount" class="modify-account" onclick="showForm('modify-user-form')">Modify Account</a>
      <a href="#DeleteAccount" class="delete-account" onclick="showForm('delete-account-form')">Delete Account</a>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" id="add-user-form">
                <div class="card-header text-center">
                    <h3>Add New Account</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="select-account-type">Account Type</label>
                                    <select class="form-control" id="select-account-type" required>
                                        <option value="" disabled selected>Select account type</option>
                                        <option value="secretary">Secretary</option>
                                        <option value="bhw">BHW</option>
                                        <option value="resident">Resident</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" class="form-control" id="first-name" placeholder="Enter first name" required>
                                </div>

                                <div class="form-group">
                                    <label for="middle-name">Middle Name</label>
                                    <input type="text" class="form-control" id="middle-name" placeholder="Enter middle name" required>
                                </div>

                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" class="form-control" id="last-name" placeholder="Enter last name" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter password" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">Date of Birth*</label>
                                    <input type="date" class="form-control" id="dob" required>
                                </div>

                                <div class="form-group">
                                    <label for="Civil-status">Civil Status</label>
                                    <select class="form-control" id="Civil-status" required>
                                        <option value="" disabled selected>Select Civil Status</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="widow">Widow</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Nationality">Nationality</label>
                                    <input type="text" class="form-control" id="Nationality" placeholder="Enter Nationality" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Is-pwd">Is PWD</label>
                                        <select id="Is-pwd" class="form-control" required>
                                            <option value="" disabled selected>Select</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="Is-pregnant">Is Pregnant</label>
                                        <select id="Is-pregnant" class="form-control" required>
                                            <option value="" disabled selected>Select</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contact-number">Contact Number</label>
                                    <input type="text" class="form-control" id="contact-number" placeholder="Enter contact number" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm-password" placeholder="Confirm password" required>
                                </div>
                            </div>
                        </div>

                        <h5>Address</h5>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="block-no">Block No.</label>
                                <input type="text" class="form-control" id="block-no" placeholder="Enter Block no." required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lot">Lot</label>
                                <input type="text" class="form-control" id="lot" placeholder="Enter lot" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="street">Street</label>
                                <input type="text" class="form-control" id="street" placeholder="Enter street" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="subdivision">Subdivision</label>
                                <input type="text" class="form-control" id="subdivision" placeholder="Enter subdivision" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" id="modify-user-form">
          <div class="card-header text-center">
            <h3>Modify User Account</h3>
          </div>
          <div class="card-body">
            <form>
              <div class="form-row">
                <div class="form-group">
                  <label for="select-account-type">Select Account Type</label>
                  <select class="form-control" id="select-account-type" required>
                    <option value="" disabled selected>Select an Account Type to Modify</option>
                    <option value="secretary">Secretary</option>
                    <option value="bhw">Barangay Health Worker</option>
                    <option value="resident">Resident</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="first-name">First Name</label>
                  <input type="text" class="form-control" id="first-name" placeholder="Enter first name" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="middle-name">Middle Name</label>
                  <input type="text" class="form-control" id="middle-name" placeholder="Enter middle name" required>
                  <button type="button" id="search-user">Search user</button>
                </div>

                <div class="form-group">
                  <label for="last-name">Last Name</label>
                  <input type="text" class="form-control" id="last-name" placeholder="Enter last name" required>
                </div>
              </div>

              <div class="form-group">
                <h5>Address</h5>
                  <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="block-no">Block No.</label>
                          <input type="text" class="form-control" id="block-no" placeholder="Enter Block no." required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="lot">Lot</label>
                          <input type="text" class="form-control" id="lot" placeholder="Enter lot" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="street">Street</label>
                          <input type="text" class="form-control" id="street" placeholder="Enter street" required>
                        </div>
                      </div>

                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="subdivision">Subdivision</label>
                  <input type="text" class="form-control" id="subdivision" placeholder="Enter subdivision" required>
                </div>

                  <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label for="contact-number">Contact Number</label>
                    <input type="tel" class="form-control" id="contact-number" placeholder="Enter contact number" required>
                  </div>
                  <div class="form-group">
                    <label for="civil-status">Civil Status</label>
                    <input type="text" class="form-control" id="civil-status" placeholder="Enter civil status" required>
                  </div>
                  <div class="form-group">
                    <label for="is-pwd">Is PWD</label>
                    <select class="form-control" id="is-pwd" required>
                      <option value="" disabled selected>Select an option</option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Modify User</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" id="delete-account-form">
          <div class="card-header text-center">
            <h3>Delete User Account</h3>
          </div>
          <div class="card-body">
            <form>
              <div class="form-row">
                <div class="form-group">
                  <label for="select-account-type">Select Account Type</label>
                  <select class="form-control" id="select-account-type" required>
                    <option value="" disabled selected>Select an account type to delete</option>
                    <option value="secretary">Secretary</option>
                    <option value="bhw">Barangay Health Worker</option>
                    <option value="resident">Resident</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="select-user">Search Email</label>
                  <select class="form-control" id="select-user" required>
                    <option value="" disabled selected>Select an email to delete</option>
                    <option value="user1">Email 1</option>
                    <option value="user2">Email 2</option>
                    <option value="user3">Email 3</option>
                  </select>
                </div>
              </div>
              <button type="button" id="search-email">Search</button>
              <div class="form-group">
                <label for="reason">Reason for Deletion</label>
                <textarea class="form-control" id="reason" rows="3" placeholder="Enter reason for deletion" required></textarea>
              </div>
              <button type="submit" class="btn btn-danger btn-block">Delete User Account</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function showForm(formId) {
      const forms = document.querySelectorAll('.card');
      forms.forEach(form => form.classList.remove('active'));

      document.getElementById(formId).classList.add('active');
    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
