var pagehome = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSubmit = function () {
        $('#submit').click(function () {
            var fd      = new FormData();
            var files   = $('#home_section_about_image')[0].files[0];

            if (files !== undefined){

                fd.append('home_section_about_image', files);
            }
            fd.append('_data', $('#submit').val());
            fd.append('home_section_about_name', $('#home_section_about_name').val());
            fd.append('home_section_about_title', $('#home_section_about_title').val());
            fd.append('home_section_about_content', $('#home_section_about_content').val());
            fd.append('home_section_about_link', $('#home_section_about_link').val());
            fd.append('home_section_about_button', $('#home_section_about_button').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/halaman/beranda',
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
            _componentSubmit();
            _componentSelect2();
            _componentFileUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    pagehome.init();
});
