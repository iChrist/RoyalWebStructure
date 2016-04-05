// SAVE DATA //
var toastr = '';
var isValid = ''; 
function _save(obj,url){
    obj.disabled = true;
    if(!isValid.form()){
        obj.disabled = false;
        return false;
    }
    $('.alert-danger').hide();
    $('.alert-success').show();
    $('.page-title-loading').css('display','inline');
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
                _location = setInterval(function(){
                    location.assign(url);
                    clearInterval(_location);
                }, 3000);
            }else{
                toastr.error(data['message'], "Notificaci&oacute;n");
                setInterval(function(){ 
                    obj.disabled = false;
                }, 3000);
            }
            $('.page-title-loading').css('display','none');
        }
    });
}
// DELETE DATA //
var _deleteConfirmUrl = null;
function _delete(obj,url){
    _deleteConfirmUrl = url;
    var tr = $(obj).parent().parent().parent().parent().parent().clone();
    $(tr[0]).children().last().remove();
    var thead = $("#datatable_ajax").children().children().clone();
    $(thead[0]).children().last().remove();
    $("#_deleteModalRecord").html('<table class="table"><thead><tr role="row" class="heading">'+thead[0].innerHTML+'</tr></thead><tr>'+tr[0].innerHTML+'</tr></table>');
    $("#_deleteModal").modal('toggle');
    return false;
}
function _deleteConfirm(){
    $("#_deleteModal").modal('hide');
    $('.page-title-loading').css('display','inline');
    $.ajax({
        type: "GET",
        url: _deleteConfirmUrl,
        data: "",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if(data['response']){
                toastr.success(data['message'], "Notificaci&oacute;n");
                setInterval(function(){ 
                     location.reload(); 
                }, 3000);
            }else{
                toastr.error(data['message'], "Notificaci&oacute;n");
                setInterval(function(){ 
                }, 3000);
            }
            $('.page-title-loading').css('display','none');
            _deleteConfirmUrl = null;
        }
    });
}
function _deleteCancel(){
    _deleteConfirmUrl = null;
}
// EXPORTAR A EXCEL index //
function _exportExcel(){
    $("#_formTableAjax").append('<input type="hidden" name="exportExcel" value="1" /> ');
    return true;
}
// EXPORTAR A PDF index //
function _exportPdf(){
    $("#_formTableAjax").append('<input type="hidden" name="exportPdf" value="1" /> ');
    return true;
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