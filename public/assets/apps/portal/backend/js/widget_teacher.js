var teacherjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componetnDataTable = function () {
        $('.datatable-teacher').DataTable({
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
                url: baseurl + '/widget/guru',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e){
            e.preventDefault();
            var teacher_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/widget/guru',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'teacher',
                    'teacher_id': teacher_id,
                },
                success : function (resp) {
                    $('#teacher_id').val(resp.teacher_id);
                    $('#teacher_name').val(resp.teacher_name);
                    $('#teacher_job').val(resp.teacher_job);
                    $('#teacher_mail').val(resp.teacher_mail);
                    $('#teacher_facebook').val(resp.teacher_facebook);
                    $('#teacher_twitter').val(resp.teacher_twitter);
                    $('#teacher_instagram').val(resp.teacher_instagram);
                    $('#teacher_about').val(resp.teacher_about);
                    $('#teacher_achievment').val(resp.teacher_achievment);
                    $('.title').html('Ubah Data Guru');
                    $('#submit').val('update');
                    $('#modal-teacher').modal('show');
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var teacher_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/widget/guru',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'teacher_id': teacher_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-teacher').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $('#submit').click(function () {
            var fd      = new FormData();
            var files   = $('#teacher_image')[0].files[0];

            if (files !== undefined){

                fd.append('teacher_image', files);
            }
            fd.append('_type', $('#submit').val());
            fd.append('teacher_id', $('#teacher_id').val());
            fd.append('teacher_name', $('#teacher_name').val());
            fd.append('teacher_job', $('#teacher_job').val());
            fd.append('teacher_mail', $('#teacher_mail').val());
            fd.append('teacher_facebook', $('#teacher_facebook').val());
            fd.append('teacher_twitter', $('#teacher_twitter').val());
            fd.append('teacher_instagram', $('#teacher_instagram').val());
            fd.append('teacher_about', $('#teacher_about').val());
            fd.append('teacher_achievement', $('#teacher_achievement').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/widget/guru',
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
                    if (resp.status === 'success'){
                        $('.datatable-teacher').DataTable().ajax.reload();
                        $('#teacher_id').val('');
                        $('#teacher_name').val('');
                        $('#teacher_job').val('');
                        $('#teacher_mail').val('');
                        $('#teacher_facebook').val('');
                        $('#teacher_twitter').val('');
                        $('#teacher_instagram').val('');
                        $('#teacher_about').val('');
                        $('#teacher_achievement').val('');
                        $('#teacher_image').val('');
                        $('#submit').val('store');
                        $('.title').html('Tambah Data Guru');
                        $('#modal-teacher').modal('hide');
                    }
                }
            });
        });
        $('#close').click(function (){
            $('#teacher_id').val('');
            $('#teacher_name').val('');
            $('#teacher_job').val('');
            $('#teacher_mail').val('');
            $('#teacher_facebook').val('');
            $('#teacher_twitter').val('');
            $('#teacher_instagram').val('');
            $('#teacher_about').val('');
            $('#teacher_achievement').val('');
            $('#teacher_image').val('');
            $('#submit').val('store');
            $('.title').html('Tambah Data Guru');
        })
    }

    var _componentSelect2 = function() {
        $('.dataTables_length  select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
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
    teacherjs.init();
});
