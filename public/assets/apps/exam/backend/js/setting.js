var settingjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSelect = function () {
        $('.select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
        });
    }

    var _componentSubmit = function () {
        $('#app').click(function () {
            var fd = new FormData();
            var school_logo = $('#school_logo')[0].files[0];
            fd.append('_type', 'update');
            fd.append('_data', 'app');
            fd.append('app_name', $('#app_name').val());
            fd.append('app_alias', $('#app_alias').val());
            fd.append('school_name', $('#school_name').val());
            fd.append('school_address', $('#school_address').val());
            if (school_logo !== undefined){
                fd.append('school_logo', school_logo);
            }
            else {
                fd.append('school_logo', null);
            }
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/pengaturan',
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
                }
            })
        });
        $('#database').click(function () {
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/pengaturan',
                type: 'post',
                dataType: 'json',
                data: {
                    _type : 'update',
                    _data : 'database',
                    table : $('#database_id').val(),
                },
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                }
            })
        });
    }

    var _componentFileUpload = function () {
        $('.form-control-uniform-custom').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        })
    }

    return {
        init: function() {
            _componentSelect();
            _componentSubmit();
            _componentFileUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    settingjs.init();
});
