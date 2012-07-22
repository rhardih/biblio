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
  });
})(jQuery);
