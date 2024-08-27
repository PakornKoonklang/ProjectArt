<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input data
    $subjectVCCname = $_POST['subjectVCC_name'];
    
    // Function to remove non-Thai characters and spaces
    function removeSpecialCharactersAndSpaces($str) {
        // Remove any character that is not a Thai character or number
        // and remove all spaces
        return preg_replace('/[^\p{Thai}\p{N}]/u', '', $str);
    }

    // Remove special characters and spaces
    $cleanedSubjectVCCname = removeSpecialCharactersAndSpaces($subjectVCCname);

    // Sanitize input data
    $cleanedSubjectVCCname = mysqli_real_escape_string($connect, $cleanedSubjectVCCname);

    // Check if the data already exists
    $checkQuery = "SELECT * FROM subjectvcc WHERE subjectVCC_name = '$cleanedSubjectVCCname'";
    $result = $connect->query($checkQuery);

    if ($result->num_rows > 0) {
        // Data already exists
        $message = "ข้อมูลนี้มีอยู่แล้วในฐานข้อมูล";
        echo "<script>alert('$message'); window.location.href='../Manage/manage_subjectvcc.php';</script>";
    } else {
        // Get the latest subjectVCC_id
        $latestIdQuery = "SELECT MAX(subjectVCC_id) AS max_id FROM subjectvcc";
        $latestIdResult = $connect->query($latestIdQuery);
        $latestIdRow = $latestIdResult->fetch_assoc();
        $newId = $latestIdRow['max_id'] + 1;

        // Attempt to insert data
        $sql = "INSERT INTO subjectvcc (subjectVCC_name, subjectVCC_id) VALUES ('$cleanedSubjectVCCname', '$newId')";

        if ($connect->query($sql) === TRUE) {
            // Success message and redirect
            $message = "เพิ่มข้อมูลสำเร็จแล้ว";
            echo "<script>alert('$message'); window.location.href='../Manage/manage_subjectvcc.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}

// Close the database connection
$connect->close();
?>
