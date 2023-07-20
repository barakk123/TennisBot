const apiUrl = "get.php?coach_goals=1";

let skills;
let profile_id = document.getElementById("profile_id")?.value;

async function fetchGoals(sortOption = "Date") {
    // Default value is 'Date'
    const response = await fetch(`${apiUrl}?sortOption=${sortOption}`);
    const goals = await response.json();

    // clear existing goals before displaying sorted ones
    document.querySelector(".my-goals-table").innerHTML = "";

    const api = profile_id
        ? `getStrikesByCategory.php?id=${profile_id}`
        : `getStrikesByCategory.php`;

    fetch(api)
        .then((response) => response.json())
        .then((data) => {
            skills = data.strikes;
            for (const goal of goals) {
                if (goal.categories?.length) {
                    createGoalElement(goal);
                }
            }
        });
}

document.addEventListener("DOMContentLoaded", function () {
    fetch("indexSort.json")
        .then((response) => response.json())
        .then((data) => {
            const selectElement = document.getElementById("date-myGoals");

            data.Options.forEach((option) => {
                let optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.textContent = option;

                selectElement.appendChild(optionElement);
            });

            // Handle select change event
            selectElement.addEventListener("change", function () {
                // Fetch goals with the new sort option
                fetchGoals(this.value);
            });
        });
});

document.addEventListener("DOMContentLoaded", function () {
    if (!profile_id) {
        document.getElementById("add-goal-btn").remove();
    } else {
        const addGoalBtn = document.getElementById("add-goal-btn");
        const wrapperHead = document.getElementsByClassName("wrapper-head")[0];
        if (addGoalBtn) {
            // Add a click event listener to the button
            addGoalBtn.addEventListener("click", function () {
                var api = profile_id
                    ? `getUserCategories.php?id=${profile_id}`
                    : "getUserCategories.php";

                fetch(api)
                    .then((response) => response.json())
                    .then((categories) => {
                        // If there are no categories, display the lightbox

                        if (!categories?.length) {
                            // Display the lightbox
                            openLightbox(
                                "error",
                                "To create a goal, you must perform initial training with the robot",
                                //"index.php"
                                "#"
                            );
                            // Disable the button after clicking
                            addGoalBtn.setAttribute("disabled", "true");
                            // show the new "For Yonit" button here
                            var newButton = document.createElement("a"); // Create a new link element
                            newButton.innerHTML = "For Yonit"; // Set the text
                            newButton.href = "addToSkillTable.php"; // Set the target URL
                            newButton.classList.add("new-button-class"); // Set a CSS class if needed

                            wrapperHead.appendChild(newButton);
                        } else if (profile_id) {
                            window.location.href = `add_goal.php?id=${profile_id}`;
                        } else {
                            window.location.href = "add_goal.php";
                        }
                    });
            });
        }
    }
});

async function deleteGoal(id) {
    const response = await fetch(`delete_goal.php?id=${id}`, {
        method: "DELETE",
    });

    if (response.ok) {
        // Remove the goal element from the page
        const goalElement = document.querySelector(
            `.row-parent[data-id='${id}']`
        );
        goalElement.remove();
    } else {
        console.error("Failed to delete goal");
    }
}

