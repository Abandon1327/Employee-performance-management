<?php
include 'connect.php';

if (isset($_POST['update'])) {
    $employee_id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $department = $_POST['department'];
    $position = $_POST['position'];

    if ($department && $position) {
        // Fetch the department_id based on the department name
        $depQuery = "SELECT department_id FROM department WHERE department_name = '$department'";
        $depResult = mysqli_query($conn, $depQuery);

        if ($depResult && mysqli_num_rows($depResult) > 0) {
            $depRow = mysqli_fetch_assoc($depResult);
            $depId = $depRow['department_id'];

            // Update the employee data with the retrieved department_id
            $sql = "UPDATE employee SET fullname = '$fullname', job_title = '$position', department_id = '$depId' WHERE employee_id = $employee_id";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Updated Successfully!');  
                window.location.href = 'feedback.php';
                </script>";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Error: Department not found.";
        }
    } else {
        echo "Error: All fields are required.";
    }

    $conn->close();
}
?>