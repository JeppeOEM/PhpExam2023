async function search_user(event) {
  event.preventDefault();
  const frm = event.target;
  const formData = new FormData(frm);
  formData.forEach((value, key) => {
    console.log(`key${key}: value${value}`);
  });

  const response = await fetch("/api/api-search.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.text();
  console.log(data);

  if (!response.ok) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
      footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  } else {
    console.log("form");
  }
}

async function user_signup(event) {
  event.preventDefault();
  const frm = event.target;
  const formData = new FormData(frm);
  formData.forEach((value, key) => {
    console.log(`key${key}: value${value}`);
  });

  const response = await fetch("/api/api-signup.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.text();
  console.log(data);

  if (!response.ok) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
      footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  } else {
    console.log("form");
    show_page("login");
  }

  // TODO: redirect to the login page
  // location.href = "/index";
}

async function total_price(products) {
  // const restaurant_id = event.currentTarget.id;
  try {
    const response = await fetch(`/api/api-total-price.php`, {
      method: "POST",
      body: JSON.stringify({ products }),
    });
    const data = await response.text();
    return data;
  } catch (error) {
    console.log(error);
  }
}

async function login(event) {
  // console.log(event.form, "formmmmmm");
  const frm = event.target;
  console.log(frm);
  event.preventDefault();
  const response = await fetch("/api/api-login.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await response.text();
  console.log(data);

  if (!response.ok) {
    Swal.fire({
      icon: "error",
      title: "Invalid credentials",
      text: "Username or password is wrong",
      // footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  } else {
    location.href = "/";
  }
}

async function update(event) {
  // console.log(event.form, "formmmmmm");
  const frm = event.target;
  console.log(frm);
  event.preventDefault();
  const response = await fetch("/api/api-update-user.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await response.text();
  console.log(data);

  if (!response.ok) {
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

async function get_restaurants() {
  try {
    const response = await fetch("api/api-get-restaurants.php");
    const data = await response.json();
    console.log(data);
    return data;
  } catch (error) {
    console.error("Error:", error.message);
  }
}

async function get_products(event, restaurant_name, restaurant_id) {
  console.log("GOT THE restaurant_name", restaurant_name);
  // const restaurant_id = event.currentTarget.id;
  try {
    const response = await fetch(`/api/api-get-products.php?restaurant_id=${restaurant_id}?`);
    const data = await response.text();
    console.log(JSON.parse(data), "data");
    build_products(JSON.parse(data), restaurant_name, restaurant_id);
    show_page("restaurant");
  } catch (error) {
    console.log(error);
  }
}

async function order_products(restaurant_id, total_products) {
  const response = await fetch("/api/api-order.php", {
    method: "POST",
    body: JSON.stringify({ total_products, restaurant_id }),
  });
  console.log(JSON.stringify({ total_products, restaurant_id }), "JSONSSSSSSS");
  const data = await response.text();
  console.log(data, "response fucking data");
  if (!response.ok) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Something went wrong, could not place order",
      // footer: '<a href="">Why do I have this issue?</a>',
    });
  } else if (response.ok) {
    Swal.fire({
      icon: "success",
      title: "Success",
      text: "Your order has been placed",
      // footer: '<a href="">Why do I have this issue?</a>',
    });
    item_count("cart");
    return data;
  }
}

async function get_orders(user, restaurant_id = null) {
  try {
    const response = await fetch("/api/api-get-orders.php", {
      method: "POST",
      body: JSON.stringify({ user, restaurant_id }),
    });

    const data = await response.json();

    return data;
  } catch (error) {
    console.log(error);
    show_page("page404");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  q("#order_products").addEventListener("click", (event) => {
    const total_items = JSON.parse(localStorage.getItem("cart"));
    const restaurant_id = q(".restaurant_title").id;

    console.log(total_items, "rest");
    if (total_items.length !== 0) {
      order_products(restaurant_id, total_items);
    }
    empty_cart();
  });

  q("#edit_profile").addEventListener("click", () => {
    console.log("lol");
    edit_profile();
  });

  q(".change_signup_user").addEventListener("click", () => {
    const textPartner = q("#text_partner");
    const textUser = q("#text_user");
    textPartner.classList.remove("hidden");
    textUser.classList.add("hidden");
    const role = (q("#user_role_input").value = "user");
    q("#signup_legend").innerText = "user";
    q("#signup_restaurant_name").classList.add("hidden");
  });

  q(".change_signup_partner").addEventListener("click", () => {
    const textPartner = q("#text_partner");
    const textUser = q("#text_user");
    textUser.classList.remove("hidden");
    textPartner.classList.add("hidden");
    const role = (q("#user_role_input").value = "partner");
    q("#signup_legend").innerText = "partner";
    q("#signup_restaurant_name").classList.remove("hidden");
  });

  // qAll(".change_signup").forEach((btn) => {
  //   btn.addEventListener("click", () => {
  //     const textPartner = q("#text_partner");
  //     const textUser = q("#text_user");
  //     const role = q("#user_role_input");
  //     let role_value = role.value;
  //     role.value = role.value === "user" ? "partner" : "user";
  //     console.log(role.value);
  //     q("#signup_legend_var").innerText = role_value;
  //     // Toggle the "hidden" class for both spans
  //     textPartner.classList.toggle("hidden");
  //     textUser.classList.toggle("hidden");
  //     q(".restaurant_name").classList.toggle("hidden");
  //   });
  // });

  function edit_profile() {
    const user_name = document.getElementById("user_name");
    const user_email = document.getElementById("user_email");
    const user_last_name = document.getElementById("user_last_name");
    user_name.readOnly = false;
    user_email.readOnly = false;
    user_last_name.readOnly = false;
    q("#update_profile").classList.remove("hidden");
    q("#edit_profile").classList.add("hidden");
  }

  // EVENT LISTENERS AND BUTTONS

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
