var pagehome = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSubmit = function () {
        $('#about').click(function () {
            var fd      = new FormData();
            var files   = $('#home_section_about_image')[0].files[0];

            if (files !== undefined){

                fd.append('home_section_about_image', files);
            }
            fd.append('_data', 'about');
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
        $('#youtube').click(function () {
            var fd      = new FormData();
            var files   = $('#home_section_yt_background')[0].files[0];

            if (files !== undefined){

                fd.append('home_section_yt_background', files);
            }
            fd.append('_data', 'youtube');
            fd.append('home_section_yt_youtube', $('#home_section_yt_youtube').val());
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
        $('#section-4').click(function () {
            var fd      = new FormData();
            var home_section_4_icon_1   = $('#home_section_4_icon_1')[0].files[0];
            var home_section_4_icon_2   = $('#home_section_4_icon_2')[0].files[0];
            var home_section_4_icon_3   = $('#home_section_4_icon_3')[0].files[0];

            if (home_section_4_icon_1 !== undefined){

                fd.append('home_section_4_icon_1', home_section_4_icon_1);
            }
            if (home_section_4_icon_2 !== undefined){

                fd.append('home_section_4_icon_2', home_section_4_icon_2);
            }
            if (home_section_4_icon_3 !== undefined){

                fd.append('home_section_4_icon_3', home_section_4_icon_3);
            }

            fd.append('_data', 'section-4');
            fd.append('home_section_4_title_1', $('#home_section_4_title_1').val());
            fd.append('home_section_4_content_1', $('#home_section_4_content_1').val());
            fd.append('home_section_4_title_2', $('#home_section_4_title_2').val());
            fd.append('home_section_4_content_2', $('#home_section_4_content_2').val());
            fd.append('home_section_4_title_3', $('#home_section_4_title_3').val());
            fd.append('home_section_4_content_3', $('#home_section_4_content_3').val());
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
