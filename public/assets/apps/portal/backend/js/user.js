var userjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componetnDataTable = function () {
        $('.datatable-user').DataTable({
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
                {className: 'text-center', targets: 5},
                {className: 'text-center', targets: 6},
            ],
            ajax: ({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: baseurl + '/pengguna',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e){
            e.preventDefault();
            var user_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/pengguna',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'user',
                    'user_id': user_id,
                },
                success : function (resp) {
                    $('#user_id').val(resp.user_id);
                    $('#user_fullname').val(resp.user_fullname);
                    $('#user_name').val(resp.user_name);
                    $('#user_email').val(resp.user_email);
                    $('#user_role').val(resp.user_role).change();
                    $('#user_facebook').val(resp.user_facebook);
                    $('#user_instagram').val(resp.user_instagram);
                    $('#user_twitter').val(resp.user_twitter);
                    $('#user_desc').html(resp.user_desc);
                    $('.title').html('Ubah Pengguna');
                    $('#submit').val('update');
                    $('#modal-user').modal('show');

                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var user_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/pengguna',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'user_id': user_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-user').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/pengguna',
                type: 'post',
                dataType: 'json',
                data: {
                    _type: $('#submit').val(),
                    user_id: $('#user_id').val(),
                    user_fullname: $('#user_fullname').val(),
                    user_name: $('#user_name').val(),
                    user_pass: $('#user_pass').val(),
                    user_email: $('#user_email').val(),
                    user_role: $('#user_role').val(),
                    user_facebook: $('#user_facebook').val(),
                    user_instagram: $('#user_instagram').val(),
                    user_twitter: $('#user_twitter').val(),
                    user_desc: $('#user_desc').val()
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('#user_id').val();
                    $('#user_fullname').val();
                    $('#user_name').val();
                    $('#user_email').val();
                    $('#user_role').val();
                    $('#user_facebook').val();
                    $('#user_instagram').val();
                    $('#user_twitter').val();
                    $('#user_desc').val('');
                    $('#submit').val('store');
                    $('.title').html('Tambah Pengguna');
                    $('#modal-user').modal('hide');
                    $('.datatable-user').DataTable().ajax.reload();
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
    userjs.init();
});
