
<?php

include_once("templates/header.php");
include_once("../database/constants.php");

if (!isset($_SESSION["supervisorid"])) {
  header("location:".DOMAIN."/");
}
?>
<style type="text/css">
  .chat-list-wrap .chat-button .chat-icon-link{
  position: fixed;
    bottom: 40px;
    right: 25px;
    height: 40px;
    width: 40px;
    background: rgba(255,127,77,1);
  background: -moz-linear-gradient(left, rgba(255,127,77,1) 0%, rgba(255,80,10,1) 100%);
  background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,127,77,1)), color-stop(100%, rgba(255,80,10,1)));
  background: -webkit-linear-gradient(left, rgba(255,127,77,1) 0%, rgba(255,80,10,1) 100%);
  background: -o-linear-gradient(left, rgba(255,127,77,1) 0%, rgba(255,80,10,1) 100%);
  background: -ms-linear-gradient(left, rgba(255,127,77,1) 0%, rgba(255,80,10,1) 100%);
  background: linear-gradient(to right, rgba(255,127,77,1) 0%, rgba(255,80,10,1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff7f4d', endColorstr='#ff500a', GradientType=1 );
    z-index: 999;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
  cursor:pointer;
  color:#fff;
  font-size:16px;
}
.chat-box-wrap.collapse{
  position: fixed;
  height: 400px;
    width: 260px;
  background:#fff;
  bottom: 70px;
    right: 50px;
  opacity:0px;
  transition:all .4s ease 0s;
}
.chat-box-wrap.collapse.in{
  position: fixed;
  height: 335px;
    width: 260px;
  background:#fff;
  bottom: 90px;
    right: 50px;
  opacity:1px;
  transition:all .4s ease 0s;
  z-index:999;
  border:1px solid #303030;
}
.chat-main-list{
  background-color: #F0F1F5;
}
.chat-heading h2{
  font-size: 15px;
    font-weight: 400;
    margin: 0px;
    padding: 10px 15px;
    background: #264294;
    color: #fff;
}
.chat-content{
  min-height: 225px;
  max-height: 225px;
  overflow-y: auto;
}
.author-chat{
  text-align:left;
  padding: 15px;
}
.client-chat{
  text-align:right;
  padding: 15px;
}
.author-chat .message-area h3,h6{
  display: inline;
}
.author-chat .message-area h3{
  font-size:14px;
  font-weight:600;
}
.author-chat p{
  font-size: 14px;
    padding: 10px;
    background: #03a9f4;
    margin: 0px 40px 0px 0px;
    color: #fff;
  border-radius:5px;
}
.author-chat h6{
  margin: 0px 35px 0px 50px;
  color: green;
}
.client-chat h3{
  font-size:14px;
  font-weight:600;
}
.client-chat p{
  font-size:14px;
  padding: 10px;
    background: #A3B4E6;
  margin: 0px 0px 0px 40px;
  border-radius:5px;
  color:#303030;
}
.author-chat .chat-date{
  font-size: 13px;
    font-weight: 400;
    margin-left: 0px;
}
.client-chat .chat-date{
  font-size: 13px;
    font-weight: 400;
    margin-left: 66px;
}
.chat-send{
  padding:0px 20px;
  border-radius: 5px;
}
.chat-send .input-row .input-field{
  padding: 5px 10px;
    width: 100%;
  border:1px solid #ccc;
  font-size:14px;
}
.chat-send .input-row input[type="submit"]{
  margin: 0px 0px 20px 0px;
  border:1px solid #ff9966;
  background:linear-gradient(to bottom, #ff9966 0%, #d75151 100%) !important;
  display: inline-block;
  width: 100%;
  color:#fff;
  font-size:19px;
}
.chat-send .input-row .input-field:focus, .chat-send .input-row .input-field:active{
  border:1px solid #03a9f4;
  box-shadow:none;
}
.chat-send .input-row input[type="submit"]:focus, .chat-send .input-row input[type="submit"]:active{
  border:1px solid #03a9f4;
  box-shadow:none;
  font-size:14px;
}
#action_menu_btn{
    position: absolute;
    right: 10px;
    top: 10px;
    color: white;
    cursor: pointer;
    font-size: 20px;
  }
  .action_menu{
    z-index: 1;
    position: absolute;
    padding: 15px 0;
    background-color: #535AAD;
    color: white;
    border-radius: 15px;
    top: 30px;
    right: 15px;
    display: none;
    min-height: 250px;
  }
  .action_menu ul{
    list-style: none;
    padding: 0;
  margin: 0;
  }
  .action_menu ul li{
    width: 100%;
    padding: 10px 15px;
    margin-bottom: 5px;
  }
  .action_menu ul li i{
    padding-right: 10px;
  
  }
  .action_menu ul li:hover{
    cursor: pointer;
    background-color: rgba(0,0,0,0.2);
  }
  .input-row {
  margin-bottom: 500px !important;
}
  .input-field {
  margin-top: 15px;
  margin-bottom: 0px;
  width: 100%;
  border-radius: 3px;
  padding: 10px;
  border: #e0dfdf 1px solid;
  box-sizing: border-box;

}
  .icon-smile:before {
    content: " ";
    width: 16px;
    height: 16px;
    display: flex;
    background: url(../img/icon-smile.png);
    color: yellow;
}
</style>
<body id="page-top">
<input type="hidden" name="supervisoremail" id="supervisoremail" value="<?php echo $_SESSION['supervisoremail'];?>">
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-12">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">No of Students</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" id="studentsno">
                        
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->
          <br>

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

  <!-- Profile Modal-->
  <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="margin-left: 45%;"><b>Your Profile Details</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        
        </div>
      </div>
    </div>
  </div>

  <?php include_once("templates/scripts.php"); ?>

<script type="text/javascript">

    $(function () {
      // Initializes and creates emoji set from sprite sheet
      window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '../vendor/emoji-picker/lib/img/',
          popupButtonClasses: 'icon-smile'
      });

      window.emojiPicker.discover();
  });
</script>


</body>

</html>
