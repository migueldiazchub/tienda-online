"use strict";

const form = document.getElementById("signup-form");

form.addEventListener("submit", function (e) {});

function checkEmpty(value) {
  if (value == "") {
    return true;
  } else {
    return false;
  }
}

function validateEmail(email) {
  const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
  if (emailRegex.test(email)) {
    return true;
  } else {
    return false;
  }
}

/* 
  error conditions:
  -input is empty
  -email has invalid format
  -passwords don't match
  -username already exists

  optional:
  -secure password
*/
