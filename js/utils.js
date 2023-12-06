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

// q("#logout").addEventListener("submit", function (event) {
//   // Prevent the default form submission
//   event.preventDefault();

//   // Perform any additional actions you need before logout, if any

//   // Redirect to the logout API endpoint using JavaScript
//   window.location.href = "/";
// });
