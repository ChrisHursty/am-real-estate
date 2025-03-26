jQuery(document).ready(function($) {
    var frame;

    $('#portfolio_thumbnail_button').on('click', function(e) {
        e.preventDefault();

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Portfolio Thumbnail',
            button: {
                text: 'Use this image'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $('#portfolio_thumbnail_id').val(attachment.id);
            $('#portfolio_thumbnail_button').after('<img src="' + attachment.url + '" alt="" style="max-width:100%;"/>');
        });

        // Finally, open the modal on click
        frame.open();
    });
});
