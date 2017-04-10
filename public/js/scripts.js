$('document').ready(function(){
    var BASE_URL = $('#baseurl').val();
    var USER_TYPE = $('#auth_id').data('usertype');
    var json = {"emailsent":"0","sendattachment":"0","followupcall":"0","statementofaccount":"0","bankaccountinfo":"0","lastpaid":"0","confirm":"0"};
    var AUTH_ID = $("#auth_id").val();
    loadClientCompaniesDataTable();
    if(USER_TYPE == 1){
        $('.btnedit').prop('disabled',false);
    }
    $('#comp_date').datepicker({
        maxDate : new Date(),
        dateFormat: 'yy-mm-dd'
    });
    $('#addcompany').on('click',function(){
        clearForm();
        enableinput();
        $('#operation').val(0);
        $('#id').val('');
        $('#companyModal h4.modal-title').text('Add Client Company');
        $('#json').val(JSON.stringify(json));
        $('#companyModal').modal('show');
    });
    $('#createAccount').on('click',function(){
        $('.account-title').html("Create Account");
        $('#operationregis').val(0);
        $('#registerModal').modal('show');
    });
    $('body').delegate('.btnedit','click',function(){
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
                $('#paid').val(data['paid']);
                $('#json').val(data['state']);
                $('#comp_date').val(data['date']);
                $('#comp_email').val(data['email']);
                setState(data['state']);
            },
            error : function(xhr,asd,error){
                console.log(error);
            }
        });
    });
    $('#frmcompany').validate({
        rules : {
            'comp_name' : {required : true , minlength : 4 },
            'comp_desc' : 'required',
            'comp_contact_person' : {required : true , minlength : 4},
            'comp_contact_number' : {
                required : true,
                number: true,
                maxlength : 11,
                minlength : 4
            },
            'comp_address' : 'required',
            'comp_date' : 'required',
            'comp_email' : {
                required : true,
                email : true
            }
        }
    });
    $('#btnSubmitCompany').on('click',function(){
        if($('#frmcompany').valid()){
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
                                caddress : $('#comp_address').val(),
                                json : $("#json").val(),
                                emailsent : $('#chk_emailsent').prop('checked') ? $('#chk_emailsent').val() : '',
                                sendattachment : $('#chk_sendattachment').prop('checked') ? $('#chk_sendattachment').val() : '',
                                followupcall : $('#chk_followupcall').prop('checked') ? $('#chk_followupcall').val() : '',
                                statementofaccount : $('#chk_statementofaccount').prop('checked') ? $('#chk_statementofaccount').val() : '',
                                bankaccountinfo : $('#chk_bankaccountinfo').prop('checked') ? $('#chk_bankaccountinfo').val() : '',
                                lastpaid : $('#chk_lastpaid').prop('checked') ? $('#chk_lastpaid').val() : '',
                                paid : $('#chk_lastpaid').prop('checked') ? $('#chk_lastpaid').val() : '',
                                date : $('#comp_date').val(),
                                email : $('#comp_email').val(),
                                confirm : $('#chk_confirm').prop('checked') ? $('#chk_confirm').val() : ''
                            },
                            success : function(response){
                                console.log(response);
                                var operation = $('#operation').val();
                                var message = operation == 0 ? "saved" : "updated";
                                swal("Success!", "Successfully " +  message + "!", "success");
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
                        swal("Cancelled", "The data is safe :)", "error");
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
    $(".checkbtn").on("click",function(e){
        var chk = $(this).data("to");
        var btn = $(this).data("btn");
        var objName = chk.slice(4);
        if($("#" + chk).is(":checked")){
            $("#" + chk).prop("checked",false);
            json[objName] = "0";
        }else{
            $("#" + chk).prop("checked",true);
            json[objName] = "1";
        }
        $(this).hasClass("btn-" + btn) ? $(this).removeClass("btn-" + btn) : $(this).addClass("btn-" + btn);
        $("span." + chk).hasClass("glyphicon-check") ? $("span." + chk).removeClass("glyphicon-check") : $("span." + chk).addClass("glyphicon-check");
        // $("#json").val(JSON.stringify(json));
    });
    $("#btn_lastpaid").on("click",function(){
        // Last paid
        $("#paid").val(json.lastpaid);
    });
    $("#btnreport").on("click", function(){
        $('#start_date').datepicker({
            maxDate : new Date()
        });
        $('#end_date').datepicker();
        $('#start_date, #end_date').val('');
        $('#selectReport').removeAttr('selected').find('option:first').attr('selected', 'selected');
        $("#reportModal").modal("show");
    });
    $('#selectReport').on('change', function(){
        var selected = $(this).val();
        if(selected == 'all'){
            $('#start_date, #end_date').prop('disabled', true).val("");
            $("#filterAgent").html("");
            $("#agentInput").val("");
        }else if(selected == 'confirmnotpaid'){
            $('#start_date, #end_date').prop('disabled', true).val("");
            $("#filterAgent").html("");
            $("#agentInput").val("");
        }else if(selected == 'agent'){
            $("#filterAgent").append("<div class='col-xs-12'><div class='form-group'><label for='agentInput' class='control-label'>Filter by Agent Name:</label><input class='form-control' id='agentInput' name='agentInput'></div> </div>");
        }
        else{
            $('#start_date, #end_date').prop('disabled', false);
            $("#filterAgent").html("");
            $("#agentInput").val("");
        }
    });
    $("#btnSubmitFilter").on("click", function(e){
        var selected = $("#selectReport").val();
        if(selected == null){
            swal("Error","Please select a filter","error");
            e.preventDefault();
        }else if(selected == 'paid'){
            if($('#start_date').val() == '' || $('#end_date').val() == ''){
                swal("Error","Please complete the filter form","error");
                e.preventDefault();
            }
        }
    });
    function disableinput($agentid){
        if(AUTH_ID != $agentid){
            $("#comp_name, #comp_contact_person, #comp_contact_number, #comp_address, button.checkbtn , #comp_date , #comp_email").prop("disabled",true);
        }else{
            $("#comp_name, #comp_contact_person, #comp_contact_number, #comp_address, button.checkbtn , #comp_date , #comp_email").prop("disabled",false);
        }
    }
    function enableinput(){
        $("#comp_name, #comp_contact_person, #comp_contact_number, #comp_address").prop("disabled",false);
    }
});


function loadClientCompaniesDataTable(){
    $('#tbl_company').DataTable({
        'aoColumnDefs' : [
            { 'bSortable': false, 'aTargets': [ 4 ] },
            // { 'bSortable': false, 'aTargets': [ 8 ] },
            { 'bSortable': false, 'aTargets': [ 7 ] }
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
function setState($jsonData){
    var obj = JSON.parse($jsonData);
    $.each(obj, function(index, value){
        if(value == 1){
            var btn = $('#btn_' + index).data('btn');
            $('#btn_' + index).addClass('btn-' + btn);
            $('span.chk_' + index).addClass('glyphicon-check');
            $('input#chk_' + index).prop('checked',true);
        }else{

        }
    });
}
