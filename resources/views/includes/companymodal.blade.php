<div id="companyModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">COMPANY HEADER</h4>
            </div>
            <form class="form-horizontal clear_form" id="frmcompany">
                <div class="modal-body">
                        <input  type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="operation">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_name">Company Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="comp_name" name="comp_name" placeholder="Enter Company Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_email">Company Email:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="comp_email" name="comp_email" placeholder="Enter Company Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_contact_person">Contact Person:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="comp_contact_person" name="comp_contact_person" placeholder="Enter Contact Person">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_contact_number">Contact Number:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="comp_contact_number" name="comp_contact_number" placeholder="Enter Contact Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_date">Date Created:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="comp_date" name="comp_date" placeholder="Select Date Created" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_address">Address:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="comp_address" name="comp_address" placeholder="Enter Contact Address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_desc">Notes:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="comp_desc" name="comp_desc" placeholder="Enter Notes"></textarea>
                            </div>
                        </div>
                    <hr>

                    <h4>Transaction Status</h4>
                        <div id="chk_div">
                            <div class="col-xs-4">
                                <button type="button" id="btn_emailsent" class="btn checkbtn center-block" data-to="chk_emailsent" data-btn="success">
                                    <span class="glyphicon chk_emailsent"></span> Send Email
                                </button>
                                <input type="checkbox" name="chk_emailsent" id="chk_emailsent" class="chkbox" value="1">
                            </div>
                            <div class="col-xs-4">
                                {{-------------Break--------------}}
                                <button type="button" id="btn_sendattachment" class="btn checkbtn center-block" data-to="chk_sendattachment" data-btn="primary">
                                    <span class="glyphicon chk_sendattachment"></span> Send Attachment
                                </button>
                                <input type="checkbox" name="chk_sendattachment" id="chk_sendattachment" class="chkbox" value="1">
                            </div>
                            <div class="col-xs-4">
                                {{-------------Break--------------}}
                                <button type="button" id="btn_followupcall" class="btn checkbtn center-block" data-to="chk_followupcall" data-btn="info">
                                    <span class="glyphicon chk_followupcall"></span> Follow-up call
                                </button>
                                <input type="checkbox" name="chk_followupcall" id="chk_followupcall" class="chkbox" value="1">
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-xs-4">
                                {{-------------Break--------------}}
                                <button type="button" id="btn_statementofaccount" class="btn checkbtn center-block" data-to="chk_statementofaccount" data-btn="warning">
                                    <span class="glyphicon chk_statementofaccount"></span> Send Statement of Account
                                </button>
                                <input type="checkbox" name="chk_statementofaccount" id="chk_statementofaccount" class="chkbox" value="1">
                            </div>
                            <div class="col-xs-4">
                                {{-------------Break--------------}}
                                <button type="button" id="btn_bankaccountinfo" class="btn checkbtn center-block" data-to="chk_bankaccountinfo" data-btn="danger">
                                    <span class="glyphicon chk_bankaccountinfo"></span> Send Bank Account Info
                                </button>
                                <input type="checkbox" name="chk_bankaccountinfo" id="chk_bankaccountinfo" class="chkbox" value="1">
                            </div>
                            <div class="col-xs-4">
                                {{-------------Break--------------}}
                                <button type="button" id="btn_lastpaid" class="btn checkbtn center-block" data-to="chk_lastpaid" data-btn="default">
                                    <span class="glyphicon chk_lastpaid"></span> Last Paid
                                </button>
                                <input type="checkbox" name="chk_lastpaid" id="chk_lastpaid" class="chkbox" value="1">
                            </div>
                            {{------}}
                            <div class="col-xs-4">
                                {{-------------Break--------------}}
                                <button type="button" id="btn_confirm" class="btn checkbtn center-block" data-to="chk_confirm" data-btn="success">
                                    <span class="glyphicon chk_confirm"></span> Confirm
                                </button>
                                <input type="checkbox" name="chk_confirm" id="chk_confirm" class="chkbox" value="1">
                            </div>
                        </div>
                        <input type="hidden" id="json" name="json">
                        <input type="hidden" id="paid" name="paid">
                </div>
                <div class="modal-footer company-footer">
                    <input type="button" class="btn btn-danger close_modal" data-dismiss="modal" value="Close">
                    <input type="button" class="btn btn-success" value="Save" id="btnSubmitCompany">
                </div>
            </form>
        </div>

    </div>
</div>