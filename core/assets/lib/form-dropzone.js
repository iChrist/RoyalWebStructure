var _Core_RW_Dropzone = false;
var FormDropzone = function () {

    return {
        //main function to initiate the module
        init: function (obj) {  

            Dropzone.options.myDropzone = Object.assign(obj,{
                init: function() {
                    _Core_RW_Dropzone = this;
                    _Core_RW_Dropzone.paramName = obj.paramName;
                    this.on("sending", function(file, xhr, formData) {
                        formData.append("nameeeee", "valueeeeee");
                    });
                    this.on("addedfile", function(file) {
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-danger btn-block'><i class='fa fa-trash-o'></i> Descartar</button>");
                        
                        // Capture the Dropzone instance as closure.
                        var _this = this;
                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                          // Make sure the button click doesn't submit the form:
                          e.preventDefault();
                          e.stopPropagation();

                          // Remove the file preview.
                          _this.removeFile(file);
                          // If you want to the delete the file on the server as well,
                          // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });
                }            
            })
        }
    };
}();