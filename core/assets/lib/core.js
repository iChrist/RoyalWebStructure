function _read(url){
    location.assign(url);
}

function _new(url){
    location.assign(url);
}

function _save(){
    document.getElementById('_save').submit();
}

function _delete(){
    var form = document.createElement("form");
    form.setAttribute('method',"post");
    form.setAttribute('action',"");
    var element = document.createElement("input");
    element.setAttribute('type',"text");
    element.setAttribute('name',"axn");
    element.value='_delete';
    form.appendChild(element);
    document.getElementById('_delete').appendChild(form);
    form.submit();
}

/* CHECKS IF VALUE IS INTEGER 
 * RETURN BOOLEAN
 */
String.prototype.isInteger = function () {
    if(Number.isInteger(this)){
        return true;
    }else{
        return false;
    }
}
