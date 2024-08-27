<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = isset($_POST['admin_Firstname']) ? $_POST['admin_Firstname'] : '';
    $lastname = isset($_POST['admin_Lastname']) ? $_POST['admin_Lastname'] : '';
    $username = isset($_POST['admin_User']) ? $_POST['admin_User'] : '';
    $password = isset($_POST['admin_Pass']) ? $_POST['admin_Pass'] : ''; // ควรเข้ารหัสรหัสผ่านที่นี่
    $phone = isset($_POST['admin_Phone']) ? $_POST['admin_Phone'] : '';
    $email = isset($_POST['admin_Email']) ? $_POST['admin_Email'] : '';
    $admin_level_id = isset($_POST['admin_level_Id']) ? $_POST['admin_level_Id'] : '';

    if (!empty($firstname) && !empty($lastname) && !empty($username) && !empty($password) && !empty($phone) && !empty($email) && !empty($admin_level_id)) {
        $result = $connect->query("SELECT MAX(admin_Id) AS max_id FROM admin");
        if ($result) {
            $row = $result->fetch_assoc();
            $max_id = $row['max_id'];
            $new_id = $max_id + 1;

            $sql = "INSERT INTO admin (admin_Id, admin_Firstname, admin_Lastname, admin_User, admin_Pass, admin_Phone, admin_Email, admin_level_Id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $connect->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("issssssi", $new_id, $firstname, $lastname, $username, $password, $phone, $email, $admin_level_id);

                if ($stmt->execute()) {
                    header("Location: ../Manage/manage_member.php");
                    exit();
                } else {
                    echo "Error executing statement: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing statement: " . $connect->error;
            }
        } else {
            echo "Error retrieving current highest ID: " . $connect->error;
        }
    } else {
        echo "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    }
}

$connect->close();
?>
