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
    show_page("restaurants");
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

async function order_products(order) {
  const response = await fetch("/api/api-order.php", {
    method: "POST",
    body: JSON.stringify(order),
  });
  const data = await response.text();
  if (!response.ok) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Something went wrong, could not place order",
      // footer: '<a href="">Why do I have this issue?</a>',
    });
  } else {
    Swal.fire({
      icon: "success",
      title: "Success",
      text: "Your order has been placed",
      // footer: '<a href="">Why do I have this issue?</a>',
    });
    return data;
  }
}

async function get_products(event) {
  const restaurant_id = event.currentTarget.id;
  try {
    const response = await fetch("/api/api-get-products.php", {
      method: "POST",
      body: JSON.stringify({ restaurant_id: restaurant_id }),
    });
    const data = await response.text();
    console.log(JSON.parse(data), "data");
    build_products(JSON.parse(data));
    show_page("restaurant");
  } catch (error) {
    console.log(error);
  }
}

async function build_products(products) {
  console.log(products);
  const product = q("#product_grid");

  sorted = sort_az(products.products, "product_name");

  sorted.forEach((product) => {
    const template = q("#product_article");
    const clone = template.content.cloneNode(true);
    q(".product_name", clone).innerText = product.product_name;
    q(".price", clone).innerText = product.price;
    let buy_btn = q(".buy", clone);
    buy_btn.id = product.product_id;
    buy_btn.addEventListener("click", (event) => {
      event.preventDefault();
      console.log("wow");
      console.log("ddd", buy_btn.id);
      add_to_cart("cart", buy_btn.id);
      console.log(localStorage.getItem("cart"));
    });
    product_grid.appendChild(clone);
  });
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

document.addEventListener("DOMContentLoaded", function () {
  q("#order_products").addEventListener("click", () => {
    const order = localStorage.getItem("cart");
    console.log(order);
    order_products(order);
  });

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
