(function($) {
    'use strict';

    $(document).ready(function() {
        $('.google-font-autocomplete').each(function() {
            $(this).select2({
                data: amreGoogleFonts.fonts,
                placeholder: 'Select a font...',
                allowClear: true,
                templateResult: formatFontOption,
                templateSelection: formatFontSelection
            });

            // Load the font when selected
            $(this).on('select2:select', function(e) {
                var fontFamily = e.params.data.text;
                loadGoogleFont(fontFamily);
            });
        });
    });

    function formatFontOption(font) {
        if (!font.id) {
            return font.text;
        }

        // Load the font for the dropdown
        loadGoogleFont(font.text);

        var $container = $(
            '<div class="font-option">' +
                '<div class="font-family">' + font.text + '</div>' +
                '<div class="font-preview" style="font-family: \'' + font.text + '\'">The quick brown fox jumps over the lazy dog</div>' +
                '<div class="font-category">' + font.category + '</div>' +
            '</div>'
        );

        return $container;
    }

    function formatFontSelection(font) {
        if (!font.id) {
            return font.text;
        }
        return $('<span style="font-family: \'' + font.text + '\'">' + font.text + '</span>');
    }

    function loadGoogleFont(fontFamily) {
        var fontUrl = 'https://fonts.googleapis.com/css2?family=' + encodeURIComponent(fontFamily) + ':wght@400;700&display=swap';
        
        if (!$('link[href*="' + encodeURIComponent(fontFamily) + '"]').length) {
            $('head').append('<link href="' + fontUrl + '" rel="stylesheet">');
        }
    }
})(jQuery); 