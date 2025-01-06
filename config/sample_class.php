<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'connection.php';

class sample_class {
    private $conn;
    private $server = 'localhost';
    private $user   = 'root';
    private $hashpass   = '';
    private $db     = 'records_management_system_db';
    private $pdo;

    public function __construct() {
        
        $this->conn = new mysqli($this->server, $this->user, $this->hashpass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->db_connect();
    }

    public function getLastError() {
        return $this->conn->error;
    }
    public function db_connect()
    {
        $this->pdo = null;
        try {
            $this->pdo = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db, $this->user, $this->hashpass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    public function add_user($email, $password, $fname, $mname, $lname, $BirthDate, $contactno, $gender, $civilstatus, $nationality, $ispwd, $ispregnant, $subdivision, $streetname, $block, $lot, $role) 
    {
        $query = "INSERT INTO users (Email, Password, F_Name, M_Name, L_Name, BirthDate, Contact_No, Gender, Civil_Status, Nationality, Is_pwd, Is_pregnant, Subdivision, Street_Name, Block, Lot, Role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $this->conn->prepare($query);
    
        if ($stmt) {
            $stmt->bind_param('sssssssssssssssss', $email, $password, $fname, $mname, $lname, $BirthDate, $contactno, $gender, $civilstatus, $nationality, $ispwd, $ispregnant, $subdivision, $streetname, $block, $lot, $role);
            
            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Database error: " . $this->conn->error);
                return false;
            }
        } else {
            error_log("Failed to prepare SQL statement: " . $this->conn->error);
            return false;
        }
    }
    public function login_users($Email, $Password) 
    {
        $stmt = $this->pdo->prepare("SELECT ID_No, Email, Password, Role FROM users WHERE Email = ?");
        $stmt->execute([$Email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row && password_verify($Password, $row['Password'])) {
            $_SESSION['ID_No'] = htmlentities($row['ID_No']);
            $_SESSION['logged_in'] = true;
    
            switch ($row['Role']) {
                case 'unverified':
                    header("Location: ./residentdashboard/residentdashboard.php");
                    break;
                case 'verified':
                    header("Location: ./residentdashboard/residentdashboard.php");
                    break;
                case 'admin':
                    header("Location: ./admindashboard/admindashboard.php");
                    break;
                case 'secretary':
                    header("Location: ./admindashboard/admindashboard.php");
                    break;
                case 'bhw':
                    header("Location: ./admindashboard/admindashboard.php");
                    break;
                default:
                    echo "Unknown role type";
                    break;
            }
            exit();
        } else {
            echo "<script>alert('Invalid email or password');</script>";
        }
    }

    public function add_requestRecord($RF_Name, $RM_Name, $RL_Name, $Request_Type, $Request_Reason) 
    {
        $R_Date = date("Y-m-d");
        $Status = "Processing";
    
        $stmt = $this->pdo->prepare("INSERT INTO request_records (`RF_Name`, `RM_Name`, `RL_Name`, `Request_Type`, `Request_Reason`, `R_Date`, `Status`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
     
        if ($stmt->execute([$RF_Name, $RM_Name, $RL_Name, $Request_Type, $Request_Reason, $R_Date, $Status])) {
            return true;
        } else {
            error_log("SQL Error: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }
    
    public function add_complaint($CF_Name, $CM_Name, $CL_Name, $Email, $C_Description)
    {
        $C_Date = date("Y-m-d"); 
        $C_Status = "Filed"; 

        $stmt = $this->pdo->prepare("INSERT INTO complaints (`CF_Name`, `CM_Name`, `CL_Name`, `Email`, `C_Description`, `C_Date`, `C_Status`)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$CF_Name, $CM_Name, $CL_Name, $Email, $C_Description, $C_Date, $C_Status])) {
            return true;
        } else {
            error_log("SQL Error: " . implode(", ", $stmt->errorInfo()));
            return false;
        }
    }

    public function add_blotter($BF_Name, $BM_Name, $BL_Name, $B_Email, $B_Type, $B_Description)
    {
        $B_Date = date("Y-m-d");
        $B_Status = "Filed";
    
        $stmt = $this->pdo->prepare("INSERT INTO blotters (BF_Name, BM_Name, BL_Name, B_Email, B_Type, B_Description, B_Date, B_Status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$BF_Name, $BM_Name, $BL_Name, $B_Email, $B_Type, $B_Description, $B_Date, $B_Status])) {
            return true;
        } else {
            error_log("SQL Error: " . implode(", ", $stmt->errorInfo()));
        }
    
    }
    
    public function confirmDeletionC($C_ID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `complaints` WHERE `C_ID` = ?");
        $sql = $stmt->execute([$C_ID]);

        return $sql == true;
    }

    public function confirmDeletionB($B_ID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `blotters` WHERE `B_ID` = ?");
        $sql = $stmt->execute([$B_ID]);

        return $sql == true;
    }

    public function delete_requestRecord($R_ID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM `request_records` WHERE `R_ID` = ?");
        $sql = $stmt->execute([$R_ID]);

        return $sql == true;
    }

    public function fetchUser($ID_No) 
    {
        $query = "SELECT ID_No, F_Name, M_Name, L_Name, Email, Contact_No, `Role` FROM users WHERE ID_No = :ID_No";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':ID_No', $ID_No);
    
        if ($stmt->execute()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                echo "No user found with ID_No: " . htmlentities($ID_No);
            }
            return $user;
        } else {
            echo "Error executing query for ID_No: " . htmlentities($ID_No);
        }
    
        return false;
    }
    
    public function verify_user($user_id) 
    {
        $query = "UPDATE users SET role = 'verified' WHERE id = :user_id";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function edit_my_account($user_id, $F_Name, $M_Name, $L_Name, $Email, $Contact_No) {
        $query = "UPDATE users SET ";
        $fields = [];
        $params = [];
    
        if (!empty($F_Name)) {
            $fields[] = "F_Name = :F_Name";
            $params[':F_Name'] = $F_Name;
        }
        if (!empty($M_Name)) {
            $fields[] = "M_Name = :M_Name";
            $params[':M_Name'] = $M_Name;
        }
        if (!empty($L_Name)) {
            $fields[] = "L_Name = :L_Name";
            $params[':L_Name'] = $L_Name;
        }
        if (!empty($Email)) {
            $fields[] = "Email = :Email";
            $params[':Email'] = $Email;
        }
        if (!empty($Contact_No)) {
            $fields[] = "Contact_No = :Contact_No";
            $params[':Contact_No'] = $Contact_No;
        }
    
        if (!empty($fields)) {
            $query .= implode(', ', $fields);
            $query .= " WHERE ID_No = :user_id";
            $params[':user_id'] = $user_id;
    
            $stmt = $this->pdo->prepare($query);
    
            error_log("Query: " . $query);
            error_log("Params: " . print_r($params, true));
    
            return $stmt->execute($params);
        } else {
            return false;
        }
    }
    
}
?>
