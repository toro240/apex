$(function () {
    $(document).on('show.bs.modal', '#taskRemoveModal', function(event) {
        const button = $(event.relatedTarget);
        const isMeTarget = button.data('is-me-target') === 1;
        const isAnotherTarget = button.data('is-another-target') === 1;

        const modal = $(this);
        modal.find('#task-remove-me').attr('hidden', !isMeTarget);
        modal.find('#remove-me-form').attr('action', button.data('remove-me-action'));
        modal.find('#remove-form').attr('action', button.data('remove-action'));
        modal.find('#task-modal-title').text('Do you want to remove the \"' + button.data('task-subject') + '\"?');

        let modalBodyText = isAnotherTarget ? '<h5 class="text-danger font-weight-bold">Another user has been assigned to this task!</h5>' : '';
        modalBodyText += '<h5>Do you really want to delete this?</h5>';
        if (isMeTarget) {
            modalBodyText += '<h5><span class="text-success">\"RemoveMe\"</span> if you want to remove only yourself from tha assignment, <span class="text-danger">\"Remove\"</span> to delete this.</h5>'
        }
        modal.find('#task-modal-body').html(modalBodyText);
    })
})
