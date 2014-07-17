(function() {
    // Forcefully marks form as dirty on form change
    $('form.dirtyforms').on('change', function() {
        $(this).dirtyForms('setDirty');
    });
})();
