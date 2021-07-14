var verifyjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

    var _componentSubmit = function (){
        $('#submit').click(function (){
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/pembayaran/' + $('#submit').val() + '/verifikasi',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'update',
                    'payment_id': $('#submit').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    if (resp.status === 'success'){
                        setTimeout(function (){
                            window.location.href = baseurl + '/pembayaran'
                        }, 2000);
                    }
                }
            });
        });
    }

    var _componentFancybox = function() {
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
    };

    return {
        init: function() {
            _componentFancybox();
            _componentSubmit();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    verifyjs.init();
});
