"use strict";

//Variables

let portfolioEl = document.getElementById("printPortfolio");
let addPortfolioBtn = document.getElementById("addPortfolio");
let titleInput = document.getElementById("title");
let urlInput = document.getElementById("url");
let descriptionInput = document.getElementById("description");
let portfolioForm = document.getElementById("portfolioForm");
let portfolioIdInput = document.getElementById("portfolioId");

//Eventlisteners

window.addEventListener("load", getPortfolio);
portfolioForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (portfolioIdInput.value) {
        var id = portfolioIdInput.value;
        updatePortfolio(id);
    } else {
        addPortfolio();
    }
});

//Function to GET

function getPortfolio() {
    portfolioEl.innerHTML = "";
    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/portfolio.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(portfolio => {
                portfolioEl.innerHTML +=
                    `<div class="portfolio">
                    <p>${portfolio.title}</p>
                    <a target="_blank" href="${portfolio.url}">To website</a>
                    <p>${portfolio.description}</p>
                    <button id="${portfolio.id}" class="delete" onClick="deletePortfolio(${portfolio.id})">Delete</button>
                    <button id="${portfolio.id}" class="update" onClick="getElement(${portfolio.id})">Update</button>
                </div>`
            })
        })
}

//Function to ADD/POST

function addPortfolio() {
    let title = titleInput.value;
    let url = urlInput.value;
    let description = descriptionInput.value;

    let portfolio = { "title": title, "url": url, "description": description };

    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/portfolio.php", {
        method: "POST",
        body: JSON.stringify(portfolio),
    })

        .then(response => response.json())
        .then(data => {
            getPortfolio(); 
            titleInput.value = ""; 
            urlInput.value = "";
            descriptionInput.value = "";
        })
        .catch(error => {
            console.log("Error: ", error);
        })

}

//Function to DELETE

function deletePortfolio(id) {
    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/portfolio.php?id=" + id, {
        method: "DELETE",
    })
        .then(response => response.json())
        .then(data => {
            getPortfolio(); 
        })
        .catch(error => {
            console.log("Error: ", error);
        })
}

//Get element input values for update

function getElement(id) {

    addPortfolioBtn.value = "Update";

    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/portfolio.php?id=" + id)
        .then(response => response.json())
        .then(data => {
            data.forEach(portfolio => {
                portfolioIdInput.value = `${portfolio.id}`;
                titleInput.value = `${portfolio.title}`;
                urlInput.value = `${portfolio.url}`;
                descriptionInput.value = `${portfolio.description}`;
            });
        });
}

//Function to UPDATE

function updatePortfolio(id) {
    let index = portfolioIdInput.value;
    let title = titleInput.value;
    let url = urlInput.value;
    let description = descriptionInput.value;

    let portfolio = { "id": index, "title": title, "url": url, "description": description };

    addPortfolioBtn.value = "Add"; 

    fetch("http://studenter.miun.se/~aslo1900/dt173g_projekt_rest/portfolio.php?id=" + id, {
        method: "PUT",
        body: JSON.stringify(portfolio),
    })
        .then((response) => response.json())
        .then(data => {
            getPortfolio(); 
            titleInput.value = ""; 
            urlInput.value = "";
            descriptionInput.value = "";
            window.location.reload(); //Reload page after update
        })
        .catch((error) => {
            console.log("error: ", error);
        });
}