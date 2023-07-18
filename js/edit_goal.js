document.addEventListener("DOMContentLoaded", function () {
    loadGoal();
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

function loadGoal() {
    const goalId = document.querySelector("#goal-id").value;
    if (goalId) {
        fetch(`getGoalById.php?id=${goalId}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                document.getElementById("nameOfGoal").value = data.title;
                document.getElementById("startDate").value = data.start_date;
                document.getElementById("endDate").value = data.end_date;

                const startDateInput = document.getElementById("startDate");
                startDateInput.min = data.start_date;

                const endDateInput = document.getElementById("endDate");
                endDateInput.min = data.start_date;
                startDateInput.addEventListener("input", () => {
                    endDateInput.min = startDateInput.value;
                });
            });
    }
}

document.forms[0].addEventListener("submit", function (event) {
    event.preventDefault();
    const goalId = document.querySelector("#goal-id").value;
    const nameOfGoal = document.getElementById("nameOfGoal").value;
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;

    let goal = {
        goalId,
        nameOfGoal,
        startDate,
        endDate,
    };

    // Send the goal data to the server
    fetch("updateGoal.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(goal),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                openLightbox("error", data.error, `edit_goal.php?id=${goalId}`);
            } else {
                openLightbox(
                    "success",
                    "Goal updated successfully!",
                    `edit_goal_categories.php?id=${goalId}`
                );
            }
        });
});
