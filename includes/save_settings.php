<?php 

$info = (Object)[];
$Error = ""; // Initialize $Error variable to store error messages

// Check if DATA_OBJ is defined and set
if (isset($DATA_OBJ)) {
    $data = [];
    $data['userid'] = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';

    // Validate username
    $data['username'] = isset($DATA_OBJ->username) ? $DATA_OBJ->username : '';
    if (empty($DATA_OBJ->username)) {
        $Error .= "Please enter a valid username. <br>";
    } else {
        if (strlen($DATA_OBJ->username) < 3) {
            $Error .= "Username must be at least 3 characters long. <br>";
        }
        if (!preg_match("/^[a-zA-Z]*$/", $DATA_OBJ->username)) {
            $Error .= "Please enter a valid username. <br>";
        }
    }

    // Validate email
    $data['email'] = isset($DATA_OBJ->email) ? $DATA_OBJ->email : '';
    if (empty($DATA_OBJ->email)) {
        $Error .= "Please enter a valid email. <br>";
    } else {
        if (!filter_var($DATA_OBJ->email, FILTER_VALIDATE_EMAIL)) {
            $Error .= "Please enter a valid email. <br>";
        }
    }

    // Validate gender
    $data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
    if (empty($DATA_OBJ->gender)) {
        $Error .= "Please select a gender. <br>";
    } else {
        if ($DATA_OBJ->gender != "Male" && $DATA_OBJ->gender != "Female") {
            $Error .= "Please select a valid gender. <br>";
        }
    }

    // Validate password
    $data['password'] = isset($DATA_OBJ->password) ? $DATA_OBJ->password : '';
    $password2 = isset($DATA_OBJ->password2) ? $DATA_OBJ->password2 : '';

    if (empty($DATA_OBJ->password)) {
        $Error .= "Please enter a valid password. <br>";
    } else {
        if ($DATA_OBJ->password != $DATA_OBJ->password2) {
            $Error .= "Passwords must match. <br>";
        }
        if (strlen($DATA_OBJ->password) < 8) {
            $Error .= "Password must be at least 8 characters long. <br>";
        }
    }

    // Check if there are no errors
    if ($Error == "") {
        // Correct the SQL query syntax
        $query = "UPDATE users SET username = :username, email = :email, gender = :gender, password = :password WHERE userid = :userid LIMIT 1";
        
        // Ensure $DB object and write method are defined
        if (isset($DB) && method_exists($DB, 'write')) {
            $result = $DB->write($query, $data);
            if ($result) {
                $info->message = "Your data was saved.";
                $info->data_type = "save_settings";
                echo json_encode($info);
            } else {
                $info->message = "Your profile was NOT saved due to an error.";
                $info->data_type = "save_settings";
                echo json_encode($info);
            }
        } else {
            $info->message = "Database connection error.";
            $info->data_type = "save_settings";
            echo json_encode($info);
        }
    } else {
        $info->message = $Error;
        $info->data_type = "save_settings";
        echo json_encode($info);
    }
} else {
    $info->message = "Invalid input data.";
    $info->data_type = "save_settings";
    echo json_encode($info);
}
?>
