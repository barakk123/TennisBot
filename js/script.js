document.getElementById("mod").style.display = "none";

$(document).ready(function() {
  $('.form-timeline-chooseCategory').click(function(e) {
    e.preventDefault();
    $('#mod').addClass('show');
  });

  // Function to close the lightbox
  function closeLightbox() {
    $('#mod').removeClass('show');
  }

  // Add an event listener to close the lightbox when the overlay is clicked
  $('.overlay').click(closeLightbox);
  // Add an event listener to close the lightbox when the "OK" button is clicked
  $('.lightbox-button button').click(closeLightbox);
});

function complete() {
  localStorage.clear();
  let NameOfGoal = document.querySelector('#nameOfGoal').value;
  let startDate = document.querySelector('#startDate').value;
  let endDate = document.querySelector('#endDate').value;

  console.log(NameOfGoal, startDate, endDate);

  localStorage.name = NameOfGoal;
  localStorage.startDate = startDate;
  localStorage.endDate = endDate;

  console.log(localStorage);
}

function save() {
  let s1 = document.querySelector('#s1').value;
  let a1 = document.querySelector('#a1').value;

  let forHand = {
    startSpeed: 65,
    speed: s1,
    averageSpeed: a1,
  };

  let jfh = JSON.stringify(forHand);

  localStorage.forHand = jfh;

  console.log(localStorage);

  document.getElementById("mod").style.display = "block";
}

function go() {
  let name = localStorage.name;
  let startDate = localStorage.startDate;

  document.querySelector("body").innerHTML = `
    name: ${name}
    <br>
    Start Date: ${startDate}
  `;
}
