<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <!-- google chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="main">
            <?php include 'navbar.php'; ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3>Admin Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h5>Good to see you again</h5>
                                                <p class="mb-0">Elevate Employee Excellence</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/office.png" class="img-fluid illustration-img" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <p class="mb-0">Total Number of Employees</p><br>
                                                <h2>
                                                    <?php
                                                    include 'connect.php';
                                                    echo $conn->query("SELECT * FROM employee")->num_rows
                                                        ?>
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/Employee.png" class="img-fluid illustration-img" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <p class="mb-0">Employees Given Feedback</p><br>
                                                <h2>
                                                    <?php
                                                    include 'connect.php';
                                                    echo $conn->query("SELECT * FROM `employee_overview`")->num_rows
                                                        ?>
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/Working-amico.png" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- for the pie chart -->
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <center>
                                                <div id="chart_div" style="width: 570px; height: 400px;"></div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 ">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <center>
                                            <div id="donutchart" style="width: 670px; height: 500px;"></div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Employee's Table
                            </h5>
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
                                        <th>Rating</th>
                                        <th>New Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'connect.php';

                                    $sql = "SELECT * FROM `employee_overview`";

                                    $query = mysqli_query($conn, $sql);

                                    // Check for query execution errors
                                    if (!$query) {
                                        die('Error: ' . mysqli_error($conn));
                                    }

                                    $row = mysqli_num_rows($query);

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
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">No records found</td>
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
                                        <th>Rating</th>
                                        <th>New Salary</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
    </div>

    <script>
        // data tables
        $(function () {
            $('#table').DataTable({});
        });

        // Load Google Charts library
        google.charts.load("current", { packages: ["corechart", "bar"] });
        google.charts.setOnLoadCallback(drawCharts);

        // Draw all charts
        function drawCharts() {
            drawDonutChart();
            drawBarChart();
        }

        // Donut Chart
        function drawDonutChart() {
            <?php
            // Include database connection
            include 'connect.php';

            // Fetch data from the feedback_employee_count view
            $sql = "SELECT criteria, employee_count FROM feedback_employee_count";
            $result = mysqli_query($conn, $sql);

            // Create an array to store the data
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = array($row['criteria'], (int) $row['employee_count']);
            }
            ?>
                                                    
                                           // Convert PHP array to JavaScript array
                                             var data = google.visualization.arrayToDataTable([
                                               ['Feedback Criteria', 'Employee Count'],
        <?php
        foreach ($data as $row) {
            echo "['" . $row[0] . "', " . $row[1] . "],";
        }
        ?>
    ]);

    // Define chart options
    var options = {
        title: 'EMPLOYEE COUNT FOR EACH FEEDBACK',
        pieHole: 0.4,
    };

    // Draw the chart
    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
}



        // Bar Chart
        function drawBarChart() {
            var dataArray = [
                ['DEPARTMENT', 'EMPLOYEES'],
                <?php
                $sql = "SELECT d.department_name, COUNT(e.employee_id) AS total_employees 
                        FROM department d 
                        LEFT JOIN employee e ON d.department_id = e.department_id 
                        GROUP BY d.department_id, d.department_name";

                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "['" . $row['department_name'] . "', " . $row['total_employees'] . "],";
                }
                ?>
            ];

            var dataTable = google.visualization.arrayToDataTable(dataArray);

            var options = {
                title: 'NO. OF EMPLOYEES PER DEPARTMENT',
                chartArea: { width: '50%' },
                hAxis: {
                    title: 'NUMBER OF EMPLOYEES',
                    minValue: 0
                },
                vAxis: {
                    title: 'DEPARTMENT'
                },
                colors: ['#4477CE'] // Custom colors for the bars
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(dataTable, options);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
