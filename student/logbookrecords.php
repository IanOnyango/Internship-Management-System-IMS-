<?php

include_once("templates/header.php");
include_once("../database/constants.php");

if (!isset($_SESSION["studentid"])) {
  header("location:".DOMAIN."/");
}
?>

<style type="text/css">
  .shadow-reset{
  box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
  margin-bottom: 15px;
}
.sparkline8-hd{
  background:#f9f9f9;
  border-bottom:1px solid #fff;
}
.sparkline8-hd{
  padding: 15px 20px;
}
.main-sparkline8-hd{
  position:relative;
}
.main-sparkline8-hd h1{
  font-size:20px;
  color:#303030;
  position:relative;
  margin:0px;
}
.sparkline8-outline-icon{
    position: absolute;
    right:0px;
    top:0px;
  }
  .sparkline8-outline-icon span{
    padding-left:10px;
  color:#303030;
  cursor:pointer;
}
.sparkline8-graph{
  padding:20px;
  background:#fff;
}
.sparkline8-graph{
  text-align:center;
}
.sparkline8-graph .static-table-list{
  text-align:left;
}
.static-table-list .table{
  margin-bottom:0px;
}
.static-table-list .table>thead>tr>th{
  border-bottom:1px solid #ddd;
}
#savedaytask {
  padding: 4px;
  border-radius: 50%;
}

#savedaytask:hover {
  background-color: #11cdef;
  cursor: pointer;
}

</style>

<body id="page-top">
<input type="hidden" name="sid" id="sid" value="<?php echo $_SESSION['studentregno'];?>">

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
            <h1 class="h3 mb-0 text-gray-800">Logbook</h1>
            <a href="#" id="slogbook" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Logbook</a>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="box">
              <div class="box-header with-border">
                  <a href="#" id="addnewweek" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add new week</a>
                </div>
                <div class="box-body" id="logbook-entries">
                    
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once("templates/profilesettings.php");?>
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
