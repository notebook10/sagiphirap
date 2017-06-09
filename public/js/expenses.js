$("document").ready(function(){
    var BASE_URL = $('#baseurl').val();
    loadExpensesDataTable();

    $("#addExpenses").on("click", function(){

        $('#ex_status').val(0);
        $('#expense_date').datepicker({
            maxDate : new Date()
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
            maxDate : new Date()
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
                $('#expense_date').val(data['date']);
                // setState(data['state']);
            },
            error : function(xhr,asd,error){
                console.log(error);
            }
        });
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
});

function loadExpensesDataTable(){
    $("#tbl_expenses").DataTable();
}