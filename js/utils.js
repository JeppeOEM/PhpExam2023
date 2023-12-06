function q(q, from = document) {
  return from.querySelector(q);
}
function qAll(q, from = document) {
  return from.querySelectorAll(q);
}

function show_page(page_id) {
  console.log(page_id);
  // Hide all the pages
  qAll(".page").forEach((page) => {
    page.classList.add("hidden");
  });
  // Show the one with the id
  q("#" + page_id).classList.remove("hidden");
}

function edit_profile() {
  var userNameInput = document.getElementById("user_name");
  var userEmailInput = document.getElementById("user_email");
  var userLastNameInput = document.getElementById("user_last_name");
  userNameInput.readOnly = !userNameInput.readOnly;
  userEmailInput.readOnly = !userEmailInput.readOnly;
  userLastNameInput.readOnly = !userLastNameInput.readOnly;
  q("#update_profile").remove("hidden");
}
