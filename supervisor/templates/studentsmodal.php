<div id="addnewstudent" data-backdrop="static" data-keyboard="true" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <center><small class="form-text text-muted" id="msg"></small></center>
            <form id="studentregisterform" onsubmit="return false">
            <input type="hidden" name="supervisoremail" id="supervisoremail" value="<?php echo $_SESSION['supervisoremail'];?>">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="txtStudentFirstName" id="txtStudentFirstName">
                        </div>
                        <small class="form-text text-muted" id="sf_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="txtStudentLastName" id="txtStudentLastName">
                        </div>
                        <small class="form-text text-muted" id="sl_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Reg Number</label>
                            <input type="text" class="form-control" name="txtStudentRegno" id="txtStudentRegno">
                        </div>
                        <small class="form-text text-muted" id="sr_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Phone NO</label>
                            <input type="text" class="form-control" name="txtStudentPhoneno" id="txtStudentPhoneno">
                        </div>
                        <small class="form-text text-muted" id="sp_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="txtStudentEmailaddress" id="txtStudentEmailaddress">
                        </div>
                        <small class="form-text text-muted" id="se_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="txtPassword1" id="txtPassword1">
                        </div>
                        <small class="form-text text-muted" id="sp1_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="txtPassword2" id="txtPassword2">
                        </div>
                        <small class="form-text text-muted" id="sp2_error"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 83%;">Cancel</button>
                <button type="submin" class="btn btn-primary">Save</button>
            </form>    
            </div>
        </div>
    </div>
</div>

<div id="editstudent" data-backdrop="static" data-keyboard="true" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Student Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <center><small class="form-text text-muted" id="msg"></small></center>
            <form id="studentregisterform" onsubmit="return false">
            <input type="hidden" name="supervisoremail" id="supervisoremail" value="<?php echo $_SESSION['supervisoremail'];?>">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="txtStudentFirstName" id="editStudentFirstName">
                        </div>
                        <small class="form-text text-muted" id="sf_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="txtStudentLastName" id="editStudentLastName">
                        </div>
                        <small class="form-text text-muted" id="sl_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Reg Number</label>
                            <input type="text" class="form-control" name="txtStudentRegno" id="editStudentRegno">
                        </div>
                        <small class="form-text text-muted" id="sr_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Phone NO</label>
                            <input type="text" class="form-control" name="txtStudentPhoneno" id="editStudentPhoneno">
                        </div>
                        <small class="form-text text-muted" id="sp_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="txtStudentEmailaddress" id="editStudentEmailaddress">
                        </div>
                        <small class="form-text text-muted" id="se_error"></small>
                    </div>
                </div>
            </div>
           </form>
        </div>
    </div>
</div>