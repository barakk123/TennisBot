document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("skillsForm");

    form.addEventListener("submit", function (event) {
        // Validation for minimum number of filled inputs
        var inputs = form.querySelectorAll("input[type=number]");
        var filledInputs = Array.prototype.filter.call(
            inputs,
            function (input) {
                return input.value !== "";
            }
        );

        if (filledInputs.length < 4) {
            alert("Please fill at least 4 inputs.");
            event.preventDefault();
            return; // This will stop the execution of the following code in case the validation fails
        }

        // Your existing code
        event.preventDefault();
        const formData = new FormData(form);

        fetch("setTraineeSkills.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.text())
            .then((result) => {
                // Handle the result of the request
                openLightbox(
                    "success",
                    "Updated successfully!",
                    "my_goals.php"
                );
            })
            .catch((error) => {
                openLightbox("error", error, null);
            });
    });
});
