@section('script')

<script src="{{asset('plugins/moment//moment.js')}}"></script>

<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.0/fc-4.2.2/r-2.4.1/sc-2.1.1/datatables.min.js"></script>


<script>
$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var tabla_ajax =  $('#tabla_lista').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        // ajax: "venta_lista_ajax",
        ajax: {
            "url": "lista_sender_request_ajax",
            "data": function (d) {
                    // d.tipo_comprobante_id = $("#tipo-comprobante").val()
            },
        },
        "language": {
            "lengthMenu": "Mostrando _MENU_ ficheros por página",
            "zeroRecords": "No se encontraron ficheros",
            "info": "Mostrando páginas del _PAGE_ al _PAGES_",
            "infoEmpty": "No hay ficheros disponibles",
            "infoFiltered": "(Filtrado de un total _MAX_ de ficheros)",
            "search": "Buscar",
            "prev": "Anterior",
            "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": ">",
                "previous": "<"
            },
        },
        order: [[ 1, "desc" ]],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csvHtml5',
                title: 'Sender Request',
                exportOptions: {
                    columns: [0, 1, 2],
                },
                action: exportAllDataTable
            },
            {
                extend: 'excelHtml5',
                title: 'Sender Request',
                exportOptions: {
                    columns: [0, 1, 2],
                },
                action: exportAllDataTable
            },
            {
                extend: 'pdf',
                title: 'Sender Request',
                exportOptions: {
                    columns: [0, 1, 2],
                },
                action: exportAllDataTable
            },
            {
                extend: 'print',
                title: 'Sender Request',
                exportOptions: {
                    columns: [0, 1, 2],
                },
                action: exportAllDataTable
            },
        ],
        columns: [
            { data: 'sender_serial' },
            {   
                data: 'created_at',
                render: function( data, type, row ) {
                    return (data == null)? "" : moment(data).format("DD/MM/YY  hh:mm:ss");
                }
            },
            { data: 'sr_content_request' },
        ],
        "drawCallback": function( settings ) {
            feather.replace();
        }
    });

    function exportAllDataTable(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        $(".preloader").show();
        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = -1;
            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);
                // Prevent rendering of the full data to the DOM
                $(".preloader").hide();
                return false;
            });
        });
        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    }

    $("body").on("click", ".btn-actualizar", function () {
        tabla_ajax.ajax.reload();
    });

});

</script>

@endsection
