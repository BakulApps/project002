var userjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componetnDataTable = function () {
        $('.datatable-slider').DataTable({
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
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: baseurl + '/halaman/slider',
                type: 'get',
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
            var slider_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/halaman/slider',
                type: 'delete',
                dataType: 'json',
                data: {
                    'slider_id': slider_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-slider').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $('#submit').click(function () {
            var fd      = new FormData();
            var files   = $('#slider_image')[0].files[0];

            if (files !== undefined){

                fd.append('slider_image', files);
            }
            fd.append('slider_id', $('#slider_id').val());
            fd.append('slider_title', $('#slider_title').val());
            fd.append('slider_content', $('#slider_content').val());
            fd.append('slider_button_link_1', $('#slider_button_link_1').val());
            fd.append('slider_button_name_1', $('#slider_button_name_1').val());
            fd.append('slider_button_link_2', $('#slider_button_link_2').val());
            fd.append('slider_button_name_2', $('#slider_button_name_2').val());
            fd.append('slider_status', $('#slider_status').select2('data'));
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/halaman/slider',
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    $('.datatable-slider').dataTable().ajax.reload();
                }
            });
        });
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

    var _componentFileUpload = function () {
        $('.form-control-uniform-custom').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        });
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSubmit();
            _componentSelect2();
            _componentFileUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    userjs.init();
});
