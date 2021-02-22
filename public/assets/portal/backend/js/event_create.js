var eventcreate = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSubmit = function () {
        $("#submit").click(function () {
            var fd      = new FormData();
            var files   = $('#event_image')[0].files[0];

            fd.append('_type', 'create');
            if (files !== undefined){

                fd.append('event_image', files);
            }
            fd.append('_type', $('#submit').val());
            fd.append('event_title', $('#event_title').val());
            fd.append('event_content', $('#event_content').summernote('code'));
            fd.append('event_date_start', $('#event_date_start').val());
            fd.append('event_date_end', $('#event_date_end').val());
            fd.append('event_place', $('#event_place').val());

            $.ajax({
                headers: csrf_token,
                url : baseurl + '/kegiatan/buat',
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
                        window.location.href = baseurl + '/kegiatan'
                    }, 2000);
                }
            })
        });
    }

    var _componentDatePicker = function() {
        $('.daterange-single').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    };

    var _componentEditor = function () {
        $('#event_content').summernote({

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
            var file = $('#event_image')[0].files[0];
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
            _componentDatePicker();
            _componentEditor();
            _componentImage();
            _componentUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    eventcreate.init();
});
