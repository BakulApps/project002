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
            var files   = $('#app_logo')[0].files[0];
            if (files !== undefined){
                fd.append('app_logo', files);
            }
            fd.append('_type', 'app');
            fd.append('_data', 'setting');
            fd.append('app_name', $('#app_name').val());
            fd.append('app_desc', $('#app_desc').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/pengaturan',
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
            });
        });
        $('#school').click(function (){
            var fd      = new FormData();
            var files   = $('#school_logo')[0].files[0];
            if (files !== undefined){
                fd.append('school_logo', files);
            }
            fd.append('_type', 'school');
            fd.append('_data', 'setting');
            fd.append('school_name', $('#school_name').val());
            fd.append('school_phone', $('#school_phone').val());
            fd.append('school_email', $('#school_email').val());
            fd.append('school_address', $('#school_address').val());
            fd.append('school_village', $('#school_village').val());
            fd.append('school_subdistric', $('#school_subdistric').val());
            fd.append('school_distric', $('#school_distric').val());
            fd.append('school_province', $('#school_province').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/pengaturan',
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
            });
        })
    }

    var _componentFileUpload = function () {
        $('#school_logo').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        }).change(function (){
            var file = $('#school_logo')[0].files[0];
            var reader = new FileReader()
            reader.onload = function (){
                $('.image-school-view').attr('src', reader.result);
            }
            reader.readAsDataURL(file);
        });
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
