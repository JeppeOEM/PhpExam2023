async function user_signup(event) {
  // Prevent the default form submission
  event.preventDefault();

  // Access the form element
  const frm = event.target;

  // Create a FormData object from the form
  const formData = new FormData(frm);

  // Log all form values
  formData.forEach((value, key) => {
    console.log(`key${key}: value${value}`);
  });

  // The rest of your signup logic...

  const conn = await fetch("/api/api-signup.php", {
    method: "POST",
    body: formData,
  });

  const data = await conn.text();
  console.log(data);

  if (!conn.ok) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
      footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  } else {
    console.log("form");
    // location.href = "/";
  }

  // TODO: redirect to the login page
  // location.href = "/index";
}
async function login(event) {
  // console.log(event.form, "formmmmmm");
  const frm = event.target;
  console.log(frm);
  event.preventDefault();
  const conn = await fetch("/api/api-login.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.text();
  console.log(data);

  if (!conn.ok) {
    Swal.fire({
      icon: "error",
      title: "Invalid credentials",
      text: "Username or password is wrong",
      // footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  } else {
    show_page("restaurants");
  }

  // TODO: redirect to the login page
  // location.href = "/index";
}

// async function logout(event) {
//   // console.log(event.form, "formmmmmm");
//   const frm = event.target;
//   console.log(frm);
//   event.preventDefault();
//   const conn = await fetch("/api/api-logout.php", {
//     method: "GET",
//   });

//   const data = await conn.text();
//   console.log(data);

//   if (!conn.ok) {
//     Swal.fire({
//       icon: "error",
//       title: "Invalid credentials",
//       text: "logout unsuccesfull",
//       // footer: '<a href="">Why do I have this issue?</a>',
//     });
//     return;
//   }
// }

async function update(event) {
  // console.log(event.form, "formmmmmm");
  const frm = event.target;
  console.log(frm);
  event.preventDefault();
  const conn = await fetch("/api/api-update-user.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.text();
  console.log(data);

  if (!conn.ok) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Could not update the profile",
      // footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  } else {
    q("#update_profile").classList.add("hidden");
    q("#edit_profile").classList.remove("hidden");
    return data;
  }
}

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
  userNameInput.readOnly = false;
  userEmailInput.readOnly = false;
  userLastNameInput.readOnly = false;
  q("#update_profile").classList.remove("hidden");
  q("#edit_profile").classList.add("hidden");
}

// EVENT LISTENERS AND BUTTONS
document.addEventListener("DOMContentLoaded", function () {
  q("#edit_profile").addEventListener("click", () => {
    console.log("lol");
    edit_profile();
  });

  qAll(".change_signup").forEach((btn) => {
    btn.addEventListener("click", () => {
      const textPartner = q("#text_partner");
      const textUser = q("#text_user");
      const role = q("#user_role_input");
      let role_value = role.value;
      console.log(role);
      role_value === "user" ? (role_value = "partner") : (role_value = "user");
      role.value = role_value;
      q("#signup_legend_var").innerText = role_value;
      // Toggle the "hidden" class for both spans
      textPartner.classList.toggle("hidden");
      textUser.classList.toggle("hidden");
    });
  });

  // qAll(".change_signup").forEach((btn) => {
  //   btn.addEventListener("click", () => {
  //     const role = q("#user_role_input");
  //     let role_value = role.value;
  //     console.log(role);
  //     role_value === "user" ? (role_value = "partner") : (role_value = "user");
  //     console.log(role_value);
  //     role.value = role_value;
  //     // q("#text_partner").classList.toggle("hidded");
  //     console.log(q("#text_user").classList);
  //     let text = q("#text_user");
  //     text.classList.remove("hidded");
  //   });
  // });
});
