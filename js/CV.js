"use strict";

//Variables

let CVEl = document.getElementById("printCV");
let addCVBtn = document.getElementById("addCV");
let CVNameInput = document.getElementById("CVName");
let CVTitleInput = document.getElementById("CVTitle");
let CVDateInput = document.getElementById("CVDate");
let CVForm = document.getElementById("CVForm");
let CVIdInput = document.getElementById("CVId");

//Eventlisteners

window.addEventListener("load", getCV);
CVForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (CVIdInput.value) {
        var id = CVIdInput.value;
        updateCV(id);
    } else {
        addCV();
    }
});

//Function to GET

function getCV() {
    CVEl.innerHTML = "";
    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/cv.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(CV => {
                CVEl.innerHTML +=
                    `<div class="CV">
                    <p>${CV.name}</p>
                    <p>${CV.title}</p>
                    <p>${CV.date}</p>
                    <button id="${CV.id}" class="delete" onClick="deleteCV(${CV.id})">Delete</button>
                    <button id="${CV.id}" class="update" onClick="getElementCV(${CV.id})">Update</button>
                </div>`
            })
        })
}

//Function to ADD/POST

function addCV() {
    let name = CVNameInput.value;
    let title = CVTitleInput.value;
    let date = CVDateInput.value;

    let CV = { "name": name, "title": title, "date": date };

    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/cv.php", {
        method: "POST",
        body: JSON.stringify(CV),
    })
        .then(response => response.json())
        .then(data => {
            getCV(); // Update content
            CVNameInput.value = ""; // Empty inputs
            CVTitleInput.value = "";
            CVDateInput.value = "";
        })
        .catch(error => {
            console.log("Error: ", error);
        })
}

//Function to DELETE

function deleteCV(id) {
    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/cv.php?id=" + id, {
        method: "DELETE",
    })
        .then(response => response.json())
        .then(data => {
            getCV();
        })
        .catch(error => {
            console.log("Error: ", error);
        })
}

//Get the CV element input values for update

function getElementCV(id) {
    addCVBtn.value = "Update";
    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/cv.php?id=" + id)
        .then(response => response.json())
        .then(data => {
            data.forEach(CV => {
                CVIdInput.value = `${CV.id}`;
                CVNameInput.value = `${CV.name}`;
                CVTitleInput.value = `${CV.title}`;
                CVDateInput.value = `${CV.date}`;
            });
        });
}

//Update CV with changed input values

function updateCV(id) {
    let index = CVIdInput.value;
    let CVName = CVNameInput.value;
    let CVTitle = CVTitleInput.value;
    let CVDate = CVDateInput.value;

    let CV = { "id": index, "name": CVName, "title": CVTitle, "date": CVDate };

    addCVBtn.value = "Add";

    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/cv.php?id=" + id, {
        method: "PUT",
        body: JSON.stringify(CV),
    })
        .then((response) => response.json())
        .then(data => {
            getCV(); 
            CVNameInput.value = ""; 
            CVTitleInput.value = "";
            CVDateInput.value = "";
            window.location.reload(); //Reload page after update
        })
        .catch((error) => {
            console.log("error: ", error);
        });
}