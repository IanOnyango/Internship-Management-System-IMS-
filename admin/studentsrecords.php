<?php

include_once("templates/header.php");
include_once("../database/constants.php");

if (!isset($_SESSION["adminid"])) {
  header("location:".DOMAIN."/");
}
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <?php include_once("templates/sidebar.php");?>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <?php include_once("templates/navbar.php");?>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Students</h1>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="box">
                <div class="box-header with-border">
                  <!--<a href="#addnewfarmer" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>-->
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered">
                    <thead">
                      <th>#</th>
                      <th>Full Names</th>
                      <th>Added By</th>
                      <th>Reg Number</th>
                      <th>Phone Number</th>
                      <th>Email</th>
                      <th>Date Added</th>
                      <th></th>
                    </thead>
                    <tbody id="studentstable">
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->

      <?php include_once("templates/footer.php");?>
      
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include_once("templates/scripts.php"); ?>

</body>

</html>
