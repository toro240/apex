require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;
import 'jquery-ui/ui/widgets/datepicker.js';

$(function () {
    $.datepicker.setDefaults($.datepicker.regional["ja"]);

    function useMultipleInputForms() {
        const removeInputBtn = '.remove-input-btn';
        const addInputBtn = '.add-input-btn';

        $(removeInputBtn).each(function (index, element) {
            $(element).prop('disabled', false);
        });

        if ($(addInputBtn).length === 1) {
            $('.remove-input-btn').each(function (index, element) {
                $(element).prop('disabled', true);
            });
        }

        $(addInputBtn).on('click', function() {
            let inputForm = $(this).parent().parent();
            let $addInputForm = inputForm.clone(true);
            $addInputForm.find('.invalid-feedback').each(function (index, element) {
                $(element).text('');
            })
            $addInputForm.find('.multiple-form-input').each(function (index, element) {
                $(element).val('');
            });
            $addInputForm.find('.is-invalid').each(function (index, element) {
                $(element).removeClass('is-invalid');
            });
            $addInputForm.insertAfter($('.multiple-form-field:last'));

            $(removeInputBtn).each(function (index, element) {
                $(element).prop('disabled', false);
            });
        });

        $(removeInputBtn).on('click', function() {
            let inputForm = $(this).parent().parent();
            inputForm.remove();

            if ($(addInputBtn).length === 1) {
                $(removeInputBtn).each(function (index, element) {
                    $(element).prop('disabled', true);
                });
            }
        });
    }

    window.formUtil = {};
    window.formUtil.useMultipleInputForms = useMultipleInputForms;
})
