import IMask from 'imask';

var infoController = function () {
    
    var infoMask = function cpfMask() {
        var cpfMask = IMask(
            document.getElementById('cpf'), {
            mask: "000.000.000-00"
        });
    }
    
    
    return {
        init: function() {
            infoMask();
        }
    };
}();
    
$(function () {
    infoController.init();
});