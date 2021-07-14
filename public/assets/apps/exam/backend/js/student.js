var studentjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componetnDataTable = function () {
        $('.datatable-student').DataTable({
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
                url: adminurl + '/peserta',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e){
            e.preventDefault();
            var student_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/peserta',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'student',
                    'student_id': student_id,
                },
                success : function (resp) {
                    $('#student_id').val(resp.student_id);
                    $('#student_number').val(resp.student_number);
                    $('#student_name').val(resp.student_name);
                    $('#student_class').val(resp.student_class);
                    $('#student_username').val(resp.student_username);
                    $('#student_password').val(resp.student_password);
                    $('#modal-student').modal('show');

                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var student_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/peserta',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'student_id': student_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-student').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $('#upload').click(function () {
            $('#modal-upload').modal('hide');
            var notice = new PNotify({
                text: "Mengunggah...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false,
                buttons: {
                    closer: false,
                    sticker: false
                },
                opacity: .9,
                width: "200px"
            });
            var fd = new FormData();
            var files = $('#data-student')[0].files[0];
            fd.append('_type', 'data');
            fd.append('_data', 'upload');
            fd.append('data_student', files);
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/peserta',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(resp){
                    var options = {
                        title: resp.title,
                        addclass: 'alert bg-'+resp.class+' border-'+resp.class+' alert-styled-left',
                        type: resp.class,
                        icon: false,
                        hide: true,
                        text: resp.text,
                        buttons: {closer: true, sticker: true},
                        opacity: 1,
                        width: PNotify.prototype.options.width,
                    };
                    notice.update(options);
                    $('.datatable-student').DataTable().ajax.reload();
                },
            });
        });
        $('#update').click(function (){
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/peserta',
                type: 'post',
                data: {
                    _type: 'update',
                    student_id: $('#student_id').val(),
                    student_number: $('#student_number').val(),
                    student_name: $('#student_name').val(),
                    student_class: $('#student_class').val(),
                    student_username: $('#student_username').val(),
                    student_password: $('#student_password').val(),
                },
                success: function(resp){
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('#modal-student').modal('hide');
                    $('.datatable-student').DataTable().ajax.reload();
                },
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

    var _componentUniform = function (){
        $('.form-control-uniform').uniform({
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400',
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas terpilih'
        });
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSubmit();
            _componentSelect2();
            _componentUniform();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    studentjs.init();
});
