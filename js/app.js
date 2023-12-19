async function is_email_available(event) {
  const frm = event.target.form;
  const response = await fetch("api/api-is-email-available.php", {
    method: "POST",
    body: new FormData(frm),
  });
  //!ok = everything that is not a 2xx
  if (!response.ok) {
    document.querySelector("#msg_email_not_available").classList.remove("hidden");
    return;
  }
}

async function last_page_tracking() {
  const page = sessionStorage.getItem("page");
  show_page(page);
}

async function user_signup(event) {
  event.preventDefault();
  const frm = event.target;
  const formData = new FormData(frm);
  formData.forEach((value, key) => {});

  const response = await fetch("/api/api-signup.php", {
    method: "POST",
    body: formData,
  });

  const data = await response.text();

  if (!response.ok) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
      footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  } else {
    show_page("login");
  }
}

async function total_price(id_array) {
  try {
    const response = await fetch(`/api/api-total-price.php`, {
      method: "POST",
      body: JSON.stringify({ products: id_array }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.log(error);
  }
}

async function login(event) {
  const frm = event.target;
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
  const frm = event.target;
  console.log(frm, "updated form");
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

    if (total_items.length !== 0) {
      order_products(restaurant_id, total_items);
    }
    empty_cart();
  });

  q("#edit_profile").addEventListener("click", () => {
    edit_profile();
  });

  q(".change_signup_user").addEventListener("click", () => {
    const textPartner = q("#text_partner");
    const textUser = q("#text_user_btn");
    textPartner.classList.remove("hidden");
    textUser.classList.add("hidden");
    const role = (q("#user_role_input").value = "user");
    q("#signup_legend").innerText = "user";
    q("#signup_restaurant_name").classList.add("hidden");
  });

  q(".change_signup_partner").addEventListener("click", () => {
    const textPartner = q("#text_partner");
    const textUser = q("#text_user_btn");
    textUser.classList.remove("hidden");
    textPartner.classList.add("hidden");
    const role = (q("#user_role_input").value = "partner");
    q("#signup_legend").innerText = "partner";
    q("#signup_restaurant_name").classList.remove("hidden");
  });

  function edit_profile() {
    const user_name = q("#user_name");
    const user_email = q("#user_email");
    const user_last_name = q("#user_last_name");
    const user_address = q("#user_address");
    const user_zip = q("#user_zip");
    const user_city = q("#user_city");

    user_name.readOnly = false;
    user_email.readOnly = false;
    user_last_name.readOnly = false;
    user_address.readOnly = false;
    user_zip.readOnly = false;
    user_city.readOnly = false;
    q("#update_profile").classList.remove("hidden");
    q("#edit_profile").classList.add("hidden");
  }
});
