<!-- Modal -->
<div id="reportModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Report Modal</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="submitfilter" id="frmFilter">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <select name="selectReport" id="selectReport">
                        <option disabled selected> -- Select --</option>
                        <option value="all">All Companies Paid/not Paid</option>
                        <option value="paid">Paid Companies</option>
                    </select>
                    <input type="text" name="start_date" id="start_date">
                    <input type="text" name="end_date" id="end_date">
                    <input type="submit" value="View" id="btnSubmitFilter">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close_modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>