$('document').ready(function(){
    var BASE_URL = $('#baseurl').val();
    var USER_TYPE = $('#auth_id').data('usertype');
    var json = {"emailsent":"","sendattachment":"","followupcall":"","statementofaccount":"","bankaccountinfo":"","lastpaid":""};
    var AUTH_ID = $("#auth_id").val();
    console.log(json);
    loadClientCompaniesDataTable();
    if(USER_TYPE == 1){
        $('.btnedit').prop('disabled',false);
    }
    $('#addcompany').on('click',function(){
        clearForm();
        enableinput();
        $('#operation').val(0);
        $('#id').val('');
        $('#companyModal h4.modal-title').text('Add Client Company');
        $('#companyModal').modal('show');
    });
    $('#createAccount').on('click',function(){
        $('#registerModal').modal('show');
    });
    $('.btnedit').on('click',function(){
        clearForm();
        $('#id').val($(this).data('id'));
        var id = $('#id').val();
        $('#operation').val(1);
        $('#companyModal h4.modal-title').text('Edit Client Company');
        $.ajax({
            'url' : BASE_URL + '/admin/getcompanydata',
            type : 'POST',
            data : {
                _token : $('[name="csrf_token"]').attr('content'),
                id : id
            },
            success : function(data){
                var agentid = data['agent_id'];
                disableinput(agentid);
                $('h4.modal-title').text(data['name']);
                $('#companyModal').modal('show');
                $('#comp_name').val(data['name']);
                $('#comp_desc').val(data['desc']);
                $('#comp_contact_person').val(data['cperson']);
                $('#comp_contact_number').val(data['cnumber']);
                $('#comp_address').val(data['caddress']);
            },
            error : function(xhr,asd,error){
                console.log(error);
            }
        });
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
                            'url' : BASE_URL + '/admin/submitcompany',
                            type : 'POST',
                            data : {
                                _token : $('[name="csrf_token"]').attr('content'),
                                operation : $('#operation').val(),
                                id : $('#id').val(),
                                name : $('#comp_name').val(),
                                desc : $('#comp_desc').val(),
                                cperson : $('#comp_contact_person').val(),
                                cnumber : $('#comp_contact_number').val(),
                                caddress : $('#comp_address').val()
                            },
                            success : function(response){
                                console.log(response);
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
    $('.close_modal').on('click',function(){
        clearForm();
    });
    $(".modal").on("hidden.bs.modal", function () {
       clearForm();
    });
    $(".checkbtn").on("click",function(){
        var chk = $(this).data("to");
        var btn = $(this).data("btn");
        var objName = chk.slice(4);
        if($("#" + chk).is(":checked")){
            $("#" + chk).prop("checked",false);
            json[objName] = "";
            console.log(json);
        }else{
            $("#" + chk).prop("checked",true);
            json[objName] = "1";
            console.log(json);
        }
        $(this).hasClass("btn-" + btn) ? $(this).removeClass("btn-" + btn) : $(this).addClass("btn-" + btn);
        $("span." + chk).hasClass("glyphicon-check") ? $("span." + chk).removeClass("glyphicon-check") : $("span." + chk).addClass("glyphicon-check");
        $("#json").val(JSON.stringify(json));
    });
    function disableinput($agentid){
        if(AUTH_ID != $agentid){
            $("#comp_name, #comp_contact_person, #comp_contact_number, #comp_address").prop("disabled",true);
        }else{
            $("#comp_name, #comp_contact_person, #comp_contact_number, #comp_address").prop("disabled",false);
        }
    }
    function enableinput(){
        $("#comp_name, #comp_contact_person, #comp_contact_number, #comp_address").prop("disabled",false);
    }
});


function loadClientCompaniesDataTable(){
    $('#tbl_company').DataTable({
        'aoColumnDefs' : [
            { 'bSortable': false, 'aTargets': [ 3 ] },
            { 'bSortable': false, 'aTargets': [ 4 ] },
            { 'bSortable': false, 'aTargets': [ 5 ] }
        ]
    });
}
function clearForm(){
    $('label.error').css('display','none');
    var form = $('.clear_form');
    form[0].reset();
    $("span.glyphicon-check").removeClass("glyphicon-check");
    $(".btn.checkbtn").removeClass("btn-success")
        .removeClass("btn-primary")
        .removeClass("btn-info")
        .removeClass("btn-warning")
        .removeClass("btn-danger")
        .removeClass("btn-default");
}