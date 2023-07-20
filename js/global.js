function validateInput(inputId) {
    const input = document.getElementById(inputId);
    input.setAttribute("touched", "true");

    if (input.min && input.max && Number(input.min) >= Number(input.max)) {
        input.setCustomValidity(
            `The value is invalid as it's grather than the max value or equal to the current skill value`
        );
    } else if (
        (input.value && Number(input.value) < Number(input.min)) ||
        (input.max && Number(input.value) > Number(input.max))
    ) {
        input.setCustomValidity(
            `Please enter a value between ${input.min} and ${input.max}.`
        );
    } else if (input.value && Number(input.value) < Number(input.min)) {
        input.setCustomValidity(`Please enter a value above ${input.min}.`);
    } else {
        input.setCustomValidity("");
    }
    input.reportValidity();
}

function mysqlDateToHuman(date) {
    const dateArr = date.split("-");
    return `${dateArr[2]}/${dateArr[1]}/${dateArr[0]}`;
}

function openLightbox(status, message, redirect) {
    const lightbox = document.getElementById("mod");
    if (!!redirect) {
        lightbox?.setAttribute("redirect", redirect);
    }
    if (lightbox && status && message) {
        lightbox.querySelector(".lightbox-text2 span").innerText = message;
        if (status === "success") {
            lightbox.querySelector("#v").style.display = "block";
            lightbox.querySelector("#x").style.display = "none";
        } else if (status === "error") {
            lightbox.querySelector("#v").style.display = "none";
            lightbox.querySelector("#x").style.display = "block";
        }
        lightbox.style.display = "block";
    }
}

function closeLightbox() {
    const lightbox = document.getElementById("mod");
    if (lightbox) {
        lightbox.style.display = "none";
        lightbox.querySelector(".lightbox-text2 span").innerText = "";
        if (lightbox.querySelector("#v").style.display == "block") {
            lightbox.querySelector("#v").style.display == "none";
        } else if (lightbox.querySelector("#x").style.display == "block") {
            lightbox.querySelector("#x").style.display == "none";
        }

        const redirect = lightbox.getAttribute("redirect");
        if (redirect) {
            window.location = redirect;
        }
    }
}

document.getElementById("hamburger").addEventListener("click", function (e) {
    e.preventDefault();
    var mySidenav = document.getElementById("mySidenav");
    var overlay = document.getElementById("overlay_ham");

    if (mySidenav.style.width == "0%") {
        mySidenav.style.width = "80%";
        overlay.style.display = "block"; // Hide the overlay when menu is closed
    } else {
        mySidenav.style.width = "0%";
        overlay.style.display = "none"; // Show the overlay when menu is opened
    }
});

// Close the menu when the overlay is clicked
document.getElementById("overlay_ham").addEventListener("click", function (e) {
    e.preventDefault();
    var mySidenav = document.getElementById("mySidenav");
    var overlay = document.getElementById("overlay_ham");

    if (mySidenav.style.width == "80%") {
        mySidenav.style.width = "0";
        overlay.style.display = "none";
    }
});

var pPic = document.querySelector('input[name="profile_pic"]')?.value;
if (pPic) {
    document
        .querySelectorAll(".profile_image")
        .forEach((elm) => elm.setAttribute("src", pPic));
}
