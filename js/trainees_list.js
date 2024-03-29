let currentSort = { column: null, order: "asc" };
let currentFilters = { name: "", genders: [], potentials: [] };
let allData = [];

let columns = [
    { class: "column-name", id: "colN", text: "Full Name" },
    { class: "column-birthdate", id: "colB", text: "Birth Date" },
    { class: "column-age", id: "colA", text: "Age" },
    { class: "column-gender", id: "colG", text: "Gender" },
    { class: "column-potential", id: "colP", text: "Potential" },
    { class: "column-team", id: "colT", text: "Team" },
    { class: "column-actions", id: "colAc", text: "Actions" },
];

function sortTable(data, column, order) {
    data.sort((a, b) => {
        let valueA = a[column.toLowerCase().replace(/ /g, "_")];
        let valueB = b[column.toLowerCase().replace(/ /g, "_")];

        // Special handling for certain columns
        if (column === "Age") {
            valueA = new Date(a["birth_date"]);
            valueB = new Date(b["birth_date"]);
        } else if (column === "Potential") {
            const potentials = ["Uncertain", "Low", "Moderate", "High", "Top"];
            valueA = potentials.indexOf(valueA);
            valueB = potentials.indexOf(valueB);
        }

        if (order === "asc") {
            return valueA > valueB ? 1 : -1;
        } else {
            return valueA < valueB ? 1 : -1;
        }
    });

    // Update header text
    columns.forEach((col) => {
        let th = document.getElementById(col.id);
        if (col.text === column) {
            if (order === "asc") {
                th.textContent = column + " ▲";
            } else {
                th.textContent = column + " ▼";
            }
        } else if (
            th.textContent.includes("▲") ||
            th.textContent.includes("▼")
        ) {
            th.textContent = col.text; // Reset other headers
        }
    });

    // Clear existing table
    let tableContainer = document.querySelector("#tableContainer");
    tableContainer.innerHTML = "";

    // Re-render table with sorted data
    renderTable(data);
}

function renderTable(data) {
    let myTable = document.createElement("table");
    myTable.className = "my-table";

    let thead = document.createElement("thead");
    let headerRow = document.createElement("tr");

    columns.forEach((column) => {
        let th = document.createElement("th");
        th.className = column.class;
        th.id = column.id;

        if (currentSort.column === column.text) {
            th.textContent =
                column.text + (currentSort.order === "asc" ? " ▲" : " ▼");
        } else {
            th.textContent = column.text;
        }

        th.addEventListener("click", () => {
            if (column.text === "Gender" || column.text === "Actions") {
                // Skip sorting for these columns
                return;
            }

            let newOrder = "asc";
            if (
                currentSort.column === column.text &&
                currentSort.order === "asc"
            ) {
                newOrder = "desc";
            }

            currentSort = { column: column.text, order: newOrder };
            sortTable(data, column.text, newOrder);
        });

        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    myTable.appendChild(thead);

    // ...rest of the code...

    let tbody = document.createElement("tbody");

    // Fill the table with data from the PHP file
    data.forEach((item) => {
        let tr = document.createElement("tr");

        columns.forEach((column) => {
            let td = document.createElement("td");
            td.className = column.class;
            if (column.class !== "column-actions") {
                let value = item[column.text.toLowerCase().replace(/ /g, "_")];

                if (column.class == "column-name") {
                    value = `<a href="profile.php?id=${item.id}">${value}</a>`;
                }

                if (column.class === "column-gender") {
                    value = value[0]; // Only take the first character of the gender value
                }

                if (column.class === "column-birthdate") {
                    value = mysqlDateToHuman(value); // Apply your date conversion function
                }

                td.innerHTML = value;
            } else {
                let actions = [
                    "Goals",
                    "Reports",
                    "Schedule",
                    "Notifications",
                    "Delete",
                ];
                actions.forEach((action) => {
                    let btn = document.createElement("button");
                    btn.className =
                        action.toLowerCase() === "delete"
                            ? "delete-btn"
                            : "edit-btn";
                    let a = document.createElement("a");
                    if (action === "Goals") {
                        a.href = `coach_goals.php?id=${item.id}`;
                    } else {
                        a.href = "#";
                    }
                    a.textContent = action; // Filling buttons with action text
                    btn.appendChild(a);
                    td.appendChild(btn);
                });
            }
            tr.appendChild(td);
        });

        tbody.appendChild(tr);
    });

    myTable.appendChild(tbody);

    // Append the table to the table container div
    let tableContainer = document.querySelector("#tableContainer");
    tableContainer.innerHTML = "";
    tableContainer.appendChild(myTable);

    // Create and append "Add Trainee" button
    createAddTraineeButton();
}

function createAddTraineeButton() {
    let tableContainer = document.querySelector("#tableContainer");
    let addTraineeBtn = document.createElement("button");
    addTraineeBtn.className = "addTraineeBtn";
    addTraineeBtn.textContent = "Add Trainee";
    addTraineeBtn.addEventListener("click", () => {
        window.location.href = "assign_trainees.php";
    });

    // Append "Add Trainee" button to the container
    tableContainer.appendChild(addTraineeBtn);
}

function filterData() {
    let filteredData = allData;

    // Apply name filter
    if (currentFilters.name) {
        filteredData = filteredData.filter((item) =>
            item.full_name
                .toLowerCase()
                .includes(currentFilters.name.toLowerCase())
        );
    }

    // Apply gender filter
    if (currentFilters.genders.length > 0) {
        filteredData = filteredData.filter((item) =>
            currentFilters.genders.includes(item.gender)
        );
    }

    // Apply potential filter
    if (currentFilters.potentials.length > 0) {
        filteredData = filteredData.filter((item) =>
            currentFilters.potentials.includes(item.potential.toString())
        );
    }


    renderTable(filteredData);
}

document.getElementById("name-search").addEventListener("input", (event) => {
    currentFilters.name = event.target.value;
    filterData();
});

document.querySelectorAll(".age-box input[type='checkbox']").forEach((input) => {
    input.addEventListener("change", (event) => {
        if (event.target.checked) {
            currentFilters.genders.push(event.target.value);
        } else {
            const index = currentFilters.genders.indexOf(event.target.value);
            if (index > -1) {
                currentFilters.genders.splice(index, 1);
            }
        }
        filterData();
    });
});

document.querySelectorAll(".pot-box input[type='checkbox']").forEach((input) => {
    input.addEventListener("change", (event) => {
        if (event.target.checked) {
            currentFilters.potentials.push(event.target.value);
        } else {
            const index = currentFilters.potentials.indexOf(event.target.value);
            if (index > -1) {
                currentFilters.potentials.splice(index, 1);
            }
        }
        filterData();
    });
});

fetch("getTrainees.php")
    .then((response) => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        return response.text();
    })
    .then((text) => {
        allData = JSON.parse(text);
        if (allData.length > 0) {
            renderTable(allData);
        } else {
            createAddTraineeButton();
        }
    })
    .catch((error) => console.error(error));

