// SAVE DATA //
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
    
});