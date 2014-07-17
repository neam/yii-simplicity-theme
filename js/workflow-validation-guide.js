(function() {
    $(document).ready(function() {
        var currentIndex = 0,
            $currentMissingField = null,
            $nextBtn = $('#next-required'),
            $workflowData = $('#workflow-missing'),
            missingFields = $workflowData.data('missing'),
            missingFieldsOnPage = [],
            modelClass = $workflowData.data('model-class');

        init();

        /**
         * Initializes the script.
         */
        function init() {
            initMissingFields();
            initNextBtn();
            $currentMissingField = $(getFieldElementId(missingFieldsOnPage[0]));
            if (missingFieldsOnPage.length > 0) {
                goToNext();
            }
        }

        /**
         * Initializes the missing fields.
         */
        function initMissingFields() {
            missingFields.forEach(function(fieldName) {
                var fieldId = getFieldElementId(fieldName),
                    $field = $(fieldId);

                if ($field.length > 0) {
                    missingFieldsOnPage.push(fieldName)
                }
            });
        }

        /**
         * Initializes the next button.
         */
        function initNextBtn() {
        }

        /**
         * Go to the next missing field.
         */
        function goToNext() {
            focusOnField();
            updateCurrentIndex();
            updateCurrentField();
        }

        /**
         * Returns the field element ID.
         * @param attribute
         * @returns {string}
         */
        function getFieldElementId(attribute) {
            return '#' + modelClass + '_' + attribute;
        }

        /**
         * Returns the current missing field.
         * @returns {jQuery|HTMLElement}
         */
        function getCurrentMissingField() {
            return $(getFieldElementId(missingFieldsOnPage[currentIndex]));
        }

        /**
         * Focuses on the current field.
         */
        function focusOnField() {
            if ($currentMissingField.hasClass('select2-offscreen')) {
                var select2Id = '#s2id_' + $currentMissingField.selector.substring(1),
                    $selectField = $('.select2-focusser, .select2-choices', select2Id);

                if (typeof $selectField.focus === 'function') {
                    $selectField.focus();
                } else {
                    $selectField[0].focus();
                }
            } else {
                $currentMissingField[0].focus();
            }
        }

        /**
         * Updates the current field index.
         */
        function updateCurrentIndex() {
            var max = missingFieldsOnPage.length - 1;

            if (currentIndex < max) {
                currentIndex += 1;
            } else {
                currentIndex = 0;
            }
        }

        /**
         * Updates the current missing field.
         */
        function updateCurrentField() {
            $currentMissingField = getCurrentMissingField();
        }

        /**
         * Register button event handler.
         */
        $nextBtn.on('click', function(e) {
            if (missingFieldsOnPage.length < 1) {
                // Pass-through - let the form submit and redirect to the next step
            } else {
                e.preventDefault();
                goToNext();
            }
        });
    });
})();
