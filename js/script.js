const apiUrl = 'get.php'; 

async function fetchGoals() {
    const response = await fetch(apiUrl);
    const goals = await response.json();

    for (const goal of goals) {
        createGoalElement(goal);
    }
}

async function deleteGoal(id) {
  const response = await fetch(`delete_goal.php?id=${id}`, {
      method: 'DELETE'
  });

  if (response.ok) {
      // Remove the goal element from the page
      const goalElement = document.querySelector(`.row-parent[data-id='${id}']`);
      goalElement.remove();
  } else {
      console.error('Failed to delete goal');
  }
}

function createGoalElement(goal) {
    let goalRowParentElement = document.createElement('div');
    goalRowParentElement.className = 'row-parent';
    goalRowParentElement.dataset.id = goal.id;

    let goalColumn1Element = document.createElement('div');
    goalColumn1Element.className = 'my-goals-column1';

    let goalTitle = document.createElement('div');
    goalTitle.className = 'my-goals-goalTitle';
    goalTitle.textContent = goal.title;
    goalColumn1Element.appendChild(goalTitle);

    let goalDate = document.createElement('div');
    goalDate.className = 'my-goals-goalDate';
    goalDate.textContent = goal.start_date + ' - ' + goal.end_date;
    goalColumn1Element.appendChild(goalDate);

    goalRowParentElement.appendChild(goalColumn1Element);

    let goalColsParentElement = document.createElement('div');
    goalColsParentElement.className = 'my-goals-cols-2-4-parent';

    for (const category of goal.categories) {
        let categoryElement = createCategoryElement(category);
        goalColsParentElement.appendChild(categoryElement);
    }

    goalRowParentElement.appendChild(goalColsParentElement);
    // Column 5
    let goalColumn5Element = document.createElement('div');
    goalColumn5Element.className = 'my-goals-column5';

    let editElement = document.createElement('a');
    editElement.className = 'my-goals-edit';
    editElement.textContent = '✏️';
    editElement.href = `/edit_goal.php?id=${goal.id}`;  // Assuming your edit page is 'edit_goal.php'
    goalColumn5Element.appendChild(editElement);


    let deleteElement = document.createElement('a');
    deleteElement.className = 'my-goals-delete';
    deleteElement.textContent = '🗑️';
    deleteElement.href = '#';
    deleteElement.onclick = function() {
        if (confirm('Are you sure you want to delete this goal?')) {
            deleteGoal(goal.id);
        }
    };
    goalColumn5Element.appendChild(deleteElement);


    goalRowParentElement.appendChild(goalColumn5Element);

    // Column 6
    let goalColumn6Element = document.createElement('div');
    goalColumn6Element.className = 'my-goals-column6';

    let progressElement = document.createElement('div');
    progressElement.className = 'my-goals-column6-val';
    progressElement.textContent = goal.progress + '%'; // assuming progress is a number
    goalColumn6Element.appendChild(progressElement);

    let statusElement = document.createElement('div');
    statusElement.textContent = goal.status;
    goalColumn6Element.appendChild(statusElement);

    goalRowParentElement.appendChild(goalColumn6Element);
    // Append the goal element to the goals table
    document.querySelector('.my-goals-table').appendChild(goalRowParentElement);
}

function createCategoryElement(category) {
  let categoryElement = document.createElement('div');
  categoryElement.className = 'my-goals-cols-2-4';

  let categoryNameElement = document.createElement('div');
  categoryNameElement.className = 'my-goals-column2';
  categoryNameElement.textContent = category.name;
  categoryElement.appendChild(categoryNameElement);

  let subcategoryParentElement = document.createElement('div');
  subcategoryParentElement.className = 'my-goals-column3-4-parent';

  for (const subcategory of category.subcategories) {
      let subcategoryElement = createSubcategoryElement(subcategory);
      subcategoryParentElement.appendChild(subcategoryElement);
  }

  categoryElement.appendChild(subcategoryParentElement);
  
  return categoryElement;
}

function createSubcategoryElement(subcategory) {
  let subcategoryElement = document.createElement('div');
  subcategoryElement.className = 'my-goals-column3-4';

  let subcategoryName = document.createElement('div');
  subcategoryName.className = 'my-goals-column3';
  subcategoryName.textContent = subcategory.name;
  subcategoryElement.appendChild(subcategoryName);

  let subcategoryChange = document.createElement('div');
  subcategoryChange.className = 'my-goals-column4';
  subcategoryChange.textContent = subcategory.current + ' -> ' + subcategory.target;
  subcategoryElement.appendChild(subcategoryChange);

  return subcategoryElement;
}

// Fetch goals on page load
fetchGoals();