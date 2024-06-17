<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $employeeId = intval($_GET['id']);  // Ensure it's an integer
    $sql = "SELECT e.employee_id, e.fullname AS employee_name, d.department_name, e.job_title 
            FROM employee e 
            JOIN department d ON e.department_id = d.department_id 
            WHERE e.employee_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $employeeId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($data = mysqli_fetch_assoc($result)) {
            echo "<center><h4> {$data['employee_name']}</h4></center>";
            echo "<input type='hidden' name='employee_id' value = $data[employee_id]>";
            echo "<center><p> {$data['department_name']}</p></center>";
            echo "<center><p><strong>Position:</strong> {$data['job_title']}</p></center>";
        } else {
            echo 'No data found.';
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'Query error.';
    }
} else {
    echo 'Invalid request.';
}

$conn->close();
?>