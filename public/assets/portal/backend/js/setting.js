var settingjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSelect = function () {
        $('.select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
        });
    }

    var _componentSubmit = function () {
        $('#submit').click(function () {
            var fd      = new FormData();
            var files   = $('#user_image')[0].files[0];

            if (files !== undefined){

                fd.append('user_image', files);
            }
            fd.append('_type', 'update');
            fd.append('user_id', $('#user_id').val());
            fd.append('user_fullname', $('#user_fullname').val());
            fd.append('user_name', $('#user_name').val());
            fd.append('user_pass', $('#user_pass').val());
            fd.append('user_email', $('#user_email').val());
            fd.append('user_role', $('#user_role').val());
            fd.append('user_facebook', $('#user_facebook').val());
            fd.append('user_instagram', $('#user_instagram').val());
            fd.append('user_twitter', $('#user_twitter').val());
            fd.append('user_desc', $('#user_desc').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/pengguna',
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
    }

    var _componentFileUpload = function () {
        $('.form-control-uniform-custom').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        }).change(function (){
            var file = $('#user_image')[0].files[0];
            var reader = new FileReader()
            reader.onload = function (){
                $('.image-view').attr('src', reader.result);
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
