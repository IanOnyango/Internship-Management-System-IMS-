<div id="addnewcollector" data-backdrop="static" data-keyboard="true" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Supervisor</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <center><small class="form-text text-muted" id="notif"></small></center>
            <form id="supervisorregisterform" onsubmit="return false">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="txtSupervisorFirstName" id="txtSupervisorFirstName">
                        </div>
                        <small class="form-text text-muted" id="sf_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="txtSupervisorLastName" id="txtSupervisorLastName">
                        </div>
                        <small class="form-text text-muted" id="sl_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="txtSupervisorEmailaddress" id="txtSupervisorEmailaddress">
                        </div>
                        <small class="form-text text-muted" id="se_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Phone NO</label>
                            <input type="text" class="form-control" name="txtSupervisorPhoneno" id="txtSupervisorPhoneno">
                        </div>
                        <small class="form-text text-muted" id="sp_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="txtPassword1" id="txtPassword1">
                        </div>
                        <small class="form-text text-muted" id="cp1_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="txtPassword2" id="txtPassword2">
                        </div>
                        <small class="form-text text-muted" id="cp2_error"></small>
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

<div id="editcollector" data-backdrop="static" data-keyboard="true" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supervisor Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <center><small class="form-text text-muted" id="notif"></small></center>
            <form id="supervisorregisterform" onsubmit="return false">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="editSupervisorFirstName" id="editSupervisorFirstName">
                        </div>
                        <small class="form-text text-muted" id="sf_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="editSupervisorLastName" id="editSupervisorLastName">
                        </div>
                        <small class="form-text text-muted" id="sl_error"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="editSupervisorEmailaddress" id="editSupervisorEmailaddress">
                        </div>
                        <small class="form-text text-muted" id="se_error"></small>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Phone NO</label>
                            <input type="text" class="form-control" name="editSupervisorPhoneno" id="editSupervisorPhoneno">
                        </div>
                        <small class="form-text text-muted" id="sp_error"></small>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>