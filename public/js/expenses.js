$("document").ready(function(){
    var BASE_URL = $('#baseurl').val();
    loadExpensesDataTable();

    $("#addExpenses").on("click", function(){

        $('#ex_status').val(0);
        $('#expense_date').datepicker({
            maxDate : new Date(),
            dateFormat: 'yy-mm-dd'
        });
        $('.ex-modal-title').html('Add Expenses');
        $("#expensesModal").modal("show");
        $('#frm_expenses')[0].reset();
    });

    $('body').delegate('.editExpenses','click',function(){
        $('#id').val($(this).data('id'));
        var id = $('#id').val();
        $('#ex_status').val(1);
        $('#expense_date').datepicker({
            maxDate : new Date(),
            dateFormat: 'yy-mm-dd'
        });
        $('.ex-modal-title').html('Edit Expenses');
        $("#expensesModal").modal("show");
        $.ajax({
            'url' : BASE_URL + '/admin/getExpenses',
            type : 'POST',
            data : {
                _token : $('[name="csrf_token"]').attr('content'),
                id : id
            },
            success : function(data){
                var admin_id = data['admin_id'];
                $('#category').val(data['category']);
                $('#description').val(data['description']);
                $('#amount').val(data['amount']);
                $('#expense_date').val(data['created_at']);
                // setState(data['state']);
            },
            error : function(xhr,asd,error){
                console.log(error);
            }
        });
    });

    $("#btnSubmitFilterExpense").on("click", function(e){
        var selected = $("#selectReportExpense").val();
        var selectedCat = $("#filterReportExpense").val();
        if(selected == null){
            swal("Error","Please select a filter","error");
            e.preventDefault();
        }else if(selected == 'byDate'){
            if($('#start_date_expense').val() == '' || $('#end_date_expense').val() == ''){
                swal("Error","Please complete the filter form","error");
                e.preventDefault();
            }
        }else if(selected == 'byCategory'){
            if(selectedCat == null){
                swal("Error","Please select category","error");
                e.preventDefault();
            }
        }
    });
    $('#selectReportExpense').on('change', function(){
        var selected = $(this).val();
        if(selected == 'allExpense'){
            $('#start_date_expense, #end_date_expense').prop('disabled', true).val("");
            $('#filterCategory').html('');
        }else if(selected == 'byDateExpense'){
            $('#start_date_expense, #end_date_expense').prop('disabled', false).val("");
            $('#filterCategory').html('');
        }else if(selected == 'byCategory'){
            $('#start_date, #end_date').prop('disabled', true).val("");
            $("#filterCategory").append
            (
                "<div class='col-xs-12'><div class='form-group'>" +
                "<label class='control-label' for='category'>Category</label>" +
                "<select class='form-control' name='filterReportExpense' id='filterReportExpense'>" +
                    "<option disabled selected> -- Select Category --</option>" +
                    "<option value='Allowance'>Allowance</option>" +
                    "<option value='Commission'>Commission</option>" +
                    "<option value='Fees'>Fees</option>" +
                    "<option value='Gas'>Gas</option>" +
                    "<option value='Supplies'>Office Supplies</option>" +
                    "<option value='Utilities'>Utilities</option>" +
                    "<option value='Others'>Others</option>" +
                "</select></div> </div>"
            );
        }
        else{
            $('#start_date, #end_date').prop('disabled', false);
            $("#filterAgent").html("");
            $("#agentInput").val("");
        }
    });
    $('#frm_expenses').validate({

        rules : {
            'category' : {selectedCheck: true },
            'description' : {required : true },
            'amount' : {required : true, number: true },
            'expense_date' : { required: true }
        }
    });
    jQuery.validator.addMethod('selectedCheck', function (value) {
        return (value != '0');
    }, "Please select an item!");

    $('#submitExpenses').on('click',function(){
        if($('#frm_expenses').valid()){
            // $("#json").val(JSON.stringify(json));
            // validateJSON();
            swal({
                    title: "Save?",
                    text: "Are you sure you want to save this?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, save it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if(isConfirm){
                        $.ajax({
                            'url' : BASE_URL + '/admin/submitExpenses',
                            type : 'POST',
                            data : {
                                _token : $('[name="csrf_token"]').attr('content'),
                                ex_status : $('#ex_status').val(),
                                id : $('#id').val(),
                                category : $('#category').val(),
                                description : $('#description').val(),
                                amount : $('#amount').val(),
                                expense_date : $('#expense_date').val(),
                            },
                            success : function(response){
                                console.log(response);
                                var ex_status = $('#ex_status').val();
                                var message = ex_status == 0 ? "saved" : "updated";
                                swal("Success!", "Successfully " +  message + "!", "success");
                                $('button.confirm').on('click',function(){
                                    $('#frm_expenses').modal('hide');
                                    location.reload();
                                });
                            },
                            error : function(xhr,me,error){
                                swal("Error!", error, "error");
                            }
                        });
                    }else{
                        swal("Cancelled", "The data is safe :)", "error");
                    }
                });
        }
    });

    $("#reportExpenses").on("click", function(){
        $('#start_date_expense').datepicker({
            maxDate : new Date(),
            dateFormat: 'yy-mm-dd'
        });
        $('#end_date_expense').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('#start_date_expense, #end_date_expense').val('');
        $('#selectReportExpense').removeAttr('selected').find('option:first').attr('selected', 'selected');
        $("#expenseReportModal").modal("show");
    });
});

function loadExpensesDataTable(){
    $("#tbl_expenses").DataTable();
}