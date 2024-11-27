<?php
define('TITLE', 'Change Password');
define('PAGE', 'Requesterchangepass');
include('includes/header.php');
include('../dbConnection.php');
session_start();

if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php'; </script>";
}

if (isset($_REQUEST['passupdate'])) {
    if ($_REQUEST['rPassword'] == "") {
        $passmsg = '<div class="alert alert-warning mt-3" role="alert">Please fill all fields!</div>';
    } else {
        $sql = "SELECT * FROM requesterlogin_tb WHERE r_email='$rEmail'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $rPass = $_REQUEST['rPassword'];
            $sql = "UPDATE requesterlogin_tb SET r_password = '$rPass' WHERE r_email = '$rEmail'";
            if ($conn->query($sql) == TRUE) {
                $passmsg = '<div class="alert alert-success mt-3" role="alert">Password Updated Successfully!</div>';
            } else {
                $passmsg = '<div class="alert alert-danger mt-3" role="alert">Unable to Update Password!</div>';
            }
        }
    }
}
?>

<!-- Styling for the page -->
<style>
    body {
        background: #e3f2fd; /* Light blue background */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .form-container {
        background: #ffffff; /* White background for the main form */
        padding: 50px; /* Increased padding */
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); /* Light shadow for outer box */
        max-width: 600px; /* Increased width */
        margin: 100px auto; /* Centered and more space from top */
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #f4f6fc; /* Light purple background inside the form */
        border: 2px solid #e0e0e0; /* Light border around the form */
    }

    .form-container:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Darker shadow on hover */
    }

    .form-header {
        background: linear-gradient(90deg, #ff7eb3, #6c63ff); /* Pink to Blue gradient */
        color: #ffffff;
        padding: 20px;
        border-radius: 15px 15px 0 0;
        font-size: 1.8rem; /* Increased font size */
        font-weight: bold;
        text-align: center;
    }

    .form-group label {
        font-weight: bold;
        color: #4a4a4a;
    }

    .form-control {
        background-color: #e7eaff; /* Light blue background inside input fields */
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px; /* Increased padding */
        margin-top: 10px;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .form-control:focus {
        background-color: #ffffff; /* White background on focus */
        border-color: #6c63ff; /* Matches gradient */
        box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
    }

    .btn-update {
    background: linear-gradient(90deg, #add8e6, #87cefa); /* Light blue gradient background */
    color: #ffffff;
    border: none;
    border-radius: 10px;
    padding: 12px 25px;
    margin-top: 25px;
    font-size: 1.2rem; /* Larger font for button */
    transition: background 0.3s, box-shadow 0.3s, transform 0.2s ease;
}


.btn-update:hover {
    background: linear-gradient(90deg, #4169e1, #1e90ff); /* Slightly darker blue gradient on hover */
    box-shadow: 0 4px 15px rgba(65, 105, 225, 0.5); /* Adjusted to match the slightly darker blue */
    transform: scale(1.05); /* Slightly increase the button size */
}

    .alert {
        margin-top: 20px;
        border-radius: 10px;
    }

    .btn-update:active {
        transform: scale(1.02); /* Slight scale effect when the button is clicked */
    }
</style>

<!-- Form Design -->
<div class="form-container">
    <div class="form-header">Change Your Password</div>
    <form method="POST">
        <div class="form-group mt-4">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" value="<?php echo $rEmail; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="inputnewpassword">New Password</label>
            <input type="password" class="form-control" id="inputnewpassword" placeholder="Enter new password" name="rPassword">
        </div>
        <button type="submit" class="btn btn-update" name="passupdate">Update</button>
        <?php if (isset($passmsg)) { echo $passmsg; } ?>
    </form>
</div>

<?php
include('includes/footer.php'); 
?>
