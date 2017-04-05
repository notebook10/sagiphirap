$('document').ready(function(){
    var BASE_URL = $('#baseurl').val();
    $('#btnRsubmit').on('click', function(){
        var operationregis = $("#operationregis").val();
        if($('#frm_register').valid()){
            swal({
                    title: "Are you sure?",
                    text: "Save this as new user?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, save it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            "url" : BASE_URL + '/admin/insertuser',
                            type : 'post',
                            data : {
                                _token : $('[name="_token"]').val(),
                                idregis : $("#idregis").val(), // id if Edit : no id if add
                                firstname : $("#firstname").val(),
                                lastname : $("#lastname").val(),
                                email : $("#email").val(),
                                contact : $("#contact").val(),
                                address : $("#address").val(),
                                user_type : $("#user_type").val(),
                                password : $("#password").val(),
                                operation : operationregis
                            },
                            success : function(data){
                                var message = operationregis == 1 ? "Updated" : "Saved";
                                swal("Success!", "Successfully " + message + "!", "success");
                                $('button.confirm').on('click',function(){
                                    $('#registerModal').modal('hide');
                                    location.reload();
                                });
                            }
                        });
                    } else {
                        swal("Cancelled", "Not saved", "error");
                    }
                });
        }else{
            // alert('invalid');
            console.log('form invalid');
        }
    });
    $('#frm_register').validate({
        rules : {
            'firstname' : 'required',
            'lastname' : 'required',
            'contact' : {
                number: true,
                required : true
            },
            'address' : 'required',
            'email' : 'required',
            'password' : 'required',
            'confpassword' : {
                equalTo : '#password'
            }
        }
    });
    $('.close_modal').on('click',function(){
        clearFormRegister();
    });
    $(".modal").on("hidden.bs.modal", function () {
        clearFormRegister();
    });
});
function clearFormRegister(){
    $('label.error').css('display','none');
    var form = $('.clear_form');
    form[0].reset();
}