document.addEventListener("DOMContentLoaded", function () {
    fetch("getUserCategories.php")
        .then((response) => response.json())
        .then((categories) => {
            const selectElement = document.getElementById("date-myGoals");

            categories.forEach((category) => {
                let optionElement = document.createElement("option");
                optionElement.value = category;
                optionElement.textContent = category;

                selectElement.appendChild(optionElement);
            });

            loadGoal();
        });
});

function hasChanges() {
    return document.querySelectorAll("input[touched=true]").length > 0;
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
                const selectElement = document.getElementById("date-myGoals");
                const selectedCategory =
                    sessionStorage.getItem("selectedCategory");
                if (selectedCategory) {
                    selectElement.value = selectedCategory;
                    updateStrikeList(selectedCategory, goalId);
                } else {
                    const firstOption = selectElement.querySelector("option");
                    updateStrikeList(firstOption.value, goalId);
                }
            });
    }
}

function getStrikesByCategory(category, goalId) {
    fetch(
        `getStrikesByCategory.php?category=${category}&update=true&goal_id=${goalId}`
    )
        .then((response) => response.json())
        .then((data) => {
            const tableElement = document.querySelector(
                ".tableChooseCategory table"
            );

            // Clear the table first
            tableElement.innerHTML = "";

            let lastCategoryName = null;
            let tbodyElement = null;
            let dataRowElement = null;
            let currentCol = 1;

            data.strikes.forEach((strike, index) => {
                if (lastCategoryName !== strike.category_name) {
                    // If there was a previous category, append the last row and the table body to the table
                    if (tbodyElement) {
                        if (currentCol === 2) {
                            tbodyElement.appendChild(dataRowElement);
                        }
                        tableElement.appendChild(tbodyElement);
                    }

                    // Create a new table body
                    tbodyElement = document.createElement("tbody");
                    tbodyElement.className = "tr_wrapper";

                    // Create the header row
                    let headerRowElement = document.createElement("tr");
                    headerRowElement.className = "headtitle-table-tr";

                    let headerCellElement = document.createElement("td");
                    headerCellElement.colSpan = 4; // the header cell spans all 4 columns
                    headerCellElement.innerHTML = `<div class="headtitle-table">${strike.category_name}</div>`;
                    headerRowElement.appendChild(headerCellElement);
                    tbodyElement.appendChild(headerRowElement);

                    // Create the first data row
                    dataRowElement = document.createElement("tr");

                    lastCategoryName = strike.category_name;
                    currentCol = 1;
                }

                let subcategoryCellElement = document.createElement("td");
                subcategoryCellElement.className = `td${currentCol}`;
                subcategoryCellElement.textContent = `${strike.subcategory_name}`;
                dataRowElement.appendChild(subcategoryCellElement);

                let skillCellElement = document.createElement("td");
                skillCellElement.className = `td${currentCol + 1}`;

                let skillValueNumber = strike.skill_min_value
                    ? Number(strike.skill_min_value)
                    : null;
                let skillTargetValueNumber = strike.skill_target_value
                    ? Number(strike.skill_target_value)
                    : null;

                let sign = "";
                if (strike.subcategory_name === "Avg. Speed") {
                    sign = "Km/h";
                } else if (strike.subcategory_name === "Accuracy") {
                    sign = "%";
                }

                if (currentCol === 1) {
                    if (skillTargetValueNumber) {
                        if (skillValueNumber + 1 >= 100) {
                            skillCellElement.innerHTML = `<div class="text_speed_acc">${skillValueNumber} -></div><input id="s${
                                index + 1
                            }" type="number" min="${
                                skillValueNumber + 1
                            }" max="100" oninput="validateInput('s${
                                index + 1
                            }')" value="${skillTargetValueNumber}" disabled>${sign}`;
                        } else {
                            skillCellElement.innerHTML = `<div class="text_speed_acc">${skillValueNumber} -></div><input id="s${
                                index + 1
                            }" type="number" min="${
                                skillValueNumber + 1
                            }" max="100" oninput="validateInput('s${
                                index + 1
                            }')" value="${skillTargetValueNumber}">${sign}`;
                        }
                    } else {
                        if (skillValueNumber + 1 >= 100) {
                            skillCellElement.innerHTML = `<div class="text_speed_acc">${skillValueNumber} -></div><input id="s${
                                index + 1
                            }" type="number" min="${
                                skillValueNumber + 1
                            }" max="100" oninput="validateInput('s${
                                index + 1
                            }')" disabled>${sign}`;
                        } else {
                            skillCellElement.innerHTML = `<div class="text_speed_acc">${skillValueNumber} -></div><input id="s${
                                index + 1
                            }" type="number" min="${
                                skillValueNumber + 1
                            }" max="100" oninput="validateInput('s${
                                index + 1
                            }')">${sign}`;
                        }
                    }
                } else if (skillTargetValueNumber) {
                    skillCellElement.innerHTML = `<div class="text_speed_acc">${skillValueNumber} -></div><input id="s${
                        index + 1
                    }" type="number" min="${
                        skillValueNumber + 1
                    }" oninput="validateInput('s${
                        index + 1
                    }')" value="${skillTargetValueNumber}">${sign}`;
                } else {
                    skillCellElement.innerHTML = `<div class="text_speed_acc">${skillValueNumber} -></div><input id="s${
                        index + 1
                    }" type="number" min="${
                        skillValueNumber + 1
                    }" oninput="validateInput('s${index + 1}')">${sign}`;
                }
                dataRowElement.appendChild(skillCellElement);

                if (currentCol === 2) {
                    tbodyElement.appendChild(dataRowElement);
                    dataRowElement = document.createElement("tr"); // create a new row for the next subcategory
                }

                currentCol = currentCol === 1 ? 2 : 1;
            });

            // If there's a row left that hasn't been appended yet, append it
            if (currentCol === 2) {
                tbodyElement.appendChild(dataRowElement);
            }

            // If there's a tbody left that hasn't been appended yet, append it
            if (tbodyElement) {
                tableElement.appendChild(tbodyElement);
            }
        });
}

