$(document).ready( function () {
    $('#books').DataTable();
});

// JavaScript to remove the success message after 5 seconds
setTimeout(function() {
    var successMessage = document.getElementById('successMessage');
    if (successMessage) {
        successMessage.remove();
    }
}, 5000);
setTimeout(function() {
    var successMessage = document.getElementById('errorMessage');
    if (successMessage) {
        successMessage.remove();
    }
}, 5000);