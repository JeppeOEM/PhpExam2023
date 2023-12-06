async function signup(event) {
  console.log(event);
  const frm = event.target;
  console.log(frm);
  const conn = await fetch("/api/api-signup.php", {
    method: "POST",
    body: new FormData(frm),
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
    location.href = "/";
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
    show_page("profile");
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
    q("#update_profile").classList.remove("hidden");
    q("#edit_profile").classList.add("hidden");
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

q("#edit_profile").addEventListener("click", () => {
  console.log("lol");
  edit_profile();
});

function edit_profile() {
  var userNameInput = document.getElementById("user_name");
  var userEmailInput = document.getElementById("user_email");
  var userLastNameInput = document.getElementById("user_last_name");
  userNameInput.readOnly = false;
  userEmailInput.readOnly = false;
  userLastNameInput.readOnly = false;
  q("#update_profile").classList.remove("hidden");
}
