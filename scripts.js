;(function($) {
  $(function() {
    $("a.delete").click(function() {
      var msg = [
        "Are you sure you want to delete ",
        $(this).data("title"),
        " by ",
        $(this).data("author"),
        "?"
      ].join("");

      if (confirm(msg)) {
        $(this).closest("form").submit();
      }
      return false;
    });
  });
})(jQuery);
