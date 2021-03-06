$("document").ready(function(){
    var BASE_URL = $('#baseurl').val();
    loadUserDataTable();
    $("body").delegate(".changepass","click", function(){
        var id = $(this).data("id");
        clearformpassword();
        $("#id").val($(this).data("id"));
        $("#userModal").modal("show");
    });
    $("#submitchange").on("click", function(){
        if($("#frm_password").valid()){
            swal({
                    title: "Are you sure?",
                    text: "Change Password?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, change it!",
                    cancelButtonText: "No, cancel please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        $.ajax({
                            "url" : BASE_URL + '/admin/changepass',
                            type : "post",
                            data : {
                                _token : $('[name="_token"]').val(),
                                id : $("#id").val(),
                                password : $("#newpassword").val()
                            },
                            async:false,
                            success : function(response){
                                swal("Success","Password successfully changed!","success");
                                $('button.confirm').on('click',function(){
                                    $('#userModal').modal('hide');
                                    location.reload();
                                });
                            },
                            error : function(xhr,foo,error){
                                swal("Error",error,"error");
                            }
                        });
                    } else {
                        swal("Cancelled", "Your password is safe :)", "error");
                    }
            });
        }else{

        }
    });
    $("#frm_password").validate({
        rules : {
            newpassword : {
                required : true,
                minlength : 5
            },
            cpassword : {
                minlength : 5,
                equalTo : "#newpassword"
            }
        }
    });
    $("body").delegate(".edituser","click", function(){
        var id  = $(this).data("id");
        $("#idregis").val(id);
        $("#operationregis").val(1);
        $(".account-title").html("Edit User");
        clearformpassword();
        $("#registerModal").modal("show");
        $("#password").prop('disabled', true);
        $.ajax({
            "url" : BASE_URL + "/admin/getuserdata",
            type : "post",
            data : {
                _token : $('[name="csrf_token"]').attr('content'),
                id : id
            },
            success : function(response){
                $("#firstname").val(response["firstname"]);
                $("#lastname").val(response["lastname"]);
                $("#address").val(response["address"]);
                $("#contact").val(response["contact"]);
                $("#email").val(response["email"]);
                $("#user_type").val(response["type"]);
            },
            error : function(xhr,foo,error){
                swal("Error",error,"error");
            }
        });
    });
    $("body").delegate(".deleteuser","click", function(){
        var id = $(this).data('id');
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this user!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        'url' : BASE_URL + '/admin/deleteuser',
                        type : 'post',
                        data : {
                            _token : $('[name="csrf_token"]').attr('content'),
                            id : id
                        },
                        success : function(response){
                            swal("Success!","User successfully deleted!","success");
                            $('button.confirm').on('click',function(){
                                location.reload();
                            });
                        },
                        error : function (xhr, foo , error) {
                            swal('Error!',error,'error');
                        }
                    });
                } else {
                    swal("Cancelled", "User not deleted :)", "error");
                }
            });
    });
});
function clearformpassword(){
    var form = $("#frm_password");
    form[0].reset();
    $("label.error").css("display","none");
}
function loadUserDataTable(){
    $("#tbl_users").DataTable();
}