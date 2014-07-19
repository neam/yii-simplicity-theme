/**
 * A modified set of CKEditor-compatible helper methods for the Dirty Forms jQuery plugin.
 * Original: https://github.com/snikch/jquery.dirtyforms/pull/36
 */
(function ($) {
    var ckEditor = {
        /**
         * Checks if a CKEditor is dirty.
         * @param {jQuery} $form the form.
         * @returns {boolean}
         */
        isDirty: function($form) {
            var editors = ckEditors($form),
                dirty = 0;

            $.DirtyForms.dirtylog('Checking ' + editors.length + ' CKEditors for dirtiness...');

            editors.each(function() {
                dirty = this.checkDirty() ? dirty += 1 : dirty;
            });

            $.DirtyForms.dirtylog('There were ' + dirty + ' dirty CKEditors.');

            return dirty > 0;
        },
        /**
         * Resets dirtiness for all CKEditors.
         */
        setClean: function() {
            if (typeof ckEditors.each === 'function') {
                ckEditors.each(function() {
                    this.resetDirty();
                });
            }
        }
    };

    var ckEditors = function(form) {
        editors = [];

        try {
            // Get CKEditors
            Object.keys(CKEDITOR.instances).forEach(function(key) {
                var editor = CKEDITOR.instances[key];
                if ($(editor.element.$).parents().index($(form)) != -1) {
                    editors.push(editor);
                }
            });
        }
        catch (e) {
            // CKEditors not found
        }

        return $(editors);
    };

    // Add the CKEditor methods to Dirty Forms
    $.DirtyForms.helpers.push(ckEditor);
})(jQuery);
