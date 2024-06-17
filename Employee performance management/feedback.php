<?php
include 'connect.php';

$sql = "SELECT * FROM employees_without_feedback ";

$query = mysqli_query($conn, $sql);

// Check for query execution errors
if (!$query) {
    die('Error: ' . mysqli_error($conn));
}

$row = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <!-- icon -->
    <link rel="icon" href="image/LOGO.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- bootstrap-icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- datatables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hidethis {
            display: none;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="main">
            <?php include 'navbar.php'; ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3>Feedback</h3>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                No Feedback Table
                            </h5>
                            <!-- Button add trigger modal -->
                            <br>
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal1">
                                <i class="bi bi-person-fill-add"></i> Add
                            </button>
                            <!-- Modal Add -->
                            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput"
                                                        name="fname" placeholder="juan" required>
                                                    <label for="floatingInput">Fullname</label>
                                                </div>
                                                <div class="form-floating form-group mb-3 ">
                                                    <select name="department" class="form-select"
                                                        aria-label="Default select example" required>
                                                        <option disabled selected>Department</option>
                                                        <option name="department" value="IT">IT</option>
                                                        <option name="department" value="Finance">Finance</option>
                                                        <option name="department" value="Sales">Sales</option>
                                                        <option name="department" value="HR and Admin">HR and Admin
                                                        </option>
                                                        <option name="department" value="Operation">Operation</option>
                                                    </select>
                                                </div>
                                                <div class="form-floating form-group mb-3">
                                                    <select name="position" class="form-select"
                                                        aria-label="Default select example" required>
                                                        <option disabled selected>Position</option>
                                                        <option name="position" value="Officer">Officer</option>
                                                        <option name="position" value="Manager">Manager</option>
                                                        <option name="position" value="Executive">Executive</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" value="submit"
                                                        class="btn btn-outline-success">Add</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- UPDATE MODAL -->
                            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="updateModalLabel">Update Employee</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="update.php" method="POST">
                                                <input type="hidden" name="id" id="updateId">
                                                <input type="hidden" name="dID" id="updateDID">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="updateFullname"
                                                        name="fullname" placeholder="Juan Dela Cruz">
                                                    <label for="updateFullname">Fullname</label>
                                                </div>
                                                <div class="form-floating form-group mb-3 col-lg-12">
                                                    <select name="department" class="form-select" id="updateDepartment"
                                                        aria-label="Default select example" required>
                                                        <option disabled selected>Department</option>
                                                        <option value="IT">IT</option>
                                                        <option value="Finance">Finance</option>
                                                        <option value="Sales">Sales</option>
                                                        <option value="HR and Admin">HR and Admin</option>
                                                        <option value="Operation">Operation</option>
                                                    </select>
                                                </div>
                                                <div class="form-floating form-group mb-3 col-lg-12">
                                                    <select name="position" class="form-select" id="updatePosition"
                                                        aria-label="Default select example" required>
                                                        <option disabled selected>Position</option>
                                                        <option value="Officer">Officer</option>
                                                        <option value="Manager">Manager</option>
                                                        <option value="Executive">Executive</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="update"
                                                        class="btn btn-outline-success">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FEEDBACK MODAL -->
                            <div class="modal fade" id="feedbackModal" tabindex="-1"
                                aria-labelledby="feedbackModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="feedbackModalLabel">Add Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id="feedbackDetails">

                                        </div>
                                        <form action="insertfeedback.php" method="POST">

                                            <div class="modal-body" id="feedbackRating">

                                                <center>
                                                    <h4>Add Rating Score:</h4>
                                                    <div class="btn-group" role="group"
                                                        aria-label="Basic radio toggle button group">
                                                        <input type="hidden" id="id" name="id">
                                                        <input type="radio" class="btn-check" name="score" value=1
                                                            id="btnradio1" autocomplete="off">
                                                        <label class="btn btn-outline-danger" for="btnradio1">
                                                            <p>Low/Poor</p><i class="bi bi-star"></i>
                                                        </label>
                                                        <input type="radio" class="btn-check" name="score" value=2
                                                            id="btnradio2" autocomplete="off">
                                                        <label class="btn btn-outline-warning" for="btnradio2">
                                                            <p>Average</p><i class="bi bi-star-half"> <i
                                                                    class="bi bi-star-half"></i> </i>
                                                        </label>

                                                        <input type="radio" class="btn-check" name="score" value=3
                                                            id="btnradio3" autocomplete="off">
                                                        <label class="btn btn-outline-success" for="btnradio3">
                                                            <p>Excellent</p><i class="bi bi-star-fill"> <i
                                                                    class="bi bi-star-fill"></i> <i
                                                                    class="bi bi-star-fill"></i> </i>
                                                        </label>
                                                    </div>
                                                </center>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="addfeedback"
                                                    class="btn btn-outline-success ">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- Table Element -->
                        <div class="table-data">
                            <table id="table" class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee's Name</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Initial Pay</th>
                                        <th>Performance</th>
                                        <th>Score</th>
                                        <th>New Salary</th>
                                        <th>Actions</th>
                                        <th class="hidethis">ID</th>
                                        <th class="hidethis">emID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($row > 0) {
                                        while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo ucwords($data['employee_name']); ?></td>
                                                <td><?php echo $data['job_title']; ?></td>
                                                <td><?php echo $data['department_name']; ?></td>
                                                <td><?php echo $data['monthly_pay']; ?></td>
                                                <td><?php echo $data['criteria']; ?></td>
                                                <td><?php echo $data['score']; ?></td>
                                                <td><?php echo $data['salary']; ?></td>
                                                <td>
                                                    <button class="btn btn-outline-success addfeedback" data-bs-toggle="modal"
                                                        data-bs-target="#feedbackModal"
                                                        onclick="loadClientDetails(<?php echo $data['employee_id']; ?>)">
                                                        <i class="bi bi-star"></i>
                                                    </button>
                                                    <button class="btn btn-outline-primary editemployee" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#updateModal"
                                                        onclick="loadUpdateModal(<?php echo $data['employee_id']; ?>)">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                </td>
                                                <td class="hidethis"><?php echo ucwords($data['employee_id']); ?></td>
                                                <td class="hidethis"><?php echo ucwords($data['department_id']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="7">No records found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Employee's Name</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Initial Pay</th>
                                        <th>Performance</th>
                                        <th>Score</th>
                                        <th>New Salary</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>PerformTrack</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <?php
        include 'connect.php';

        if (isset($_POST['submit'])) {
            $fname = $_POST['fname'];
            $dep = $_POST['department'];
            $pos = $_POST['position'];

            // Fetch the department_id based on the department name
            $depQuery = "SELECT department_id FROM department WHERE department_name = '$dep'";
            $depResult = mysqli_query($conn, $depQuery);

            if ($depResult && mysqli_num_rows($depResult) > 0) {
                $depRow = mysqli_fetch_assoc($depResult);
                $depId = $depRow['department_id'];

                // Insert the employee data with the retrieved department_id
                $sql = "INSERT INTO employee (fullname, job_title, department_id) VALUES ('$fname', '$pos', '$depId')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Inserted Successfully!');
                    window.location.href ='feedback.php'</script>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Error: Department not found.";
            }

            $conn->close();
        }
        ?>

        <script>
            // data tables
            $(function () {
                $('#table').DataTable({
                    paging: false,
                    lengthChange: false,
                    info: false
                });
            });

            // viewing script
            function loadClientDetails(employeeId) {
                // Fetch client details from the server using PHP
                // Modify this URL according to your server setup
                var url = 'details.php?id=' + employeeId;

                // Load the client details into the modal
                $('#feedbackDetails').load(url);
            }

            $('.addfeedback').on('click', function () {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                console.log(data);
                $('#id').val(data[8]);

            });

            $('.editemployee').on('click', function () {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                console.log(data);
                $('#updateId').val(data[8]);
                $('#updateFullname').val(data[0]);
                $('#updateDepartment').val(data[2]);
                $('#updatePosition').val(data[1]);
                $('#updateDID').val(data[9]);
            });

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>