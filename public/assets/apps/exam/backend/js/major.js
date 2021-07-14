var majorjs = function () {
    var _componetnDataTable = function () {
        $('.datatable-major').DataTable({
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
                {className: 'text-center', targets: 3}
            ],
            ajax: ({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: adminurl + '/data/jurusan',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var major_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/data/jurusan',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'major',
                    'major_id': major_id,
                },
                success : function (resp) {
                    $('#form-title').html('UBAH JURUSAN');
                    $('#submit').val('update');
                    $('#major_id').val(resp.major_id);
                    $('#major_code').val(resp.major_code);
                    $('#major_name').val(resp.major_name);
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var major_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/data/jurusan',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'major_id': major_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-major').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/data/jurusan',
                type: 'post',
                dataType: 'json',

                data: {
                    _type: $('#submit').val(),
                    major_id: $('#major_id').val(),
                    major_code: $('#major_code').val(),
                    major_name: $('#major_name').val()
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('#submit').val('store');
                    $('#major_code').val('');
                    $('#major_name').val('');
                    $('.datatable-major').DataTable().ajax.reload();
                }
            })
        })
    }

    var _componentSelect2 = function() {
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
    majorjs.init();
});
