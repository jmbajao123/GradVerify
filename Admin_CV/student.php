<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['email']) && isset($_SESSION['a_id']) && ($_SESSION['password']) ) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Students - Credentials Verification Sibugay Technical Institute Inc.</title>

  <!-- General CSS Files -->
  <link rel="shortcut icon" href="assets/img/s.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php include 'Include/header.php'; ?>
      <div class="main-sidebar sidebar-style-2">
        <?php include 'Include/side_bar.php'; ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Students List</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"> <a href="dashboard.php"> Dashboard </a> </div>
              <!-- <div class="breadcrumb-item"><a href="#">Department List</a></div> -->
              <div class="breadcrumb-item">Students List
              	
              </div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Students List
            	<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
              		Add Students
              	</button>
            </h2>
            <div class="col-lg-12">
                <div class="row">

                </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <?php
                    include 'conn.php';

                    // Get the current page number from URL, default is 1
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                    $limit = 10; // Maximum records per page
                    $offset = ($page - 1) * $limit; // Calculate offset for pagination

                    // Fetch total number of records for pagination
                    $totalQuery = "SELECT COUNT(*) as total FROM students";
                    $totalResult = mysqli_query($conn, $totalQuery);
                    $totalRow = mysqli_fetch_assoc($totalResult);
                    $totalRecords = $totalRow['total'];
                    $totalPages = ceil($totalRecords / $limit);

                    // Fetch student records with department and course names, using LIMIT & OFFSET for pagination
                    $query = "SELECT s.s_id, s.first_name, s.middle_name, s.last_name, s.suffix_name, s.student_status,
                                     d.department_name, c.course_name
                              FROM students s
                              LEFT JOIN departments d ON s.d_id = d.d_id
                              LEFT JOIN course c ON s.c_id = c.c_id
                              LIMIT $limit OFFSET $offset";

                    $result = mysqli_query($conn, $query);
                    ?>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Department</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($result) > 0) :
                                        $count = $offset + 1; // Start count based on offset
                                        while ($row = mysqli_fetch_assoc($result)) :
                                            // Construct full name while handling empty or 'None' suffix
                                            $fullName = trim("{$row['first_name']} {$row['middle_name']} {$row['last_name']}");
                                            if (!empty($row['suffix_name']) && strtolower($row['suffix_name']) !== "none") {
                                                $fullName .= " " . $row['suffix_name'];
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= htmlspecialchars($fullName) ?></td>
                                                <td><?= htmlspecialchars($row['department_name'] ?? 'N/A') ?></td>
                                                <td><?= htmlspecialchars($row['course_name'] ?? 'N/A') ?></td>
                                                <td><?= htmlspecialchars($row['student_status']) ?></td>
                                                <td><a href="students_info.php?s_id=<?php echo htmlspecialchars($row['s_id']); ?>" class="btn btn-secondary">Detail</a></td>
                                            </tr>
                                    <?php
                                            $count++;
                                        endwhile;
                                    else : ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No Students Record found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <!-- Previous Page -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-chevron-left"></i></a>
                                </li>

                                <!-- Page Numbers -->
                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Next Page -->
                                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <?php
                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </div>
              </div>
            </div>
            
            
          </div>
        </section>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Students</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="student.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label><h6>First Name</h6></label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Middle Name</h6></label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Enter Middle Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Last Name</h6></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Suffix Name</h6></label>
                                <select class="form-control" name="suffix_name" required>
                                    <option selected disabled>Choose a Suffix</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Date of Birth</h6>
                                </label>
                                <input type="date" name="date_birth" id="date_birth" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Age</h6>
                                </label>
                                <input type="number" name="age" id="age" class="form-control" readonly>
                            </div>
                            <?php include 'date_age.php'; ?>
                            <div class="col-lg-3">
                                <label><h6>Gender</h6></label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option selected disabled>Choose a Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Civil Status</h6></label>
                                <select class="form-control" name="civil_status" id="civil_status" required>
                                    <option selected disabled>Choose a Civil Status</option>
                                    <option value="Married">Married</option>
                                    <option value="Single">Single</option>
                                    <option value="Divorce">Divorce</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Province</h6>
                                </label>
                                <input type="text" name="province" id="province" class="form-control" placeholder="Input the Provice Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Municipality</h6>
                                </label>
                                <input type="text" name="municipality" id="province" class="form-control" placeholder="Input the Municipality Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Barangay</h6>
                                </label>
                                <input type="text" name="barangay" id="barangay" class="form-control" placeholder="Input the Barangay Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Street</h6>
                                </label>
                                <input type="text" name="street" id="street" class="form-control" placeholder="Input the Provice Name" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                           <div class="col-lg-3">
                                <label><h6>Profile</h6></label>
                                <input type="file" name="profile" id="profile" class="form-control" required onchange="generateUniqueStudentDetails()">
                            </div>

                            <div class="col-lg-3">
                                <label><h6>Student ID</h6></label>
                                <input type="number" name="student_id" id="student_id" class="form-control" placeholder="Enter Student ID"  readonly>
                            </div>

                            <div class="col-lg-3">
                                <label><h6>Student Verification Code</h6></label>
                                <input type="number" name="student_vcode" id="student_vcode" class="form-control" placeholder="Verification Code" readonly>
                            </div>

                            <script>
                                let generatedIds = new Set(); // To store unique Student IDs

                                function generateUniqueStudentDetails() {
                                    let studentIdField = document.getElementById("student_id");
                                    let vCodeField = document.getElementById("student_vcode");

                                    let studentId, verificationCode;

                                    do {
                                        studentId = Math.floor(100000 + Math.random() * 900000); // 6-digit unique ID
                                    } while (generatedIds.has(studentId));

                                    generatedIds.add(studentId);

                                    verificationCode = Math.floor(100000 + Math.random() * 900000); // Unique 6-digit verification code

                                    studentIdField.value = studentId;
                                    vCodeField.value = verificationCode;
                                }
                            </script>

                            <?php
                                include 'conn.php';
                                $deptQuery = "SELECT d_id, department_name FROM departments WHERE department_status = 'Active'";
                                $deptResult = mysqli_query($conn, $deptQuery);
                                
                                $courseQuery = "SELECT c_id, course_name, d_id FROM course WHERE course_status = 'Active'";
                                $courseResult = mysqli_query($conn, $courseQuery);
                                
                                $courses = [];
                                while ($row = mysqli_fetch_assoc($courseResult)) {
                                    $courses[$row['d_id']][] = [
                                        'c_id' => $row['c_id'],
                                        'course_name' => $row['course_name']
                                    ];
                                }
                                mysqli_close($conn);
                            ?>

                            <div class="col-lg-3">
                                <label><h6>Department Name</h6></label>
                                <select class="form-control" name="d_id" id="d_id" onchange="filterCourses()">
                                    <option selected disabled>Choose a Department</option>
                                    <?php while ($row = mysqli_fetch_assoc($deptResult)) { ?>
                                        <option value="<?= $row['d_id'] ?>"><?= htmlspecialchars($row['department_name']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label><h6>Course Name</h6></label>
                                <select class="form-control" name="c_id" id="c_id">
                                    <option selected disabled id="defaultOption">Choose a Course</option>
                                    <?php foreach ($courses as $d_id => $courseList) { ?>
                                        <?php foreach ($courseList as $course) { ?>
                                            <option value="<?= $course['c_id'] ?>" data-dept="<?= $d_id ?>" style="display: none;">
                                                <?= htmlspecialchars($course['course_name']) ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <script>
                                function filterCourses() {
                                    var selectedDept = document.getElementById("d_id").value;
                                    var courseDropdown = document.getElementById("c_id");
                                    var options = courseDropdown.getElementsByTagName("option");
                                    var defaultOption = document.getElementById("defaultOption");

                                    courseDropdown.value = "";
                                    defaultOption.style.display = "block";
                                    defaultOption.selected = true;

                                    for (var i = 1; i < options.length; i++) {
                                        if (options[i].getAttribute("data-dept") === selectedDept) {
                                            options[i].style.display = "block";
                                        } else {
                                            options[i].style.display = "none";
                                        }
                                    }
                                }
                            </script>
                            <div class="col-lg-3">
                                <label><h6>School Year Graduated</h6></label>
                                <input type="text" name="year_graduated" id="year_graduated" class="form-control" placeholder="Input the Year Graduated" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Date of  Graduation</h6></label>
                                <input type="date" name="date_graduation" id="date_graduation" class="form-control" placeholder="Input the Date of Graduation" required>
                            </div>
                            
                            <div class="col-lg-3">
                                <label>
                                    <h6>Honors</h6>
                                </label>
                                <input type="text" name="honors" id="honors" class="form-control" placeholder="Input the Honors Name" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Certificate of Diploma</h6>
                                </label>
                                <input type="file" name="diploma" id="diploma" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Certificate of Graduation</h6>
                                </label>
                                <input type="file" name="graduation" id="graduation" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Transcipt of Records (TOR)</h6>
                                </label>
                                <input type="file" name="tor" id="tor" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Status</h6></label>
                                <select class="form-control" name="student_status">
                                    <option selected disabled>Select Status</option>
                                    <option value="Verified">Verified</option>
                                    <option value="Not Verified">Not Verified</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Add now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
      <?php
include 'conn.php';

// Handle file upload function
function handleFileUpload($fileInputName, $folderName) {
    $targetDir = $folderName . '/';
    $targetFile = $targetDir . basename($_FILES[$fileInputName]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ["jpg", "jpeg", "png", "pdf", "docx"];

    if (!in_array($fileType, $allowedTypes)) {
        return "";
    }

    // File size limit (5MB)
    if ($_FILES[$fileInputName]["size"] > 5000000) {
        return "";
    }

    return move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile) ? $targetFile : "";
}

// Check admin session
if (!isset($_SESSION['a_id'])) {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Session Expired!',
            text: 'Please log in again.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href='login.php';
        });
    </script>";
    exit();
}

$a_id = $_SESSION['a_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    
    $required_fields = ['d_id', 'c_id', 'first_name', 'middle_name', 'last_name', 'suffix_name', 'student_id', 'student_vcode', 
                        'student_status', 'date_birth', 'age', 'gender', 'civil_status', 'province', 'municipality', 
                        'barangay', 'street', 'year_graduated', 'date_graduation', 'honors'];

    foreach ($required_fields as $field) {
        if (empty(trim($_POST[$field] ?? ''))) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Fields',
                    text: 'Please fill in all required fields.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>";
            exit();
        }
    }

    function sanitize($data) {
        global $conn;
        return mysqli_real_escape_string($conn, trim($data));
    }

    $data = array_map('sanitize', $_POST);
    $profile = handleFileUpload('profile', '../uploads');
    $diploma = handleFileUpload('diploma', '../diploma');
    $graduation = handleFileUpload('graduation', '../Credentials');
    $tor = handleFileUpload('tor', '../TOR');
    $date = date('Y-m-d');

    $sql = "INSERT INTO students (d_id, c_id, first_name, middle_name, last_name, suffix_name, student_id, student_vcode, 
            student_status, date_birth, age, gender, civil_status, province, municipality, barangay, street, 
            year_graduated, date_graduation, a_id, profile, diploma, graduation, tor, honors, date) 
            VALUES ('{$data['d_id']}', '{$data['c_id']}', '{$data['first_name']}', '{$data['middle_name']}', '{$data['last_name']}', '{$data['suffix_name']}', 
                    '{$data['student_id']}', '{$data['student_vcode']}', '{$data['student_status']}', '{$data['date_birth']}', '{$data['age']}', 
                    '{$data['gender']}', '{$data['civil_status']}', '{$data['province']}', '{$data['municipality']}', '{$data['barangay']}', 
                    '{$data['street']}', '{$data['year_graduated']}', '{$data['date_graduation']}', '$a_id', '$profile', '$diploma', '$graduation', '$tor', 
                    '{$data['honors']}', '$date')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Credentials Student!',
                text: 'Credentials of student added successfully.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href='student.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Database Error',
                text: 'Error: " . mysqli_error($conn) . "',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }
    mysqli_close($conn);
}
?>




    

		  </div>
		</div>
      </div>
      <?php include 'Include/footer.php'; ?>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/components-table.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>

<?php 
}else{
    header("Location: index.php");
    exit();
}

?>