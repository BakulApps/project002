var religionjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-religion').DataTable({
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
                url: baseurl + '/master/agama',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var religion_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/agama',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'religion',
                    'religion_id': religion_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#religion_id').val(resp.religion_id);
                    $('#religion_name').val(resp.religion_name).change();
                    $('#class_major').val(resp.class_major).change();
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var religion_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/agama',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'religion_id': religion_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-religion').DataTable().ajax.reload();
                }
            });
        })
    }


    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/agama',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'religion_id': $('#religion_id').val(),
                    'religion_name': $('#religion_name').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.title-add').html('TAMBAH DATA');
                    $('#submit').val('store');
                    $('#religion_id').val('')
                    $('#religion_name').val('')
                    $('.datatable-religion').DataTable().ajax.reload();
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
