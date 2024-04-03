import $ from 'jquery';

function openConfirmationModal(id) {
    $('#confirmationModal').modal('show');
    $('#cancel').on('click', function () {
        $('#confirmationModal').hide();
    });
    $('#confirmDeleteBtn').on('click', function () {
        $('#deleteForm' + id).submit();
    });
}