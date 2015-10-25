var TableAjax = function () {

    var initPickers = function () {
        //init date pickers
        /*$('.date-picker').datepicker({
            autoclose: true
        });*/
    }

    var handleRecords = function (url) {

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 
                "language": { // language settings
                    // metronic spesific
                    "customGroupActions": "_TOTAL_ records selected:  ",
                    "customAjaxRequestGeneralError": "Could not complete request. Please check your internet connection",

                    // data tables spesific
                    "lengthMenu": "<span class='seperator'>|</span>Ver _MENU_ registros",
                    "info": "<span class='seperator'>|</span>Total _TOTAL_ registros",
                    "infoEmpty": "No hay registros para mostrar",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "last": "&Uacute;ltimo",
                        "first": "Primero",
                        "page": "P&aacute;gina",
                        "pageOf": "de"
                    }
                },
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": url, // ajax source
                },
                "order": [
                    [1, "asc"]
                ] // set first column as a default sort by asc
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
    }

    return {

        //main function to initiate the module
        init: function (url) {

            initPickers();
            handleRecords(url);
        }

    };

}();