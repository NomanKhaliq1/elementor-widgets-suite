(function ($) {
  $(document).ready(function () {
    var $modal = $("#dcw-modal");
    var $title = $("#dcw-modal-title");
    var $desc = $("#dcw-modal-desc");
    var $img = $("#dcw-modal-img");

    $("[data-dcw-modal]").on("click", function () {
      var title = $(this).data("title") || "";
      var desc = $(this).data("desc") || "";
      var img = $(this).data("img") || "";

      $title.text(title);
      $desc.text(desc);
      if (img) {
        $img.html('<img src="' + img + '" alt="' + title + '">');
      } else {
        $img.html("");
      }

      $modal.css("display", "flex").hide().fadeIn(150);
    });

    $modal.on("click", ".dcw-modal-close", function () {
      $modal.fadeOut(150);
    });

    $modal.on("click", function (e) {
      if ($(e.target).is("#dcw-modal")) {
        $modal.fadeOut(150);
      }
    });
  });
})(jQuery);
