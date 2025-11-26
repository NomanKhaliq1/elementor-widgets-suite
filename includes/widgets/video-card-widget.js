(function ($) {
    function toEmbed(url) {
        if (!url) return '';
        var yt = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]+)/i);
        if (yt && yt[1]) {
            return 'https://www.youtube.com/embed/' + yt[1] + '?autoplay=1';
        }
        return url;
    }

    $(document).on('click', '.vcw-btn[data-popup="1"]', function (e) {
        e.preventDefault();
        var $btn = $(this);
        var widget = $btn.data('widget');
        var url = $btn.data('video-url');
        var embed = toEmbed(url);
        var $modal = $('.vcw-modal[data-widget="' + widget + '"]');
        if (!$modal.length || !embed) return;
        $modal.removeAttr('hidden');
        $modal.find('iframe').attr('src', embed);
    });

    $(document).on('click', '.vcw-modal-backdrop, .vcw-modal-close', function () {
        var $modal = $(this).closest('.vcw-modal');
        $modal.find('iframe').attr('src', '');
        $modal.attr('hidden', 'hidden');
    });
})(jQuery);
