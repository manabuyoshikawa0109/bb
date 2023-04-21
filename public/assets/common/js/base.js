$(function(){
    // Enterでフォーム送信不可
    $('input').on('keydown', function(e) {
        if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
            return false;
        }
        return true;
    });

    // bootstrap5のpopover初期設定
    $('[data-bs-toggle="popover"]').popover({
        // popoverエリアにボタンを表示できるようオプション追加
        html: true,
        sanitize: false,
    });

    // ボタンクリックでpopoverを閉じる
    $(document).on("click", ".popover .close-popover", function(){
        $(this).closest(".popover").popover('hide');
      });
});