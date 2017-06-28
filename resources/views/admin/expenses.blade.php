<?php
use App\User;
?>

<style>td{text-align: center;}</style>
<h2>List of Expenses</h2>
<button id="addExpenses" class="btn btn-primary ">ADD EXPENSES</button>
<button id="reportExpenses" class="btn btn-primary">PRINT REPORT</button>
<input type="hidden" id="expense_auth_id" value="{{ Auth::user()->id }}" data-usertype="{{ Auth::user()->user_type }}">
<table id="tbl_expenses" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Category</th>
        <th>Description</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Admin</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expenses as $key => $value)
        <tr>
            <td>{{ $value->category }}</td>
            <td>{{ $value->description }}</td>
            <td>{{ $value->amount }}</td>
            <td>{{ date('Y-m-d',strtotime($value->created_at)) }}</td>
            {{--<td>sample</td>--}}
            <td>{{ \App\User::getuserbyid($value->admin_id)->firstname . " " . \App\User::getuserbyid($value->admin_id)->lastname }}</td>
            <td>
                <button class="btn btn-success editExpenses" data-id="{{ $value->id }}">Edit</button>
                {{--<button class="btn btn-danger deletExpenses" data-id="{{ $value->id }}">Delete</button>--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


{{--  Expenses Modal --}}
<div id="expensesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="ex-modal-title">Add Expenses</h4>
            </div>
            <form name="frm_expenses" id="frm_expenses" method="post">
                <div class="modal-body userForm-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="ex_status" id="ex_status">

                    <div class="form-group">
                        <label class="control-label" for="category">Category</label>
                        <div class="div-text">
                            {{--<input type="text" class="form-control" id="category" name="category" placeholder="Enter New Category">--}}
                            <select class="form-control" name="category" id="category">
                                <option value="0" >Select Category</option>
                                <option value="Allowance">Allowance</option>
                                <option value="Commission">Commission</option>
                                <option value="Fees">Fees</option>
                                <option value="Gas">Gas</option>
                                <option value="Supplies">Office Supplies</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="description">Description</label>
                        <div class="div-text">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="amount">Amount</label>
                        <div class="div-text">
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="expense_date">Date</label>
                        <div class="div-text">
                            <input type="text" readonly class="form-control" id="expense_date" name="expense_date" placeholder="Date">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" id="submitExpenses" class="btn btn-success" value="Submit">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Report-->
<div id="expenseReportModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Expenses List Report</h3>
            </div>
            <div class="modal-body">
                <form method="post" action="reportExpenses" id="frmFilterExpense">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="selectReportExpense">Filter:</label>
                            <select class="form-control" name="selectReportExpense" id="selectReportExpense">
                                <option disabled selected> -- Select --</option>
                                <option value="allExpense">All Expenses</option>
                                <option value="byDateExpense">All Expenses by Date</option>
                                <option value="byCategory">All Expenses by Category</option>
                            </select>
                        </div>
                    </div>
                    <div id="filterCategory"></div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="start_date_expense">Start Date:</label>
                            <input class="form-control" placeholder="Start Date" type="text" name="start_date_expense" id="start_date_expense">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="end_date_expense">End Date:</label>
                            <input class="form-control" placeholder="End Date" type="text" name="end_date_expense" id="end_date_expense">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Print" class="btn btn-primary center-block" formtarget="_blank" id="btnSubmitFilterExpense">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


