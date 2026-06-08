(function ($) {
    /* ---- Медіапікер ---- */
    $(document).on('click', '.rimma-img-btn', function (e) {
        e.preventDefault();
        var $wrap = $(this).closest('.rimma-img-wrap');
        var frame = wp.media({ title: 'Вибрати зображення', button: { text: 'Вибрати' }, multiple: false });
        frame.on('select', function () {
            var att = frame.state().get('selection').first().toJSON();
            $wrap.find('.rimma-img-id').val(att.id);
            $wrap.find('.rimma-img-preview').attr('src', att.sizes && att.sizes.medium ? att.sizes.medium.url : att.url).show();
            $wrap.find('.rimma-img-remove').show();
        });
        frame.open();
    });

    $(document).on('click', '.rimma-img-remove', function (e) {
        e.preventDefault();
        var $wrap = $(this).closest('.rimma-img-wrap');
        $wrap.find('.rimma-img-id').val('');
        $wrap.find('.rimma-img-preview').attr('src', '').hide();
        $(this).hide();
    });
})(jQuery);
