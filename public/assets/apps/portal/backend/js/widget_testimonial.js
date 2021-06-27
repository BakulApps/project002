var testimonialjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componetnDataTable = function () {
        $('.datatable-testimonial').DataTable({
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
                url: baseurl + '/widget/testimoni',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e){
            e.preventDefault();
            var testimonial_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/widget/testimoni',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'testimonial',
                    'testimonial_id': testimonial_id,
                },
                success : function (resp) {
                    $('#testimonial_id').val(resp.testimonial_id);
                    $('#testimonial_name').val(resp.testimonial_name);
                    $('#testimonial_job').val(resp.testimonial_job);
                    $('#testimonial_desc').val(resp.testimonial_desc);
                    $('.title').html('Ubah Testimoni');
                    $('#submit').val('update');
                    $('#modal-testimonial').modal('show');
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var testimonial_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/widget/testimoni',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'testimonial_id': testimonial_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-testimonial').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $('#submit').click(function () {
            var fd      = new FormData();
            var files   = $('#testimonial_image')[0].files[0];

            if (files !== undefined){

                fd.append('testimonial_image', files);
            }
            fd.append('_type', $('#submit').val());
            fd.append('testimonial_id', $('#testimonial_id').val());
            fd.append('testimonial_name', $('#testimonial_name').val());
            fd.append('testimonial_job', $('#testimonial_job').val());
            fd.append('testimonial_desc', $('#testimonial_desc').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/widget/testimoni',
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
                    $('.datatable-testimonial').DataTable().ajax.reload();
                    $('#testimonial_id').val('');
                    $('#testimonial_name').val('');
                    $('#testimonial_job').val('');
                    $('#testimonial_desc').val('');
                    $('#testimonial_image').val('');
                    $('#submit').val('store');
                    $('#modal-testimonial').modal('hide');
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
    testimonialjs.init();
});
