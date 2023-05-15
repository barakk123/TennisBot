document.getElementById("mod").style.visibility="hidden";

function complete(){
    localStorage.clear();
let NameOfGoal = document.querySelector('#nameOfGoal').value;
let startDate = document.querySelector('#startDate').value;
let  endDate = document.querySelector('#endDate').value;

console.log(NameOfGoal, startDate, endDate);

localStorage.name = NameOfGoal;
localStorage.startDate = startDate;
localStorage.endDate = endDate;

console.log(localStorage);

}

function save(){
let s1 = document.querySelector('#s1').value;
let a1 = document.querySelector('#a1').value;

let forHand ={
startSpeed: 65,    
speed: s1,
averageSpeed: a1,
}
let jfh= JSON.stringify(forHand);

localStorage.forHand= jfh;

console.log(localStorage);

document.getElementById("mod").style.visibility="visible";

}


function go(){
let name = localStorage.name;
let startDate = localStorage.startDate;

document.querySelector("body").innerHTML=`
name: ${name}
<br>
Start Date: ${startDate}
`;

}