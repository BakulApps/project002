var loginjs = function () {
    var _componentUniform = function() {
        $('.form-check-input-styled-primary').uniform({
            wrapperClass: 'border-primary-600 text-primary-800'
        });
    }

    return {
        initComponents: function() {
            _componentUniform();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    loginjs.initComponents();
});
