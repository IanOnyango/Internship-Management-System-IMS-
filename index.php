<?php include_once("templates/header.php");?>
<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <!--<img src="images/icon/logo.png" alt="CoolAdmin">-->
                            </a>
                        </div>
                        <div class="register-right">
                            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="true">Student</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="supervisor-tab" data-toggle="tab" href="#supervisor" role="tab" aria-controls="supervisor" aria-selected="false">Supervisor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab" style="margin-top: 20px;">
                                    <form id="student-form" onsubmit="return false">
                                        <div class="form-group">
                                            <label>Reg NO</label>
                                            <input class="au-input au-input--full" type="text" name="student_id" id="student_id" placeholder="Registration No">
                                        </div>
                                        <small class="form-text text-muted" id="student_id_error"></small>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="au-input au-input--full" type="password" name="student_password" id="student_password" placeholder="Password">
                                        </div>
                                        <small class="form-text text-muted" id="student_password_error"></small>
                                        <div class="login-checkbox">
                                            <label>
                                                <input type="checkbox" name="remember">Remember Me
                                            </label>
                                            <label>
                                                <a href="#">Forgotten Password?</a>
                                            </label>
                                        </div>
                                        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                    </form>
                                </div>

                                <div class="tab-pane fade show" id="supervisor" role="tabpanel" aria-labelledby="supervisor-tab" style="margin-top: 20px;">
                                    <form id="supervisor-form" onsubmit="return false">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input class="au-input au-input--full" type="email" name="supervisor_email" id="supervisor_email" placeholder="Email">
                                        </div>
                                        <small class="form-text text-muted" id="supervisor_email_error"></small>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="au-input au-input--full" type="password" name="supervisor_password" id="supervisor_password" placeholder="Password">
                                        </div>
                                        <small class="form-text text-muted" id="supervisor_password_error"></small>
                                        <div class="login-checkbox">
                                            <label>
                                                <input type="checkbox" name="remember">Remember Me
                                            </label>
                                            <label>
                                                <a href="#">Forgotten Password?</a>
                                            </label>
                                        </div>
                                        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                    </form>
                                </div>

                                <div class="tab-pane fade show" id="admin" role="tabpanel" aria-labelledby="admin-tab" style="margin-top: 20px;">
                                    <form id="admin-form" onsubmit="return false">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input class="au-input au-input--full" type="email" name="admin_email" id="admin_email" placeholder="Email">
                                        </div>
                                        <small class="form-text text-muted" id="admin_email_error"></small>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="au-input au-input--full" type="password" name="admin_password" id="admin_password" placeholder="Password">
                                        </div>
                                        <small class="form-text text-muted" id="admin_password_error"></small>
                                        <div class="login-checkbox">
                                            <label>
                                                <input type="checkbox" name="remember">Remember Me
                                            </label>
                                            <label>
                                                <a href="#">Forgotten Password?</a>
                                            </label>
                                        </div>
                                        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

   <?php include_once("templates/scripts.php");?>

</body>

</html>
<!-- end document-->