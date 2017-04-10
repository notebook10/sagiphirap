<!-- Modal -->
<div id="reportModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Company List Report</h3>
            </div>
            <div class="modal-body">
                <form method="post" action="submitfilter" id="frmFilter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="selectReport">Filter:</label>
                            <select class="form-control" name="selectReport" id="selectReport">
                                <option disabled selected> -- Select --</option>
                                <option value="all">All Companies Paid/not Paid</option>
                                <option value="paid">Paid Companies</option>
                                <option value="confirmnotpaid">Confirmed but not Paid</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="start-date">Start Date:</label>
                            <input class="form-control" placeholder="Start Date" type="text" name="start_date" id="start_date">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="end_date">End Date:</label>
                            <input class="form-control" placeholder="End Date" type="text" name="end_date" id="end_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Print" class="btn btn-primary center-block" formtarget="_blank" id="btnSubmitFilter">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>