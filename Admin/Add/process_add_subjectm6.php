<?php
include "../../Connent/connent.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input data
    $subjectM6name = $_POST['subjectM6_name'];
    
    // Function to remove non-Thai characters and spaces
    function removeSpecialCharactersAndSpaces($str) {
        // Remove any character that is not a Thai character or number
        // and remove all spaces
        return preg_replace('/[^\p{Thai}\p{N}]/u', '', $str);
    }

    // Remove special characters and spaces
    $cleanedSubjectM6name = removeSpecialCharactersAndSpaces($subjectM6name);

    // Validate and sanitize input data
    $cleanedSubjectM6name = mysqli_real_escape_string($connect, $cleanedSubjectM6name);

    // Check if the data already exists
    $checkQuery = "SELECT * FROM subjectm6 WHERE subjectM6_name = '$cleanedSubjectM6name'";
    $result = $connect->query($checkQuery);

    if ($result->num_rows > 0) {
        // Data already exists
        $message = "ข้อมูลนี้มีอยู่แล้วในฐานข้อมูล";
        echo "<script>alert('$message'); window.location.href='../Manage/manage_subjectm6.php';</script>";
    } else {
        // Get the latest subjectM6_id
        $latestIdQuery = "SELECT MAX(subjectM6_id) AS max_id FROM subjectm6";
        $latestIdResult = $connect->query($latestIdQuery);
        $latestIdRow = $latestIdResult->fetch_assoc();
        $newId = $latestIdRow['max_id'] + 1;

        // Insert data into the database
        $sql = "INSERT INTO subjectm6 (subjectM6_name, subjectM6_id) VALUES ('$cleanedSubjectM6name', '$newId')";

        if ($connect->query($sql) === TRUE) {
            // Success message and redirect
            $message = "เพิ่มข้อมูลสำเร็จแล้ว";
            echo "<script>alert('$message'); window.location.href='../Manage/manage_subjectm6.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}

// Close the database connection
$connect->close();
?>
