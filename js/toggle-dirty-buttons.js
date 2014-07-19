(function() {
    var $form = $('form.dirtyforms'),
        $buttons = $('.btn-dirtyforms'),
        $linkButtons = $('a.btn-dirtyforms');

    /**
     * Hides the buttons.
     */
    function disableButtons() {
        $buttons.attr('disabled', '');
    }

    /**
     * Shows the buttons.
     */
    function enableButtons() {
        $buttons.removeAttr('disabled');
    }

    // Check if the form is dirty on change
    $form.on('keyup change', function() {
        if ($(this).isDirty()) {
            enableButtons();
        } else {
            disableButtons();
        }
    });

    // Make the form dirty when pressing an upload button (select2)
    $form.find('.upload-btn').on('click', function() {
        $form.dirtyForms('setDirty');
        $form.trigger('change');
    });

    // Look for dirty CKEditor fields
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.on('instanceReady', function() {
            // Get CKEditors
            Object.keys(CKEDITOR.instances).forEach(function(key) {
                var editor = CKEDITOR.instances[key];

                editor.document.on('keyup', function() {
                    if ($form.isDirty()) {
                        enableButtons();
                    } else {
                        disableButtons();
                    }
                });
            });
        });
    }

    // Prevent disabled link buttons from being clicked
    $linkButtons.on('click', function(e) {
        if ($(this).attr('disabled')) {
            e.preventDefault();
        }
    });

    disableButtons(); // disable buttons by default

    $.DirtyForms.dialog.fire = function(message, title) {
        var content = '<div class="row-fluid"><div class="span12"><span class="facebox-title">' + title + '</span><p>' + message + '</p></div></div><div class="row-fluid"><a href="#" class="span6 ignoredirty button medium cancel">Stop</a><a href="#" class="span6 pull-right ignoredirty button medium red continue continue-without-saving">Continue without saving</a></div>';
        $.facebox(content);
    }
})();
