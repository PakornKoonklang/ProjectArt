<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบและกำหนดค่าตัวแปร
    $adminId = isset($_POST['adminid']) ? $_POST['adminid'] : '';
    $firstname = isset($_POST['admin_Firstname']) ? $_POST['admin_Firstname'] : '';
    $lastname = isset($_POST['admin_Lastname']) ? $_POST['admin_Lastname'] : '';
    $username = isset($_POST['admin_User']) ? $_POST['admin_User'] : '';
    $password = isset($_POST['admin_Pass']) ? $_POST['admin_Pass'] : '';
    $phone = isset($_POST['admin_Phone']) ? $_POST['admin_Phone'] : '';
    $email = isset($_POST['admin_Email']) ? $_POST['admin_Email'] : '';
    $admin_level_id = isset($_POST['admin_level_Id']) ? $_POST['admin_level_Id'] : '';
    // Prepare the SQL statement
    $stmt = $connect->prepare("UPDATE admin SET admin_Firstname=?, admin_Lastname=?, admin_User=?, admin_Pass=?, admin_Phone=?, admin_Email=?, admin_level_Id=? WHERE admin_Id=?");

    // Check if the prepare statement succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssssssii", $firstname, $lastname, $username, $password, $phone, $email, $admin_level_id, $adminId); // Use appropriate types for bind_param

        if ($stmt->execute()) {
            // Redirect to the page after successful update
            header("Location: ../Manage/manage_member.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $connect->error;
    }
}

// Close the database connection
$connect->close();
?>
