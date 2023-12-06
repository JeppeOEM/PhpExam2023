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
  }

  // TODO: redirect to the login page
  // location.href = "/index";
}

async function logout(event) {
  // console.log(event.form, "formmmmmm");
  const frm = event.target;
  console.log(frm);
  event.preventDefault();
  const conn = await fetch("/api/api-logout.php", {
    method: "GET",
  });

  const data = await conn.text();
  console.log(data);

  if (!conn.ok) {
    Swal.fire({
      icon: "error",
      title: "Invalid credentials",
      text: "logout unsuccesfull",
      // footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  }
}
