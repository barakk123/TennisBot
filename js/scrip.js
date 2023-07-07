document.addEventListener("DOMContentLoaded", function() {
    const startDateInput = document.getElementById("startDate");
    const endDateInput = document.getElementById("endDate");
    
    startDateInput.addEventListener("input", () => {
        endDateInput.min = startDateInput.value;
    });
  });
  
  