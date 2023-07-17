fetch('getTrainees.php')
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        return response.json();
    })
    .then(data => {
        
        let myTable = document.createElement('table');
        myTable.className = "my-table";

        let thead = document.createElement('thead');
        let headerRow = document.createElement('tr');

        let columns = [
            { class: "column-name", id: "colN", text: "Full Name" },
            { class: "column-birthdate", id: "colB", text: "Birth Date" },
            { class: "column-age", id: "colA", text: "Age" },
            { class: "column-gender", id: "colG", text: "Gender" },
            { class: "column-potential", id: "colP", text: "Potential" },  // change this line
            { class: "column-team", id: "colT", text: "Team" },
            { class: "column-actions", id: "colAc", text: "Actions" },
        ];

        columns.forEach(column => {
            let th = document.createElement('th');
            th.className = column.class;
            th.id = column.id;
            th.textContent = column.text;
            headerRow.appendChild(th);
        });

        thead.appendChild(headerRow);
        myTable.appendChild(thead);

        let tbody = document.createElement('tbody');

        // Fill the table with data from the PHP file
        data.forEach(item => {
            let tr = document.createElement('tr');

            columns.forEach(column => {
                let td = document.createElement('td');
                td.className = column.class;
                if (column.class !== "column-actions") {
                    let value = item[column.text.toLowerCase().replace(/ /g, "_")];
                    
                    if (column.class === "column-gender") {
                        value = value[0]; // Only take the first character of the gender value
                    }

                    if (column.class === "column-birthdate") {
                        value = mysqlDateToHuman(value); // Apply your date conversion function
                    }

                    td.textContent = value;
                } else {
                    let actions = ["Goals", "Reports", "Schedule", "Notifications", "Delete"];
                    actions.forEach(action => {
                        let btn = document.createElement('button');
                        btn.className = action.toLowerCase() === 'delete' ? "delete-btn" : "edit-btn";
                        let a = document.createElement('a');
                        a.href = "#";
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
        let tableContainer = document.querySelector('#tableContainer');
        tableContainer.appendChild(myTable);
    })
    .catch(error => console.error(error));
