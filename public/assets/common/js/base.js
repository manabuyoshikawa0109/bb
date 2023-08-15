$(function(){
    // Enterでフォーム送信不可
    $('input').on('keydown', function(e) {
        if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
            return false;
        }
        return true;
    });
});