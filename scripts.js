;(function($) {
  $(function() {
    $('form.delete').submit(function() {
      var msg = [
        "Are you sure you want to delete ",
        $(this).data("title"),
        " by ",
        $(this).data("author"),
        "?"
      ].join("");

      return confirm(msg);
    });

    $('#illustration_button').click(function() {
      formfield = $('#illustration').attr('name');
      tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
      return false;
    });

    window.send_to_editor = function(html) {
      imgurl = $('img',html).attr('src');
      $('#illustration').val(imgurl);
      tb_remove();
    }

  });
})(jQuery);
