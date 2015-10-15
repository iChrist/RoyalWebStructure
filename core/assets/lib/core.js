// SAVE DATA //
var toastr = '';
var isValid = ''; 
function _save(url){
    if(!isValid.form()){
        return false;
    }
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData($("#_save")[0]);
        //formdata.append("custom", "valor");
    }
    $.ajax({
        type: "POST",
        url: "",
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if(data['response']){
                toastr.success(data['message'], "Notificaci&oacute;n");
                setInterval(function(){ 
                    location.assign(url); 
                }, 3000);
            }else{
                toastr.error(data['message'], "Notificaci&oacute;n");
            }
        }
    });
}

$(document).ready(function(){
    /* NOTIFICATIONS */
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "2000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
});