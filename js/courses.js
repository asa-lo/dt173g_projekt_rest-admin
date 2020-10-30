"use strict";

//Variables

let coursesEl = document.getElementById("printCourses");
let addCoursesBtn = document.getElementById("addCourses");
let schoolInput = document.getElementById("school");
let courseNameInput = document.getElementById("courseName");
let dateInput = document.getElementById("date");
let coursesForm = document.getElementById("coursesForm");
let coursesIdInput = document.getElementById("coursesId");

//Eventlisteners

window.addEventListener("load", getCourses);
coursesForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (coursesIdInput.value) {
        var id = coursesIdInput.value;
        updateCourses(id);
    } else {
        addCourses();
    }
});

//Function to GET courses

function getCourses() {
    coursesEl.innerHTML = "";
    fetch("courses.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(courses => {
                coursesEl.innerHTML +=
                    `<div class="courses">
                    <p>${courses.school}</p>
                    <p>${courses.courseName}</p>
                    <p>${courses.date}</p>
                    <button id="${courses.id}" class="delete" onClick="deleteCourses(${courses.id})">Delete</button>
                    <button id="${courses.id}" class="update" onClick="getElementCourses(${courses.id})">Update</button>
                </div>`
            })
        })
}

//Function to ADD/POST

function addCourses() {
    let school = schoolInput.value;
    let courseName = courseNameInput.value;
    let date = dateInput.value;

    let courses = { "school": school, "coursename": courseName, "date": date };

    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/courses.php", {
        method: "POST",
        body: JSON.stringify(courses),
    })

    .then(response => response.json())
        .then(data => {
            getCourses(); // Update content
            schoolInput.value = ""; // Empty inputs
            courseNameInput.value = "";
            dateInput.value = "";
        })
        .catch(error => {
            console.log("Error: ", error);
        })

}

// Function to DELETE

function deleteCourses(id) {
    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/courses.php?id=" + id, {
            method: "DELETE",
        })
        .then(response => response.json())
        .then(data => {
            getCourses(); // Update content
        })
        .catch(error => {
            console.log("Error: ", error);
        })
}

// Get courses element input values for update

function getElementCourses(id) {
    addCoursesBtn.value = "Update"; 
    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/courses.php?id=" + id)
    
        .then(response => response.json())
        .then(data => {
            data.forEach(courses => {
                coursesIdInput.value = `${courses.id}`;
                schoolInput.value = `${courses.school}`;
                courseNameInput.value = `${courses.courseName}`;
                dateInput.value = `${courses.date}`;
            });
        });
}

//Function to UPDATE

function updateCourses(id) {
    let index = coursesIdInput.value;
    let school = schoolInput.value;
    let courseName = courseNameInput.value;
    let date = dateInput.value;

    let courses = { "id": index, "school": school, "coursename": courseName, "date": date };

    addCoursesBtn.value = "Add"; 

    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/courses.php?id=" + id, {
            method: "PUT",
            body: JSON.stringify(courses),
        })
        .then((response) => response.json())
        .then(data => {
            getCourses(); 
            schoolInput.value = ""; 
            courseNameInput.value = "";
            dateInput.value = "";
            window.location.reload(); //Reload page after update
        })
        .catch((error) => {
            console.log("error: ", error);
        });
}