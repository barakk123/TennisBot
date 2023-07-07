fetch('categories.json')
    .then(response => response.json())
    .then(data => {
        const selectElement = document.getElementById('date-myGoals');

        data.categories.forEach(category => {
            let optionElement = document.createElement('option');
            optionElement.value = category;
            optionElement.textContent = category;

            selectElement.appendChild(optionElement);
        });

        updateStrikeList('');
    });

    function updateStrikeList(category) {
        fetch(`getStrikesByCategory.php?category=${category}`)
            .then(response => response.json())
            .then(data => {
                const tableElement = document.querySelector('.tableChooseCategory table');
    
                // Clear the table first
                tableElement.innerHTML = '';
    
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
                        tbodyElement = document.createElement('tbody');
                        tbodyElement.className = 'tr_wrapper';
    
                        // Create the header row
                        let headerRowElement = document.createElement('tr');
                        headerRowElement.className = 'headtitle-table-tr';
    
                        let headerCellElement = document.createElement('td');
                        headerCellElement.colSpan = 4; // the header cell spans all 4 columns
                        headerCellElement.innerHTML = `<div class="headtitle-table">${strike.category_name}</div>`;
                        headerRowElement.appendChild(headerCellElement);
                        tbodyElement.appendChild(headerRowElement);
    
                        // Create the first data row
                        dataRowElement = document.createElement('tr');
    
                        lastCategoryName = strike.category_name;
                        currentCol = 1;
                    }
    
                    let subcategoryCellElement = document.createElement('td');
                    subcategoryCellElement.className = `td${currentCol}`;
                    subcategoryCellElement.textContent = `${strike.subcategory_name}`;
                    dataRowElement.appendChild(subcategoryCellElement);
    
                    let skillCellElement = document.createElement('td');
                    skillCellElement.className = `td${currentCol+1}`;
                    let skillValueNumber = Number(strike.skill_value);
    
                    if(currentCol === 1) {
                        skillCellElement.innerHTML = `<div class="text_speed_acc">${skillValueNumber} -></div><input id="s${index+1}" type="number" min="${skillValueNumber + 1}" oninput="validateInput('s${index+1}')" required>%`;
                    } else {
                        skillCellElement.innerHTML = `<div class="text_speed_acc">${skillValueNumber} -></div><input id="s${index+1}" type="number" min="${skillValueNumber + 1}" oninput="validateInput('s${index+1}')" required>Km/h`;
                    }
                    dataRowElement.appendChild(skillCellElement);
    
                    if (currentCol === 2) {
                        tbodyElement.appendChild(dataRowElement);
                        dataRowElement = document.createElement('tr'); // create a new row for the next subcategory
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
    



    