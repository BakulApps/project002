var mainmenujs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componetnDataTable = function () {
        $('.datatable-mainmenu').DataTable({
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
                {className: 'text-center', targets: 4}
            ],
            ajax: ({
                headers: csrf_token,
                url: baseurl + '/mainmenu',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e){
            e.preventDefault();
            var menu_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/mainmenu',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'menu',
                    'menu_id': menu_id,
                },
                success : function (resp) {
                    $('#menu_id').val(resp.menu_id);
                    $('#menu_name').val(resp.menu_name);
                    $('#menu_parent').append('<option value="'+resp.menu_parent+'" selected>'+resp.menu_name+'</option>');
                    $('#menu_link').val(resp.menu_link);
                    $('.title').html('Ubah Mainmenu');
                    $('#submit').val('update');
                    $('#modal-mainmenu').modal('show');

                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var menu_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/mainmenu',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'menu_id': menu_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-mainmenu').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/mainmenu',
                type: 'post',
                dataType: 'json',
                data: {
                    _type: $('#submit').val(),
                    menu_id: $('#menu_id').val(),
                    menu_parent: $('#menu_parent').val(),
                    menu_name: $('#menu_name').val(),
                    menu_link: $('#menu_link').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('#menu_id').val('');
                    $('#menu_parent').val('');
                    $('#menu_name').val('');
                    $('#user_role').val('');
                    $('#menu_link').val('');
                    $('#submit').val('store');
                    $('.title').html('Tambah Pengguna');
                    $('#modal-mainmenu').modal('hide');
                    $('.datatable-mainmenu').DataTable().ajax.reload();
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
        $('.select').select2({
            minimumResultsForSearch: Infinity,
        })

        $('.select-parent').select2({
            minimumResultsForSearch: Infinity,
            ajax: {
                headers: csrf_token,
                url: baseurl + '/mainmenu',
                dataType: 'json',
                type: 'post',
                data: {
                    _type: 'data',
                    _data: 'parent'
                },
                processResults: function (data) {
                    return {
                        results: data
                    }
                },
                cache: true
            },
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
    mainmenujs.init();
});
