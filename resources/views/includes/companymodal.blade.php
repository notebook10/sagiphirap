<div id="companyModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">COMPANY HEADER</h4>
            </div>
            {{--<form class="form-horizontal" id="frmcompany" name="frmcompany" method="post" action="submitcompany">--}}
            <form class="form-horizontal" id="frmcompany">
                <div class="modal-body">
                        <input  type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_name">Company Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="comp_name" name="comp_name" placeholder="Enter Company Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="comp_desc">Description:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="comp_desc" name="comp_desc" placeholder="Enter Company Description"></textarea>
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
                            <label class="control-label col-sm-2" for="comp_address">Address:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="comp_address" name="comp_address" placeholder="Enter Contact Address"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
                    {{--<input type="submit" class="btn btn-success" value="Save" id="btnSubmitCompany">--}}
                    <input type="button" class="btn btn-success" value="Save" id="btnSubmitCompany">
                </div>
            </form>
        </div>

    </div>
</div>