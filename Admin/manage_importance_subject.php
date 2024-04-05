<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit.fontawesome.com/58d7e3d562.js" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-o3udGtnzP1lFwss/FN2JSqFqAdzt4wvVWWyTIq5zvbZ4Sg8J5ajheDz2sYoqksxj" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "../Connent/connent.php"; ?>

    <!-- ตำแหน่งที่ต้องการแสดงข้อมูล -->
    <div class="col-md-9" id="contentContainer">
        <!-- แสดงข้อความต้อนรับ -->
        <h2 class="text-primary" id="welcomeMessage">จัดการความสำคัญของรายวิชาเเต่ละสาขา</h2>

        <!-- ฟอร์มค้นหา -->
        <form>
            <div class="mb-3">
                <label for="branchSelect" class="form-label">เลือกแผนก:</label>
                <select class="form-select" id="branchSelect" name="branch_Id">
                    <option value="" selected disabled>Select Branch</option>
                    <?php
                    // ดึงข้อมูลแผนกจากฐานข้อมูล
                    $branchQuery = "SELECT * FROM branches";
                    $branchResult = $connect->query($branchQuery);

                    if ($branchResult->num_rows > 0) {
                        while ($branchRow = $branchResult->fetch_assoc()) {
                            echo "<option value='{$branchRow['branch_Id']}'>{$branchRow['branch_Name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </form>

        <!-- ตารางแสดงข้อมูล -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ชื่อสาขา</th>
                    <th scope="col">ชื่อรายวิชา</th>
                    <th scope="col">ระดับชั้น</th>
                    <th scope="col">ความสำคัญ</th>
                    <th scope="col">จัดการข้อมูล</th>
                </tr>
            </thead>
            <tbody id="searchResults">
                <?php
                // ดึงข้อมูลจากฐานข้อมูล
                $sql = "SELECT * FROM branches_subjects bs 
                        JOIN branches b ON bs.branch_Id = b.branch_Id 
                        JOIN subjects s ON bs.subject_Id = s.subject_Id
                        JOIN study_level sl ON bs.study_level_Id = sl.study_level_Id";

                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['branch_Name']}</td>
                                <td>{$row['subject_Name']}</td>
                                <td>{$row['study_level_Name']}</td>
                                <td>{$row['subject_Multiplier']}</td>
                                <td>
                                    <div class='btn-group' role='group'>
                                        <a href='edit_branch.php?branch_Id={$row['branch_Id']}' class='btn btn-warning mx-1'>Edit</a>
                                        <a href='process_delete_branch.php?branch_Id={$row['branch_Id']}' class='btn btn-danger' onclick='return confirm(\"คุณต้องการลบข้อมูลหรือไม่?\")'>Delete</a>
                                    </div>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
    $(document).ready(function() {
        // เมื่อเปลี่ยนค่าใน Select Box แผนก
        $("#branchSelect").on("change", function() {
            var selectedBranch = $(this).val();

            // ดึงข้อมูลระดับชั้นที่เกี่ยวข้องกับแผนกที่ถูกเลือก
            $.ajax({
                url: "search_data.php",
                method: "POST",
                data: {
                    branchId: selectedBranch
                },
                success: function(data) {
                    $("#studyLevelSelect").html(data);
                }
            });
        });
    });
</script>
</body>

</html>