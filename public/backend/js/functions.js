$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
if ($('.recordTable').length > 0) {
    $.fn.dataTableExt.oApi.fnStandingRedraw = function(oSettings) {
        //redraw to account for filtering and sorting
        // concept here is that (for client side) there is a row got inserted at the end (for an add)
        // or when a record was modified it could be in the middle of the table
        // that is probably not supposed to be there - due to filtering / sorting
        // so we need to re process filtering and sorting
        // BUT - if it is server side - then this should be handled by the server - so skip this step
        if(oSettings.oFeatures.bServerSide === false){
            var before = oSettings._iDisplayStart;
            oSettings.oApi._fnReDraw(oSettings);
            //iDisplayStart has been reset to zero - so lets change it back
            oSettings._iDisplayStart = before;
            oSettings.oApi._fnCalculateEnd(oSettings);
        }
        //draw the 'current' page
        oSettings.oApi._fnDraw(oSettings);
    };
    $.fn.dataTableExt.oApi.fnSetFilteringDelay = function ( oSettings, iDelay ) {
        var _that = this;
        if ( iDelay === undefined ) {
            iDelay = 250;
        }
        this.each( function ( i ) {
            if ( typeof _that.fnSettings().aanFeatures.f !== 'undefined' )
            {
                $.fn.dataTableExt.iApiIndex = i;
                var
                    oTimerId = null,
                    sPreviousSearch = null,
                    anControl = $( 'input', _that.fnSettings().aanFeatures.f );
                anControl.unbind( 'keyup search input' ).bind( 'keyup search input', function() {
                    if (sPreviousSearch === null || sPreviousSearch != anControl.val()) {
                        window.clearTimeout(oTimerId);
                        sPreviousSearch = anControl.val();
                        oTimerId = window.setTimeout(function() {
                            $.fn.dataTableExt.iApiIndex = i;
                            _that.fnFilter( anControl.val() );
                        }, iDelay);
                    }
                });
                return this;
            }
        } );
        return this;
    };
}
var isJson = function(item) {
    item = typeof item !== "string"
        ? JSON.stringify(item)
        : item;

    try {
        item = JSON.parse(item);
    } catch (e) {
        return false;
    }

    if (typeof item === "object" && item !== null) {
        return true;
    }

    return false;
}
var GetQueryStringParams = function(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}
var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();
var scrollToPosition = function (elem) {
    $('html, body').stop().animate({
        'scrollTop': elem.offset().top - 100
    }, 500, 'swing', function () {
        //window.location.hash = target;

    });
}
var showNotification = function(n_message, n_allow_dismiss, n_show_progress_bar, n_type, n_timer, n_redirect_url, n_redirect_time){
    $.notify(n_message, {
        allow_dismiss:n_allow_dismiss,
        showProgressbar: n_show_progress_bar,
        type: n_type,
        timer:n_timer,
        placement: {
            from: "top",
            align: "right"
        },
        animate: {
            enter: "animated fadeInDown",
            exit: "animated fadeOutUp"
        }
    });
    if (n_redirect_url != "") {
        setTimeout(function () {
            window.location = n_redirect_url;
        }, n_redirect_time);
    }
}
var RemoveCharacter = function(output,limit){
    return output.substr(0, output.length-limit);
}
var convertNumberToWords = function(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    if(parseFloat(amount) > 0){
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
    }else{
        words_string = "Zero";
    }

    return words_string;
}
//Nestable Update Field
var updateOutput = function(e) {
    var list   = e.length ? e : $(e.target);
    if ((list.attr("id") == "nestable_single_depth_list") || (list.attr("id") == "nestable_property_document_depth_list")) {
        var output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            //output.html('JSON browser support required for this demo.');
        }
    }
}
// Enable/Disable Form Button Attributes
var EnableDisableButton = function (area,form_name,object_type,button_name,button_text,button_icon_class_name) {
    var button_context = $("#" + button_name);
    var main_context = $("#" + form_name);
    if(area != ""){
        main_context = $(area);
    }
    if (object_type == "Disable") {
        button_context.html('<i class="fa fa-spinner fa-spin"></i> ' + button_text);
        main_context.find("button,input[type='checkbox'],input[type='radio'],select").each(function(){
            $(this).attr("disabled", "disabled");
        });
        main_context.find("input[type='text'],input[type='password'],textarea").each(function(){
            $(this).attr("readonly", "readonly");
        });
        main_context.find("a").each(function(){
            $(this).addClass("disabled");
        });
        if ($(".page-tinymce").length > 0) {
            tinymce.activeEditor.setMode('readonly');
        }
    } else {
        main_context.find("input[type='text'],input[type='password'],textarea").each(function(){
            $(this).removeAttr("readonly");
        });
        main_context.find("a").each(function(){
            $(this).removeClass("disabled");
        });
        main_context.find("button,input[type='checkbox'],input[type='radio'],select").each(function(){
            $(this).removeAttr("disabled");
        });
        if(button_icon_class_name != ""){
            button_text = '<i class="' + button_icon_class_name + '"></i> ' + button_text;
        }
        if ($(".page-tinymce").length > 0) {
            tinymce.activeEditor.setMode('design');
        }
        button_context.html(button_text);
    }
}
// Ajax Submit Code
var AjaxFormSubmit = function(area,form_name,button_name,button_text,button_icon_class_name){
    var options = {
        complete: function(response) {
            console.log(response);
            $(".msg-field").remove();
            var data = JSON.parse(response.responseText);
            console.log(data);
            if (data.Success == true) {
                if (data.Type == "T") {
                    window.location = data.TargetURL;
                } else if (data.Type == "R") {
                    EnableDisableButton(area,form_name,"Enabled",button_name,button_text,button_icon_class_name);
                    $("#" + form_name)[0].reset();
                } else if (data.Type == "F") {

                } else if (data.Type == "M") {
                    showNotification(data.Message, false, true, "success", 1000, "", "");
                } else if (data.Type == "M-T") {
                    showNotification(data.Message, false, true, "success", 1000, data.TargetURL, 2000);
                } else if (data.Type == "M-R") {
                    showNotification(data.Message, false, true, "success", 1000, "", "");
                    EnableDisableButton(area,form_name,"Enabled",button_name,button_text,button_icon_class_name);
                    $("#" + form_name)[0].reset();
                } else if (data.Type == "M-R-T") {
                    showNotification(data.Message, false, true, "success", 1000, data.TargetURL, 2000);
                    EnableDisableButton(area,form_name,"Enabled",button_name,button_text,button_icon_class_name);
                    $("#" + form_name)[0].reset();
                }
            } else {
                if (data.Type == "M") {
                    showNotification(data.Message, false, true, "danger", 1000, "", "");
                } else if (data.Type == "F") {
                    var field_context = $('#' + data.FieldName);
                    field_context.addClass("error");
                    var error_span = $('<span>').attr("for", data.FieldName).addClass("error msg-field").html(data.Message);
                    if(field_context.hasClass("select2-picker")){
                        error_span.insertAfter(field_context.next());
                    }else{
                        error_span.insertAfter(field_context);
                    }
                    //error_span.insertAfter(field_context);
                    scrollToPosition(field_context);
                    //setTimeout(function () {
                    //    error_span.remove();
                    //    field_context.removeClass("error");
                    //}, 5000);
                }
                EnableDisableButton(area,form_name,"Enabled",button_name,button_text,button_icon_class_name);
            }
        },
        error: function(response) {
            console.log(response);
            showNotification(data, false, true, "danger", 1000, "", "");
            EnableDisableButton(area,form_name,"Enabled",button_name,button_text,button_icon_class_name);
        }
    };
    $("#" + form_name).ajaxSubmit(options);
    EnableDisableButton(area,form_name,"Disable",button_name,button_text,button_icon_class_name);
}
//Remove Record
$(document).on("click",".remove-row",function(e){
    var current_context = $(this);
    swal({
        title: "Delete?",
        text: "Are you sure you want to delete?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        var oTable = $('.recordTable').dataTable();
        $.ajax({
            type: "POST",
            url: current_context.attr("href"),
            data: "id=" + current_context.attr("data-id"),
            success: function(response)
            {
                var data = response;
                if(data.Success == undefined){
                    data = JSON.parse(response);
                }
                if(data.Success == true){
                    if(data.Type == "M"){
                        swal({
                            title: "Delete?",
                            text: "Record Deleted Successfully",
                            type: "success",
                        });
                        oTable.fnStandingRedraw();
                    }else{
                        window.location = data.TargetURL;
                    }
                }else{
                    swal({
                        title: "Delete?",
                        text: data.Message,
                        type: "info",
                    });
                }
            },
            error:function(data){
                swal({
                    title: "Delete?",
                    text: data,
                    type: "warning",
                });
            }
        });
    });
    return false;
});
$(document).on("click", "#print_button", function(){
    $('.page-body').printThis({
        importCSS: true,
        importStyle: true
    });
    return false;
});
//Document Ready Start
$(document).ready(function() {
    if ($('.only-number').length > 0) {
        $('.only-number').keypress(function (event) {
            if (event.charCode != 0) {
                var regex = new RegExp("^[0-9]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                var enter = (!event.charCode ? event.which : event.charCode);
                if ((!regex.test(key)) && (enter != 13)) {
                    event.preventDefault();
                    return false;
                }
            }
        });
    }





    if ($('.not-zero').length > 0) {
        $('.not-zero').keyup(function(){
            var value = $(this).val();
            if (value.indexOf('0') == 0) {
                $(this).val(1);
            }
        });
        $('.not-zero').focusout(function(){
            var value = $(this).val();
            if(value == ""){
                $(this).val(1);
            }
        });
    }
    if($(".select2-picker").length > 0){
        $(".select2-picker").select2();
    }
    if ($(".auto-numeric").length > 0) {
        $('.auto-numeric').autoNumeric('init');
    }
    if($('.date-picker').length > 0){
        $('.date-picker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
            clearBtn:true
        });
    }
    if ($(".date-time-picker").length > 0) {
        $('.date-time-picker').datetimepicker({
            useCurrent: false,
            format: 'YYYY/MM/DD'
        });
    }
    if ($(".landline-number").length > 0) {
        $(".landline-number").inputmask("999-99999999",{ "placeholder": "***-********" });  //static mask
    }
    if ($(".mobile-number").length > 0) {
        $(".mobile-number").inputmask("9999-9999999",{ "placeholder": "****-*******" });  //static mask
    }
    if ($(".nic-number").length > 0) {
        $(".nic-number").inputmask("99999-9999999-9",{ "placeholder": "*****-*******-*" });  //static mask
    }
    if ($(".number").length > 0) {
        $(".number").inputmask("999");  //static mask
    }
    // Nestable Code
    if ($('#nestable_single_depth_list').length > 0) {
        $('#nestable_single_depth_list').nestable({
            group: 1,
            maxDepth: 1
        }).on('change', updateOutput);
        // output initial serialised data
        updateOutput($('#nestable_single_depth_list').data('output', $('#assigned_output')));
    }
    //Login Form
    if($("#frm_login").length > 0){
        $('#frm_login').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: "",
            rules: {
                email_address: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email_address: {
                    required: "Required",
                    email: "Invalid email address"
                },
                password: {
                    required: "Required"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_login","btn_login_submit","Login","");
                return false; // required to block normal submit since you used ajax
            }
        });
    }
    //Forgot Form
    if($("#frm_forgot_password").length > 0){
        $('#frm_forgot_password').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: "",
            rules: {
                email_address: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email_address: {
                    required: "Required",
                    email: "Invalid email address"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_forgot_password","btn_forgot_submit","Send","");
                return false; // required to block normal submit since you used ajax
            }
        });
    }
    //Reset Form
    if($("#frm_reset_password").length > 0){
        $('#frm_reset_password').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: "",
            rules: {
                password: {
                    required: true
                },
                confirm_password: {
                    required: true,
                    equalTo:'#password'
                }
            },
            messages: {
                password: {
                    required: "Required"
                },
                confirm_password: {
                    required: "Required",
                    equalTo:'Password Mismatched'
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_reset_password","msg_box","btn_reset_password_submit","Reset","fa fa-unlock");
                return false; // required to block normal submit since you used ajax
            }
        });
    }
    //Profile Form
    if($("#frm_profile").length > 0){
        $('#frm_profile').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: "",
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email_address: {
                    required: true,
                    email: true
                }
            },
            messages: {
                first_name: {
                    required: "Required"
                },
                last_name: {
                    required: "Required"
                },
                email_address: {
                    required: "Required",
                    email: "Invalid email address"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_profile","btn_submit","Update","");
                return false; // required to block normal submit since you used ajax
            }
        });
    }
    //Role Form
    if($("#frm_role").length > 0){
        $('#frm_role').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: [],
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Required"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_role","btn_submit","Save","");
                return false; // required to block normal submit since you used ajax
            }
        });
    }
    //User Form
    if($("#frm_user").length > 0){
        $('#frm_user').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: "",
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                role: {
                    required: true
                },
                email_address: {
                    required: true,
                    email: true
                },
                u_password: {
                    required: function(){
                        if($("#record_id").val() == ""){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }
            },
            messages: {
                first_name: {
                    required: "Required"
                },
                last_name: {
                    required: "Required"
                },
                role: {
                    required: "Required"
                },
                email_address: {
                    required: "Required",
                    email: "Invalid email address"
                },
                u_password: {
                    required: "Required"
                }
            },
            errorPlacement: function(error, element) {
                if(element.hasClass("select2-picker")){
                    error.insertAfter(element.next());
                }else{
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_user","btn_submit","Save","");
                return false; // required to block normal submit since you used ajax
            }
        });
    }
    //Announcement Form
    if($("#frm_announcement").length > 0){
        $('#frm_announcement').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: "",
            rules: {
                title: {
                    required: true
                },
                content: {
                    required: true
                },
                user: {
                    required: function(){
                        if($("#user").length > 0){
                            return true;
                        }else{
                            return false;
                        }
                    }
                }
            },
            messages: {
                title: {
                    required: "Required"
                },
                content: {
                    required: "Required"
                },
                user: {
                    required: "Required"
                }
            },
            errorPlacement: function(error, element) {
                if(element.hasClass("select2-picker")){
                    error.insertAfter(element.next());
                }else{
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_announcement","btn_submit","Save","");
                return false; // required to block normal submit since you used ajax
            }
        });
    }
    //Section Form
    if($("#frm_section").length > 0){
        $('#frm_section').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: [],
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Required"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_section","btn_submit","Save","");
                return false; // required to block normal submit since you used ajax
            }
        });
    }
    //Sitting Type Form
    if($("#frm_sitting_type").length > 0){
        $('#frm_sitting_type').validate({
            errorElement: 'span',
            errorClass: 'error',
            focusInvalid: true,
            ignore: [],
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Required"
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                AjaxFormSubmit("","frm_sitting_type","btn_submit","Save","");
                return false; // required to block normal submit since you used ajax
            }
        });
    }

});

function searchTable(inputID, tableID) {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById(inputID);
    filter = input.value.toUpperCase();
    table = document.getElementById(tableID);
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (tdIndex = 0; tdIndex < td.length; tdIndex++) {
            if (td[tdIndex]) {
                txtValue = td.textContent || td[tdIndex].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }

            tr[i].style.display = "none";
        }
    }
}

function formatCurrency(number, currency = 'PKR')
{
    formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency,
    })

    return formatter.format(number);
}

function onlyNumber(event)
{
    if (event.charCode != 0) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        var enter = (!event.charCode ? event.which : event.charCode);
        if ((!regex.test(key)) && (enter != 13)) {
            event.preventDefault();
            return false;
        }
    }
}
