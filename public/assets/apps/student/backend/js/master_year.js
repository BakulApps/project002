var yearjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-year').DataTable({
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: true,
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                emptyTable: 'Tak ada data yang tersedia pada tabel ini',
                loadingRecords: '<i class="icon-spinner4 spinner"></i> Memuat data...',
                info: 'Menampilkan _START_ Sampai _END_ Total _TOTAL_ Entri',
                search: '_INPUT_',
                binfo: false,
                orderable: false,
                searchPlaceholder: 'Pencarian...',
                lengthMenu: '<span>Tampilkan:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') === 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') === 'rtl' ? '&rarr;' : '&larr;' }
            },
            columnDefs : [
                {className: 'text-center', targets: 0},
                {className: 'text-center', targets: 1},
                {className: 'text-center', targets: 2},
                {className: 'text-center', targets: 3},
                {className: 'text-center', targets: 4},
            ],
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/master/tahun',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var year_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/tahun',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'year',
                    'year_id': year_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#year_id').val(resp.year_id)
                    $('#year_number').val(resp.year_number);
                    $('#year_name').val(resp.year_name);
                    $('#year_desc').val(resp.year_desc);
                    $('#year_active').val(resp.year_active);
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var year_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/tahun',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'year_id': year_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-year').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSelect = function () {
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
        $('.select').select2({
            minimumResultsForSearch: Infinity
        });
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/tahun',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'year_id': $('#year_id').val(),
                    'year_number': $('#year_number').val(),
                    'year_name': $('#year_name').val(),
                    'year_desc': $('#year_desc').val(),
                    'year_active': $('#year_active').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.title-add').html('TAMBAH DATA');
                    $('#submit').val('store');
                    $('#year_id').val('')
                    $('#year_number').val('')
                    $('#year_code').val('')
                    $('#year_name').val('');
                    $('#year_desc').val('');
                    $('#year_active').val('');
                    $('.datatable-year').DataTable().ajax.reload();
                }
            })
        })
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentSubmit();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    yearjs.init();
});
