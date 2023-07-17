document.addEventListener("DOMContentLoaded", function () {
    const startDateInput = document.getElementById("startDate");
    startDateInput.min = getMinDate();
    const endDateInput = document.getElementById("endDate");
    endDateInput.min = startDateInput.min;

    startDateInput.addEventListener("input", () => {
        endDateInput.min = startDateInput.value;
    });
});

function getMinDate() {
    const today = new Date();
    let year, month, day;
    year = String(today.getFullYear());
    month = String(today.getMonth() + 1);
    if (month.length == 1) {
        month = "0" + month;
    }
    day = String(today.getDate());
    if (day.length == 1) {
        day = "0" + day;
    }
    return year + "-" + month + "-" + day;
}
