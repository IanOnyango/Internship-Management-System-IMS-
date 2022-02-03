<style type="text/css">
  .sidenav {
    height: 100%; /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 1; /* Stay on top */
    top: 0;
    right: 0;
    background-color: #32325d; /* Black*/
    overflow-y: hidden;
    overflow-x: hidden; /* Disable horizontal scroll */ /* Place content 60px from the top */
    transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
    }

    /* The navigation menu links */
    .sidenav .settings {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    color: #fff;
    display: block;
    transition: 0.3s
    }

    /* When you mouse over the navigation links, change their color 
    .sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
    }

    /* Position and style the close button (top right corner) */
    .sidenav .settings-header{
      display: flex;
      align-items: center;
      margin-top: 20px;
    }
    .sidenav .settings-header span,h6{
      display: inline-block;
      color: #fff;
    }
    .sidenav .settings-header .closebtn {
      margin-left: 20px;
      height: 40px;
      width: 40px;
      border-radius: 50%;
      background-color: #5e72e4;
      display: flex;
      justify-content: center;
      align-items: center;
    /*font-size: 36px;*/
    }

    .sidenav .settings-header .closebtn:hover {
      border-style: solid;
      border-width: 1px;
      border-color: gray;
      cursor: pointer;

    /*font-size: 36px;*/
    }

    .sidenav .settings-header h6{
      margin-left: 20px
    }

    .sidenav .settings-user-details h6{
      margin-left: 20px;
    }

    .sidenav .settings-user-details .chev-down {
      right: 20px;
      position: absolute;
    }

    .sidenav .change-password h6{
      margin-left: 20px;
    }

     .sidenav .change-password .chev-down-password {
      right: 20px;
      position: absolute;
    }

    .sidenav .settings-logout {
      bottom: 0;
    }

    .sidenav .settings-logout h6, .sidenav .settings-logout .sign-out{
      display: inline-block;
    }

    .sidenav .settings-logout h6{
      margin-left: 20px;
    }

    .sidenav .settings-logout span {
      position: absolute;
      float: right !important;
      right: 20px;
      padding: 4px;
      border-radius: 50%;
      background-color: #0E0733;
    }

    .sidenav .settings-logout .sign-out{
     
    }

    .sidenav .settings-security .security-switch{
      margin-top: 10px;
      margin-left: 20px;
      color: #fff;
    }

    .sidenav .settings-security .settings-authentication{
      margin-top: 10px;
      margin-left: 20px;
      margin-right: 20px;
      color: #111;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
    }

    /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
    #main {
    transition: margin-left .5s;
    padding: 20px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
    }
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 28px;
    }

    .switch, .status{
      display: inline-block;
    }

    /* Hide default HTML checkbox */
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(20px);
      -ms-transform: translateX(20px);
      transform: translateX(20px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 24px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    .category {
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 10px;
        margin-right: 10px;
    }
    .category .input-group {
        min-width: 200px;
        display: flex;
        align-items: center;
    }
    .category .input-group-addon, .category input {
        border-color: #ddd;
        border-radius: 0;
        background-color: transparent;
    }
    .category .input-group-addon {
        border: none;
        border: none;
        background: transparent;
        position: absolute;
        z-index: 9;
    }
    
    .category input {
        height: 34px;
        padding-left: 90px;     
        box-shadow: none !important;
        border: none;
    }
    .category input:focus {
        border-color: #3FBAE4;
        background-color: transparent;
        border-style: solid;
        border-width: 0 0 1px 0;
    }
    .category h6 {
        color: #fff;
        position: relative;
        left: -10px;
    }


    .category-password {
        margin-top: 10px;
        margin-bottom: 10px;
        margin-left: 30px;
        margin-right: 10px;
    }
    .category-password .input-group {
        min-width: 200px;
        display: flex;
        align-items: center;
    }
    .category-password .input-group-addon, .category-password input {
        border-color: #ddd;
        border-radius: 0;
        background-color: transparent;
    }
    .category-password .input-group-addon {
        border: none;
        border: none;
        background: transparent;
        position: absolute;
        z-index: 9;
    }

    .category-password input {
        height: 34px;
        padding-left: 20px;     
        box-shadow: none !important;
        border: none;
    }
    .category-password input:focus {
        border-color: #3FBAE4;
        background-color: transparent;
        border-style: solid;
        border-width: 0 0 1px 0;
    }
    .category-password span {
        color: #fff;
        position: relative;
        left: -10px;
    }

    .change-password .arrow {
      margin-top: -40px;
      float: right;
      width: 30px;
      height: 30px;
      right: 10px;
      position: relative;
      border-radius: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }

    .change-password .arrow:hover {
      background-color: #0E0733;
      cursor: pointer;
    }

</style>

<div id="mySidenav" class="sidenav">
  <div class="settings-header">
    <span class="closebtn" id="closebtn"><i class="fas fa-arrow-right fa-1x"></i></span>
    <h6>Profile Settings</h6>
  </div>
  <hr class="horizontaldivider">
  <div class="settings-user-details">
    <h6>Your Details</h6>
    <i class="fa fa-chevron-up chev-down"></i>
	    <div class="user-settings">
        <div class="category">
            <div class="input-group">
                <span class="input-group-addon"><h6 class="f-title">Firstname</h6></span>
                <input type="text" name="edit1" id="txtUfirstname">
            </div>
        </div>
		    <div class="category">
            <div class="input-group">
                <span class="input-group-addon"><h6>Lastname</h6></span>
                <input type="text" name="edit2" id="txtUlastname">
            </div>
        </div>
		    <div class="category">
            <div class="input-group">
                <span class="input-group-addon"><h6>Regno</h6></span>
                <input type="text" id="txtUregno" readonly/>
            </div>
        </div>
		    <div class="category">
            <div class="input-group">
                <span class="input-group-addon"><h6>Phone</h6></span>
                <input type="text" name="edit3" id="txtUphone">
            </div>
        </div>
		    <div class="category">
            <div class="input-group">
                <span class="input-group-addon"><h6>Email</h6></span>
                <input type="text" name="edit4" id="txtUemail"> 
            </div>
        </div>
		    <div class="category">
            <div class="input-group">
                <span class="input-group-addon"><h6>Joined</h6></span>
                <input type="text" id="txtUdatejoined" readonly/> 
            </div>
        </div>
		</div>
  </div>
  <hr>
  <div class="change-password">
    <h6>Change Password</h6>
    <i class="fa fa-chevron-up chev-down-password"></i>
      <div class="user-settings-password">
        <div class="category-password">
            <div class="input-group">
                <center><small class="form-text text-muted" id="cp1_error"></small></center>
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" id="input-password" placeholder="New Password">
            </div>
        </div>
        <div class="category-password">
            <div class="input-group">
                <center><small class="form-text text-muted" id="cp2_error"></small></center>
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" name="edit" id="input-confirm-password" placeholder="Confirm Password">
            </div>
        </div>
      </div>
      <span class="arrow" id="btn-change-password"><i class="fa fa-arrow-right"></i></span>
  </div>
  <!--
  <hr class="horizontaldivider">
  <div class="settings-report">
    <h6>Reports</h6>
    <div class="report-switch">
      
    </div>
    <div class="settings-time">
      <div class="time-weekly">
          <input type="radio" id="option-weekly"/>
          <label for="option-weekly">Weekly</label>
          <div class="check"></div>
      </div>
      <div class="time-monthly">
          <input type="radio" id="option-monthly"/>
          <label for="option-monthly">Monthly</label>
          <div class="check"></div>
      </div>
    </div>
  </div>
  -->
  <div class="settings-logout">
  <hr class="settings-logout-hr">
    <h6>Logout</h6>
    <span><a href="logout.php"><i class="fa fa-arrow-right sign-out"></i></a></span>
  </div>
</div>