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

  localStorage.name = NameOfGoal;
  localStorage.startDate = startDate;
  localStorage.endDate = endDate;
  
}

function save() {
  let s1 = document.querySelector('#s1').value;
  let a1 = document.querySelector('#a1').value;
  let s2 = document.querySelector('#s2').value;
  let a2 = document.querySelector('#a2').value;
  let s3 = document.querySelector('#s3').value;
  let a3 = document.querySelector('#a3').value;
  let s4 = document.querySelector('#s4').value;
  let a4 = document.querySelector('#a4').value;
  let s5 = document.querySelector('#s5').value;
  let a5 = document.querySelector('#a5').value;

  let forHand = {
    startSpeed: 65,
    accuracyStart: 62,
    speed: s1,
    accuracy: a1,
  };
  
  let backHand = {
    startSpeed: 73,
    accuracyStart: 68,
    speed: s2,
    accuracy: a2,
  };

  let volley = {
    startSpeed: 92,
    accuracyStart: 59,
    speed: s3,
    accuracy: a3,
  };

  let slice = {
    startSpeed: 60,
    accuracyStart: 55,
    speed: s4,
    accuracy: a4,
  };

  let dropshot = {
    startSpeed: 50,
    accuracyStart: 47,
    speed: s5,
    accuracy: a5,
  }

  let jfh = JSON.stringify(forHand);
  let jbh = JSON.stringify(backHand);
  let jv = JSON.stringify(volley);
  let js = JSON.stringify(slice);
  let jd = JSON.stringify(dropshot);

  localStorage.forHand = jfh;
  localStorage.backHand = jbh;
  localStorage.volley = jv;
  localStorage.slice = js;
  localStorage.dropshot = jd;

  document.getElementById("mod").style.display = "block";

}

function go() {
  let name = localStorage.name;
  let startDate = localStorage.startDate;
  let endDate = localStorage.endDate;
  let forHand = localStorage.forHand;
  let backHand = localStorage.backHand;
  let volley = localStorage.volley;
  let slice = localStorage.slice;
  let dropshot = localStorage.dropshot;

  document.querySelector("body").innerHTML = `
    Name of Goal: ${name}
    <br>
    Start Date: ${startDate}
    <br>
    End Date: ${endDate}
    <br>
    Forhand: ${forHand}
    <br>
    Backhand: ${backHand}
    <br>
    Volley: ${volley}
    <br>
    Slice: ${slice}
    <br>
    Drop shot: ${dropshot}
  `;
}