function updateStrikeList(category, goalId) {
    sessionStorage.setItem("selectedCategory", category);
    if (hasChanges()) {
        if (
            confirm(
                "You have unsaved changes, would you like to save your changes before?"
            )
        ) {
            submitChangesBeforeUpdateStrikeList(category, goalId);
        }
    } else {
        getStrikesByCategory(category, goalId);
    }
}

function submitChangesBeforeUpdateStrikeList(category, goalId) {
    let categories = [];
    let tbodys = document.querySelectorAll(".tr_wrapper");

    tbodys.forEach((tbody) => {
        let subcategories = [];
        const tr = tbody.querySelector("tr:nth-of-type(2)");
        if (tr) {
            if (
                tr.querySelector(".td1") &&
                tr.querySelector(".td2 .text_speed_acc")
            ) {
                subcategories.push({
                    name: tr.querySelector(".td1").innerText,
                    current: Number(
                        tr
                            .querySelector(".td2 .text_speed_acc")
                            .innerHTML.split(" ")[0]
                    ),
                    target: tr.querySelector(".td2 input").value
                        ? Number(tr.querySelector(".td2 input").value)
                        : null,
                });
            }

            if (
                tr.querySelectorAll(".td2")[1] &&
                tr.querySelector(".td3 .text_speed_acc")
            ) {
                subcategories.push({
                    name: tr.querySelectorAll(".td2")[1].innerText,
                    current: Number(
                        tr
                            .querySelector(".td3 .text_speed_acc")
                            .innerHTML.split(" ")[0]
                    ),
                    target: tr.querySelector(".td3 input").value
                        ? Number(tr.querySelector(".td3 input").value)
                        : null,
                });
            }
        }

        categories.push({
            name: tbody.querySelector(".headtitle-table-tr .headtitle-table")
                .innerText,
            subcategories,
        });
    });

    if (categories.some((c) => c.subcategories?.length > 0)) {
        let goal = {
            goalId,
            categories,
        };

        // Send the goal data to the server
        fetch("updateGoalCategories.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(goal),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    openLightbox("error", data.error, null);
                } else {
                    openLightbox("success", "Goal updated successfully!", null);
                    getStrikesByCategory(category, goalId);
                }
            });
    } else {
        openLightbox("error", "You must fill at least one goal!", null);
    }
}

document.forms[0].addEventListener("submit", function (event) {
    event.preventDefault();
    const submit_btn = document.querySelector("#submitGoal");
    submit_btn.setAttribute("disabled", "true");

    const goalId = document.querySelector("#goal-id").value;

    let categories = [];
    let tbodys = document.querySelectorAll(".tr_wrapper");

    tbodys.forEach((tbody) => {
        let subcategories = [];
        const tr = tbody.querySelector("tr:nth-of-type(2)");
        if (tr) {
            if (
                tr.querySelector(".td1") &&
                tr.querySelector(".td2 .text_speed_acc")
            ) {
                subcategories.push({
                    name: tr.querySelector(".td1").innerText,
                    current: Number(
                        tr
                            .querySelector(".td2 .text_speed_acc")
                            .innerHTML.split(" ")[0]
                    ),
                    target: tr.querySelector(".td2 input").value
                        ? Number(tr.querySelector(".td2 input").value)
                        : null,
                });
            }

            if (
                tr.querySelectorAll(".td2")[1] &&
                tr.querySelector(".td3 .text_speed_acc")
            ) {
                subcategories.push({
                    name: tr.querySelectorAll(".td2")[1].innerText,
                    current: Number(
                        tr
                            .querySelector(".td3 .text_speed_acc")
                            .innerHTML.split(" ")[0]
                    ),
                    target: tr.querySelector(".td3 input").value
                        ? Number(tr.querySelector(".td3 input").value)
                        : null,
                });
            }
        }

        categories.push({
            name: tbody.querySelector(".headtitle-table-tr .headtitle-table")
                .innerText,
            subcategories,
        });
    });

    if (categories.some((c) => c.subcategories?.length > 0)) {
        let goal = {
            goalId,
            categories,
        };

        // Send the goal data to the server
        fetch("updateGoalCategories.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(goal),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    openLightbox(
                        "error",
                        data.error,
                        `edit_goal_categories.php?id=${goalId}`
                    );
                } else {
                    sessionStorage.clear();
                    openLightbox(
                        "success",
                        "Goal updated successfully!",
                        "my_goals.php"
                    );
                }
            });
    } else {
        openLightbox(
            "error",
            "You must fill at least one goal!",
            `edit_goal_categories.php?id=${goalId}`
        );
    }
});
