<?php
  if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  include('../dbConnection.php');
  if (isset($_SESSION['isAdminLogin'])) {
    $admimEmail = $_SESSION['adminLogEmail'];
  } else {
    echo "<script> location.href='../index.php'; </script>";
  }
  if (isset($_REQUEST['requpdate'])) {
    if (($_REQUEST['stuName'] == "") || ($_REQUEST['stuEmail'] == "") || ($_REQUEST['stuPass'] == "") || ($_REQUEST['stuOcc'] == "")) {
      $msg = '<span class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</span>';
    } else {
      $stuId = $_REQUEST['stuId'];
      $stuName = $_REQUEST['stuName'];
      $stuEmail = $_REQUEST['stuEmail'];
      $stuPass = $_REQUEST['stuPass'];
      $stuOcc = $_REQUEST['stuOcc'];
      $sql = "UPDATE student SET stuId = '$stuId', stuName = '$stuName', stuEmail = '$stuEmail', stuPass = '$stuPass', stuOcc = '$stuOcc' WHERE stuId = '$stuId'";
      if ($conn->query($sql) == TRUE) {
        $msg = '<span class="alert alert-success col-sm-6 ml-5 mt-2">Updated student Successfully</span>';
      } else {
        $msg = '<span class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to updated Student</span>';
      }
       
    }
  }
?>
<?php
  if(isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM student WHERE stuId = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update student Details</title>
  <!-- bootstrap css -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- fontawesome css -->
  <link rel="stylesheet" href="../css/all.min.css">
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
  <!-- custom css -->
  <link rel="stylesheet" href="../css/adminStyle.css">
</head>
<body>
  <!-- start top navbar -->
  <nav class="navbar navbar-dark fixed-top p-0 shadow" style="background-color: #16a085">
    <a href="adminDashboard.php" class="navbar-brand col-sm-3 col-md-2 mr-0">
      iSchool <small class="text-white">Admin Area</small>
    </a>
  </nav>
  <!-- end top navbar -->

  <!-- start side bar -->
  <div class="container-fluid mb-5" style="margin-top: 40px;">
    <div class="row">
      <nav class="col-sm-3 col-md-2 bg-dark sidebar py-5 d-print-none">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="adminDashboard.php">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="courses.php">
              <i class="fa-brands fa-accessible-icon"></i>
                Courses
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="lessons.php">
              <i class="fa-brands fa-accessible-icon"></i>
                Lessons
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="students.php">
              <i class="fas fa-user"></i>
                Students
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="sellReport.php">
              <i class="fas fa-table"></i>
                Sell Report
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="paymentStatus.php">
              <i class="fas fa-table"></i>
                Payment Status
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="feedback.php">
              <i class="fa-brands fa-accessible-icon"></i>
                Feedback
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="changeAdminPass.php">
              <i class="fas fa-key"></i>
                Change Password
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">
              <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="col-sm-6 mt-5 mx-3 jumbotron">
        <h3 class="text-center">Update Student Details</h3>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="stuId">Student ID</label>
            <input type="text" name="stuId" id="stuId" class="form-control" value=" <?php if(isset($row['stuId'])) { echo $row['stuId']; } ?>" readonly>
          </div>
          <div class="form-group">
            <label for="stuName">Name</label>
            <input type="text" name="stuName" id="stuName" class="form-control" value=" <?php if(isset($row['stuName'])) { echo $row['stuName']; } ?>">
          </div>
          <div class="form-group">
            <label for="stuEmail">Email</label>
            <input type="email" name="stuEmail" id="stuEmail" class="form-control" value=" <?php if(isset($row['stuEmail'])) { echo $row['stuEmail']; } ?>">
          </div>
          <div class="form-group">
            <label for="stuPass">Password</label>
            <input type="password" name="stuPass" id="stuPass" class="form-control" value=" <?php if(isset($row['stuPass'])) { echo $row['stuPass']; } ?>">
          </div>
          <div class="form-group">
            <label for="stuOcc">Occupation</label>
            <input type="text" name="stuOcc" id="stuOcc" class="form-control" value=" <?php if(isset($row['stuOcc'])) { echo $row['stuOcc']; } ?>">
          </div>
          <div class="text-center">
            <?php 
            if (isset($msg)) {
              echo $msg;
            }
            ?>
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="students.php" class="btn btn-secondary">Canel</a>
          </div>
        </form>
      </div>
      
    </div>
  </div>
  <!-- end side bar -->

  <!-- jquery and bootstrap js -->
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <!-- fontawesome js -->
  <script src="../js/all.min.js"></script>
  <!-- admin ajax request -->
  <script type="text/javascript" src="../js/AdminAjaxRequest.js"></script>
</body>
</body>
</html>