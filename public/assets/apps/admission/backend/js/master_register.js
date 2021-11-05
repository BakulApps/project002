var religionjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-register').DataTable({
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
            ],
            ajax: ({
                headers: csrf_token,
                url: baseurl + '/master/daftarulang',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var register_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/daftarulang',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'register',
                    'register_id': register_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#register_id').val(resp.register_id);
                    $('#register_name').val(resp.register_name)
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var register_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/daftarulang',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'register_id': register_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-register').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/daftarulang',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'register_id': $('#register_id').val(),
                    'register_name': $('#register_name').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.title-add').html('TAMBAH DATA');
                    $('#submit').val('store');
                    $('#register_id').val('')
                    $('#register_name').val('')
                    $('.datatable-register').DataTable().ajax.reload();
                }
            })
        })
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSubmit();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    religionjs.init();
});
