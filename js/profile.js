// profile.js
let bigContainer = document.createElement("div");
bigContainer.className = "big_container";

let profileDetailsPic = document.createElement("div");
profileDetailsPic.className = "profile_details_pic";

let profileDetails = document.createElement("div");
profileDetails.className = "profile_details";

let profileUnionContactNotic = document.createElement("div");
profileUnionContactNotic.className = "profile_union_contact_notic";

let profileUnion = document.createElement("div");
profileUnion.className = "profile_union";

let profileContact = document.createElement("div");
profileContact.className = "profile_contact";

let profileNotic = document.createElement("div");
profileNotic.className = "profile_notic";

// Fetching user details, union and contact data in order
async function fetchUserData() {
    // Fetching user details
    const responseDetails = await fetch("get_details.php");
    const dataDetails = await responseDetails.json();

    if (dataDetails.full_name) {
        let name = dataDetails.full_name.toLowerCase().split(' ').map(function(word) {
            return word.charAt(0).toUpperCase() + word.slice(1);
        }).join(' ');
        profileDetails.innerHTML += `<h2 class="title">${name}</h2>`;
    }
    
    if (dataDetails.birth_date) {
        profileDetails.innerHTML += `<div class="data">${calculateAge(
            dataDetails.birth_date
        )} years old (${mysqlDateToHuman(dataDetails.birth_date)})</div>`;
    }
    if (dataDetails.height) {
        profileDetails.innerHTML += `<div class="data">${dataDetails.height} cm</div>`;
    }
    if (dataDetails.weight) {
        profileDetails.innerHTML += `<div class="data">${dataDetails.weight} kg</div>`;
    }
    if (dataDetails.gender) {
        profileDetails.innerHTML += `<div class="data">${dataDetails.gender}</div>`;
    }
    if (dataDetails.potential) {
        profileDetails.innerHTML += `<div class="data">${dataDetails.potential}</div>`;
    }

    //profileDetailsPic.appendChild(profileDetails);

    // Fetching user union data
    const responseUnion = await fetch("get_union.php");
    const dataUnion = await responseUnion.json();

    if (dataUnion.experience || dataUnion.rank || dataUnion.registered_date) {
        profileUnion.innerHTML += `<h2 class="title">Union Data</h2>`;
    }
    if (dataUnion.experience) {
        profileUnion.innerHTML += `<div class="data"><b>Experience</b> ${
            dataUnion.experience == -1
                ? "Unknown yet"
                : dataUnion.experience + " Years"
        }</div>`;
    }
    if (dataUnion.rank) {
        profileUnion.innerHTML += `<div class="data">
            <b>Rank</b> ${dataUnion.rank == -1 ? "Unknown yet" : dataUnion.rank}
        </div>`;
    }
    if (dataUnion.team) {
        profileUnion.innerHTML += `<div class="data">
            <b>Team</b> ${dataUnion.rank == -1 ? "Unknown yet" : dataUnion.team}
        </div>`;
    }
    if (dataUnion.registered_date) {
        profileUnion.innerHTML += `<div class="data"><b>Registered Date</b> ${mysqlDateToHuman(
            dataUnion.registered_date
        )}</div>`;
    }

    //profileUnionContactNotic.appendChild(profileUnion);

    // Fetching user contact data
    const responseContact = await fetch("get_contact.php");
    const dataContact = await responseContact.json();

    profileContact.innerHTML = `
    <h2 class="title">Contact Details 
        <a href="updateProfile.php" class="my-goals-edit"">
            ✏️
        </a>
    </h2>
`;
    if (dataContact.phone) {
        profileContact.innerHTML += `<div class="data"><b>Phone</b> ${dataContact.phone}</div>`;
    }
    if (dataContact.city) {
        profileContact.innerHTML += `<div class="data"><b>City</b> ${dataContact.city}</div>`;
    }
    if (dataContact.emergency_phone) {
        profileContact.innerHTML += `<div class="data"><b>Emergency Phone</b> ${dataContact.emergency_phone}</div>`;
    }
    if (dataContact.email) {
        profileContact.innerHTML += `<div class="data"><b>Email</b> ${dataContact.email}</div>`;
    }

    //profileUnionContactNotic.appendChild(profileContact);
    //profileUnionContactNotic.appendChild(profileNotic); // this is empty for now

    profileDetailsPic.innerHTML = `
    <div class="profile_details_pic_wrapper">
    <img id="profile-image" class="profile-image" src="images/profile.jpeg" alt="your image" />
    <div class="fileInputWrapper">
        <input class="fileInput" type="file" onchange="readURL(this);" />Change
    </div>
    </div>
    `;

    profileDetailsPic.appendChild(profileDetails);
    profileUnionContactNotic.appendChild(profileUnion);
    profileUnionContactNotic.appendChild(profileContact);
}

fetchUserData(); // Call the function to start fetching data

bigContainer.appendChild(profileDetailsPic);
bigContainer.appendChild(profileUnionContactNotic);

let wrapper = document.querySelector(".wrapper");
wrapper.appendChild(bigContainer);

function calculateAge(birthDate) {
    let birth = new Date(birthDate);
    let today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    let m = today.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    return age;
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#profile-image").attr("src", e.target.result);
            saveUserImage();
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function saveUserImage() {
    const src = document.getElementById("profile-image").getAttribute("src");

    fetch("updateProfileImage.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            profile_pic: src,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.error) {
                openLightbox("error", data.error, "profile.php");
            } else {
                openLightbox(
                    "success",
                    "Profile image updated successfully!",
                    "profile.php"
                );
            }
        });
}