function createGoalElement(goal) {
    let progressCurrentValue = getProgress(goal);

    let goalRowParentElement = document.createElement("div");
    goalRowParentElement.className = "row-parent";
    goalRowParentElement.dataset.id = goal.id;

    let goalColumn1Element = document.createElement("div");
    goalColumn1Element.className = "my-goals-column1";

    let goalTitle = document.createElement("div");
    goalTitle.className = "my-goals-goalTitle";
    goalTitle.textContent = goal.title;
    goalColumn1Element.appendChild(goalTitle);

    let goalDate = document.createElement("div");
    goalDate.className = "my-goals-goalDate";
    goalDate.textContent =
        mysqlDateToHuman(goal.start_date) +
        " - " +
        mysqlDateToHuman(goal.end_date);
    goalColumn1Element.appendChild(goalDate);

    goalRowParentElement.appendChild(goalColumn1Element);

    let goalColsParentElement = document.createElement("div");
    goalColsParentElement.className = "my-goals-cols-2-4-parent";

    for (const category of goal.categories) {
        if (category.subcategories?.length) {
            let categoryElement = createCategoryElement(category);
            goalColsParentElement.appendChild(categoryElement);
        }
    }

    goalRowParentElement.appendChild(goalColsParentElement);
    // Column 5
    let goalColumn5Element = document.createElement("div");
    goalColumn5Element.className = "my-goals-column5";

    if (profile_id) {
        let editElement = document.createElement("a");
        editElement.className = "my-goals-edit";
        editElement.textContent = "✏️";
        editElement.href = `edit_goal.php?id=${goal.id}`;
        goalColumn5Element.appendChild(editElement);

        let deleteElement = document.createElement("a");
        deleteElement.className = "my-goals-delete";
        deleteElement.textContent = "🗑️";
        deleteElement.href = "#";
        deleteElement.onclick = function () {
            if (confirm("Are you sure you want to delete this goal?")) {
                deleteGoal(goal.id);
            }
        };
        goalColumn5Element.appendChild(deleteElement);
    }

    goalRowParentElement.appendChild(goalColumn5Element);

    // Column 6
    let goalColumn6Element = document.createElement("div");
    goalColumn6Element.className = "my-goals-column6";

    let statusElement = document.createElement("div");

    if (new Date(goal.end_date) < new Date()) {
        statusElement.innerText = "Failed";
        statusElement.style.color = "red";
        progresscolor = "bg-danger";
        progressCurrentValue = 100;
    } else if (progressCurrentValue === 100) {
        statusElement.innerText = "Completed";
        statusElement.style.color = "green";
        progresscolor = "bg-success";
    } else {
        statusElement.innerText = "In Progress";
        statusElement.style.color = "orange";
        progresscolor = "bg-warning";
    }

    let progressBootstrap = `
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated ${progresscolor}" role="progressbar" aria-valuenow="${progressCurrentValue}" aria-valuemin="0" aria-valuemax="100" style="width: ${progressCurrentValue}%">${progressCurrentValue}%</div>
        </div>
    `;

    goalColumn6Element.innerHTML += progressBootstrap;

    goalColumn6Element.appendChild(statusElement);

    goalRowParentElement.appendChild(goalColumn6Element);
    // Append the goal element to the goals table
    document.querySelector(".my-goals-table").appendChild(goalRowParentElement);
}

function createCategoryElement(category) {
    let categoryElement = document.createElement("div");
    categoryElement.className = "my-goals-cols-2-4";

    let categoryNameElement = document.createElement("div");
    categoryNameElement.className = "my-goals-column2";
    categoryNameElement.textContent = category.name;
    categoryElement.appendChild(categoryNameElement);

    let subcategoryParentElement = document.createElement("div");
    subcategoryParentElement.className = "my-goals-column3-4-parent";

    for (const subcategory of category.subcategories) {
        let subcategoryElement = createSubcategoryElement(subcategory);
        subcategoryParentElement.appendChild(subcategoryElement);
    }

    categoryElement.appendChild(subcategoryParentElement);

    return categoryElement;
}
function createSubcategoryElement(subcategory) {
    let subcategoryElement = document.createElement("div");
    subcategoryElement.className = "my-goals-column3-4";

    let subcategoryName = document.createElement("div");
    subcategoryName.className = "my-goals-column3";
    subcategoryName.innerHTML = subcategory.name;
    subcategoryElement.appendChild(subcategoryName);

    let subcategoryChange = document.createElement("div");
    subcategoryChange.className = "my-goals-column4";
    if (subcategory.name === "Avg. Speed") {
        subcategoryChange.innerHTML = `${subcategory.current} <small>Km/h</small> -> ${subcategory.target} <small>Km/h</small>`;
    } else if (subcategory.name === "Accuracy") {
        subcategoryChange.innerHTML = `${subcategory.current}<small>%</small> -> ${subcategory.target}<small>%</small>`;
    } else {
        subcategoryChange.innerHTML = `${subcategory.current} -> ${subcategory.target}`;
    }
    subcategoryElement.appendChild(subcategoryChange);

    return subcategoryElement;
}

// Fetch goals & skills on page load
fetchGoals();

function getProgress(goal) {
    let count = 0;
    let progress = 0;

    Array.from(goal.categories).forEach((c) => {
        c.subcategories.forEach((s) => {
            const start = +s.current;
            const target = +s.target;
            const current = +skills.find(
                (skill) =>
                    skill.subcategory_name === s.name &&
                    c.name === skill.category_name
            )?.skill_value;
            let sProgress = Math.min(
                ((current - start) / (target - start)) * 100,
                100
            );
            count++;
            progress += isNaN(sProgress) ? 100 : sProgress;
        });
    });

    const result = +(progress / count).toFixed(0);
    return result > 100 ? 100 : result;
}
