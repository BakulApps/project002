var classjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
    var _componetnDataTable = function () {
        $('.datatable-class').DataTable({
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: false,
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
                {className: 'text-center', targets: 5}
            ],
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/data/kelas',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var class_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/data/kelas',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'class',
                    'class_id': class_id,
                },
                success : function (resp) {
                    $('#form-title').html('UBAH KELAS');
                    $('#submit').val('update');
                    $('#class_id').val(resp.class_id);
                    $('#class_level').val(resp.class_level);
                    $('#class_major').val(resp.class_major);
                    $('#class_code').val(resp.class_code);
                    $('#class_name').val(resp.class_name);
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var class_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/data/kelas',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'class_id': class_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-class').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/data/kelas',
                type: 'post',
                dataType: 'json',
                data: {
                    _type: $('#submit').val(),
                    class_id: $('#class_id').val(),
                    class_level: $('#class_level').val(),
                    class_major: $('#class_major').val(),
                    class_code: $('#class_code').val(),
                    class_name: $('#class_name').val()
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('#submit').val('store');
                    $('#class_id').val('');
                    $('#class_level').val('');
                    $('#class_major').val('');
                    $('#class_code').val('');
                    $('#class_name').val('');
                    $('.datatable-class').DataTable().ajax.reload();
                }
            })
        })
    }

    var _componentSelect2 = function() {
        $('#class_level').select2({
            ajax: {
                headers: csrf_token,
                url: adminurl + '/data/tingkat',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'level'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });

        $('#class_major').select2({
            ajax: {
                headers: csrf_token,
                url: adminurl + '/data/jurusan',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'major'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });

        $('.dataTables_length  select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
    };


    return {
        init: function() {
            _componetnDataTable();
            _componentSubmit();
            _componentSelect2();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    classjs.init();
});
