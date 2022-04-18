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
            var fd      = new FormData();
            var files           = $('#app_logo')[0].files[0];
            var app_brochure    = $('#app_brochure')[0].files[0];
            if (files !== undefined){
                fd.append('app_logo', files);
            }
            if (app_brochure !== undefined){
                fd.append('app_brochure', app_brochure);
            }
            fd.append('_type', 'update');
            fd.append('_data', 'setting');
            fd.append('app_name', $('#app_name').val());
            fd.append('app_alias', $('#app_alias').val());
            fd.append('app_year', $('#app_year').val());
            fd.append('app_youtube', $('#app_youtube').val());
            fd.append('app_desc', $('#app_desc').val());
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
                    if (resp.status === 'success'){
                        location.reload();
                    }
                }
            });
        });
    }

    var _componentFileUpload = function () {
        $('#app_logo').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        }).change(function (){
            var file = $('#app_logo')[0].files[0];
            var reader = new FileReader()
            reader.onload = function (){
                $('.image-app-view').attr('src', reader.result);
            }
            reader.readAsDataURL(file);
        });
        $('#app_brochure').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        });
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
