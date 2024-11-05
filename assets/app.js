import "./bootstrap.js";
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.css";

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");

let isFiltered = false;
document.getElementById("filterButton").addEventListener("click", function () {
  let messages = document.querySelectorAll(".messageList__message");
  let userName = document
    .querySelector("#userInfo")
    .getAttribute("data-username");

  if (!isFiltered) {
    messages.forEach(function (message) {
      if (message.getAttribute("data-recipient") !== String(userName)) {
        message.style.display = "none"; // Hide messages not addressed to the user
      }
    });
    isFiltered = true;
  } else {
    messages.forEach(function (message) {
      message.style.display = ""; 
      isFiltered = false;
    });
  }
});
