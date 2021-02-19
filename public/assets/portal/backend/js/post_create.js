var postcreate = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSubmit = function () {
        $("#save").click(function () {
            var fd      = new FormData();
            var files   = $('#post_image')[0].files[0];
            var comment = $('#post_comment:checked').val();

            fd.append('_type', 'create');
            fd.append('post_status', 0)
            if (files !== undefined){

                fd.append('post_image', files);
            }
            if (comment !== undefined){
                fd.append('post_comment', 1)
            }
            else {
                fd.append('post_comment', 0)
            }
            fd.append('post_title', $('#post_title').val());
            fd.append('post_content', $('#post_content').summernote('code'));
            fd.append('post_category', $('#post_category').val());
            fd.append('post_tag', $('#post_tag').val());

            $.ajax({
                headers: csrf_token,
                url : baseurl + '/postingan/buat',
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    setTimeout(function (){
                        window.location.href = baseurl + '/postingan'
                    }, 2000);
                }
            })
        });
        $("#publish").click(function () {
            var fd      = new FormData();
            var files   = $('#post_image')[0].files[0];
            var comment = $('#post_comment:checked').val();

            fd.append('_type', 'create');
            fd.append('post_status', 1)
            if (files !== undefined){

                fd.append('post_image', files);
            }
            if (comment !== undefined){
                fd.append('post_comment', 1)
            }
            else {
                fd.append('post_comment', 0)
            }
            fd.append('post_title', $('#post_title').val());
            fd.append('post_content', $('#post_content').summernote('code'));
            fd.append('post_category', $('#post_category').val());
            fd.append('post_tag', $('#post_tag').val());

            $.ajax({
                headers: csrf_token,
                url : baseurl + '/postingan/buat',
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    setTimeout(function (){
                        window.location.href = baseurl + '/postingan'
                    }, 2000);
                }
            })
        });

        $('#category-add').click(function (){
           window.location.href = baseurl + '/postingan/kategori';
        });

        $('#tag-add').click(function (){
            window.location.href = baseurl + '/postingan/tagar';
        });
    }

    var _componentSelect2 = function() {
        $('.dataTables_length  select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });

        $('.select-category').select2({
            minimumResultsForSearch: Infinity,
            ajax: {
                headers: csrf_token,
                url: baseurl + '/postingan/kategori',
                dataType: 'json',
                type: 'post',
                data: {
                    _type: 'data',
                    _data: 'json'
                },
                processResults: function (data) {
                    return {
                        results: data
                    }
                },
                cache: true
            },
        });

        $('.select-tag').select2({
            minimumResultsForSearch: Infinity,
            ajax: {
                headers: csrf_token,
                url: baseurl + '/postingan/tagar',
                dataType: 'json',
                type: 'post',
                data: {
                    _type: 'data',
                    _data: 'json'
                },
                processResults: function (data) {
                    return {
                        results: data
                    }
                },
                cache: true
            },
        });
    };

    var _componentEditor = function () {
        $('#post_content').summernote({

            tabsize: 1,
            height: 400
        });
        $('.note-image-input').uniform({
            fileButtonClass: 'action btn bg-warning-400'
        });
        $('.form-check-input-styled-primary').uniform({
            wrapperClass: 'border-primary-600 text-primary-800'
        });
    }

    var _componentImage = function () {
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    }

    var _componentUpload = function () {
        $('.form-control-uniform').uniform({
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400',
            fileButtonHtml: 'Pilih',
            fileDefaultHtml: 'Pilih Gambar'
        }).change(function (){
            var file = $('#post_image')[0].files[0];
            var reader = new FileReader()
            reader.onload = function (){
                $('.image-view').attr('src', reader.result);
            }
            reader.readAsDataURL(file);
        });
    }

    return {
        init: function() {
            _componentSubmit();
            _componentSelect2();
            _componentEditor();
            _componentImage();
            _componentUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    postcreate.init();
});
