<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input data
    $subjectVCname = $_POST['subjectVC_name'];
    
    // Function to remove non-Thai characters and spaces
    function removeSpecialCharactersAndSpaces($str) {
        // Remove any character that is not a Thai character or number
        // and remove all spaces
        return preg_replace('/[^\p{Thai}\p{N}]/u', '', $str);
    }

    // Remove special characters and spaces
    $cleanedSubjectVCname = removeSpecialCharactersAndSpaces($subjectVCname);

    // Sanitize input data
    $cleanedSubjectVCname = mysqli_real_escape_string($connect, $cleanedSubjectVCname);

    // Check if the data already exists
    $checkQuery = "SELECT * FROM subjectvc WHERE subjectVC_name = '$cleanedSubjectVCname'";
    $result = $connect->query($checkQuery);

    if ($result->num_rows > 0) {
        // Data already exists
        $message = "ข้อมูลนี้มีอยู่แล้วในฐานข้อมูล";
        echo "<script>alert('$message'); window.location.href='../Manage/manage_subjectvc.php';</script>";
    } else {
        // Get the latest subjectVC_id
        $latestIdQuery = "SELECT MAX(subjectVC_id) AS max_id FROM subjectvc";
        $latestIdResult = $connect->query($latestIdQuery);
        $latestIdRow = $latestIdResult->fetch_assoc();
        $newId = $latestIdRow['max_id'] + 1;

        // Attempt to insert data
        $sql = "INSERT INTO subjectvc (subjectVC_name, subjectVC_id) VALUES ('$cleanedSubjectVCname', '$newId')";

        if ($connect->query($sql) === TRUE) {
            // Success message and redirect
            $message = "เพิ่มข้อมูลสำเร็จแล้ว";
            echo "<script>alert('$message'); window.location.href='../Manage/manage_subjectvc.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}

// Close the database connection
$connect->close();
?>
