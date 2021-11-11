$(function () {
    $('.add-user-name-btn').on('click', function() {
        let $userNameForm = $(this).parent().parent();
        let $addUserNameForm = $userNameForm.clone(true);
        $addUserNameForm.find('.user-name-label').each(function (index, element) {
            $(element).text('');
        });
        $addUserNameForm.find('.invalid-feedback').each(function (index, element) {
            $(element).text('');
        })
        $addUserNameForm.find('.input-user-name').each(function (index, element) {
            $(element).val('');
        });
        $addUserNameForm.find('.is-invalid').each(function (index, element) {
            $(element).removeClass('is-invalid');
        });
        $addUserNameForm.find('.add-user-name-btn').remove();
        $addUserNameForm.insertAfter($('.user-name:last'));
    });
})
