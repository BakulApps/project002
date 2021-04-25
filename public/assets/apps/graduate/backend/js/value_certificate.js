var certificatejs = function () {
    var _componetnDataTable = function () {
        $('.datatable-ijazah').DataTable({
            bprocessing: true,
            bserverSide: true,
            ajax:({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: adminurl + '/penilaian/ijasah',
                type: 'post',
                dataType: 'json',
                data: function (d) {
                    d._type = 'data';
                    d._data = 'all';
                },
            }),
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: true,
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                emptyTable: 'Tak ada data yang tersedia pada tabel ini',
                loadingRecords: '<i class="icon-spinner4 spinner"></i> Memuat data...',
                info: 'Menampilkan _START_ - _END_ Total _TOTAL_ entri',
                processing: '<i class="icon-spinner4 spinner"></i> Memuat data...',
                search: '_INPUT_',
                binfo: false,
                orderable: false,
                searchPlaceholder: 'Pencarian...',
                lengthMenu: '<span>Tampilkan:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') === 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') === 'rtl' ? '&rarr;' : '&larr;' }
            },
        })
    }

    var _componentSelect = function () {
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
        $('.select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
    }

    var _componentUniform = function () {
        $('.form-control-uniform-custom').uniform({
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400',
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas terpilih'
        });
    }

    var _componentUpload = function () {
        $('#value_ijazah').change(function () {
            $('#modal-upload').modal('hide');
            var percent = 0;
            var notice = new PNotify({
                text: "Mohon tunggu",
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
            var files = $('#value_ijazah')[0].files[0];
            fd.append('_type', 'data');
            fd.append('_data', 'upload');
            fd.append('value_ijazah', files);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: adminurl + '/penilaian/ujian',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(resp){
                    setTimeout(function() {
                        notice.update({
                            title: false
                        });
                        var interval = setInterval(function() {
                            percent += 4;
                            var options = {
                                text: percent + "% Mengunggah"
                            };
                            if (percent >= 100) {
                                window.clearInterval(interval);
                                options.title = resp.title;
                                options.addclass = "bg-"+resp.class+" border-"+resp.class;
                                options.type = resp.class;
                                options.hide = true;
                                options.text = resp.text;
                                options.buttons = {
                                    closer: true,
                                    sticker: true
                                };
                                options.icon = false;
                                options.opacity = 1;
                                options.width = PNotify.prototype.options.width;
                            }
                            $('.datatable-ijazah').DataTable().ajax.reload();
                            notice.update(options);
                        }, 120);
                    }, 2000);
                },
            });
        })
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentUniform();
            _componentUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    certificatejs.init();
});
