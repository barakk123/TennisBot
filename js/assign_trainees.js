fetch('getNoCoachTrainees.php')
    .then(response => {
        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }
        return response.json();
    })
    .then(trainees => {
        const container = document.getElementById('traineeContainer');
        trainees.trainees.forEach(trainee => {
            const wrapperDiv = document.createElement('div');
            wrapperDiv.className = 'check-label';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.id = trainee.id; // Change this to the correct id field
            checkbox.name = 'trainee';

            const label = document.createElement('label');
            label.htmlFor = trainee.id; // Change this to the correct id field
            label.appendChild(document.createTextNode(trainee.full_name));

            wrapperDiv.appendChild(checkbox);
            wrapperDiv.appendChild(label);

            container.appendChild(wrapperDiv);
        });

        document.getElementById('saveButton').addEventListener('click', saveAssignments);
    })
    .catch(error => console.error(error));


function saveAssignments() {
    const checkboxes = document.getElementsByName('trainee');
    const selectedIds = [];
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            selectedIds.push(checkbox.id);
        }
    });

    fetch('saveTraineeAssignments.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(selectedIds),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Trainee assignments saved!');
            window.location.href = "trainees_list.php";
        } else {
            alert('Failed to save trainee assignments.');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
