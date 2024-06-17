<?php
include 'connect.php';

if (isset($_POST['addfeedback'])) {
    $employee_id = $_POST['id'];
    $score = $_POST['score'];

    // Update the employee table to link the feedback
    $updateEmployee = $conn->query("UPDATE employee SET feedback_id = $score WHERE employee_id = $employee_id");
    if ($updateEmployee) {
        echo "<script>alert('Feedback added successfully!');  
        window.location.href = 'feedback.php';
        </script>";
    } else {
        echo "Error updating employee: " . mysqli_error($conn);
    }

    $conn->close();
}
