$('document').ready(function(){
    var BASE_URL = $('#baseurl').val();
    loadClientCompaniesDataTable();
    $('#addcompany').on('click',function(){
        $('#companyModal').modal('show');
    });
    $('#createAccount').on('click',function(){
        $('#registerModal').modal('show');
    });
    $('.btnedit').on('click',function(){
        swal("Here's a message!", "Not yet available");
    });
    $('#frmcompany').validate({
        rules : {
            'comp_name' : 'required',
            'comp_desc' : 'required',
            'comp_contact_person' : 'required',
            'comp_contact_number' : {
                required : true,
                number: true
            },
            'comp_address' : 'required'
        }
    });
    $('#btnSubmitCompany').on('click',function(){
        if($('#frmcompany').valid()){
            swal({
                    title: "Save?",
                    text: "Save ba?",
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
                            'url' : BASE_URL + '/admin/submitcompany',
                            type : 'POST',
                            data : {
                                _token : $('[name="csrf_token"]').attr('content'),
                                name : $('#comp_name').val(),
                                desc : $('#comp_desc').val(),
                                cperson : $('#comp_contact_person').val(),
                                cnumber : $('#comp_contact_number').val(),
                                caddress : $('#comp_address').val()
                            },
                            success : function(response){
                                swal("Success!", "Successfully saved!", "success");
                                $('button.confirm').on('click',function(){
                                    $('#companyModal').modal('hide');
                                    location.reload();
                                });
                            },
                            error : function(xhr,me,error){
                                swal("Error!", error, "error");
                            }
                        });
                    }else{
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
        }
    });
});
function loadClientCompaniesDataTable(){
    $('#tbl_company').DataTable();
}