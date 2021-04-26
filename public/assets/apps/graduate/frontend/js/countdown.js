var countdown = function () {
    var _ConponentCount = function() {
        var countDownDate = new Date(noticeDate).getTime();
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            $('#countdown').html(days + " Hari : " + hours + " Jam : " + minutes + " Menit : " + seconds + " Detik ");

        }, 1000);
    };
    return {
        initComponents: function() {
            _ConponentCount();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    countdown.initComponents();
});
