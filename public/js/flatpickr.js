document.addEventListener('DOMContentLoaded', function () {
    const birthdayInput = document.querySelector("#birthday");
    if (birthdayInput) {
        flatpickr(birthdayInput, {
            defaultDate: null // Correctly sets defaultDate to no preselected date
        });
    }
});