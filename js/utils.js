// function q(q, from = document) {
//   return from.querySelector(q);
// }
// function qAll(q, from = document) {
//   return from.querySelectorAll(q);
// }

// function show_page(page_id) {
//   console.log(page_id);
//   // Hide all the pages
//   qAll(".page").forEach((page) => {
//     page.classList.add("hidden");
//   });
//   // Show the one with the id
//   q("#" + page_id).classList.remove("hidden");
// }

if (!localStorage.getItem("cart")) {
  console.log("init cart hit");
  localStorage.setItem("cart", JSON.stringify([]));
}

function add_to_cart(key, item) {
  const item_list = get_cart(key);
  item_list.push(item);
  localStorage.setItem(key, JSON.stringify(item_list));
  item_count(key);
}
async function item_count(key) {
  const product_ids = JSON.parse(localStorage.getItem(key));

  const buy_btn = q("#order_products");
  if (product_ids.length === 0) {
    buy_btn.innerText = "Empty cart";
  } else {
    buy_btn.innerText = "Order food";
  }
  const sum = await total_price(product_ids);
  q("#total_cost").innerText = sum["sum"];
  q("#count").innerText = product_ids.length;
}
function get_cart(key) {
  const items = localStorage.getItem(key);
  return JSON.parse(items);
}

function empty_cart() {
  localStorage.setItem("cart", JSON.stringify([]));
}

function q(q, from = document) {
  return from.querySelector(q);
}
function qAll(q, from = document) {
  return from.querySelectorAll(q);
}

function remove_elements(class_name) {
  let elements = document.querySelectorAll(`.${String(class_name)}`);

  try {
    elements.forEach(function (ele) {
      ele.parentNode.removeChild(ele);
    });
  } catch {
    console.log("nothing to remove");
  }
}

function show_page(page_id, callback = null, params = null) {
  console.log(page_id);
  // Hide all the pages
  qAll(".page").forEach((page) => {
    page.classList.add("hidden");
  });
  // Show the one with the id
  q("#" + page_id).classList.remove("hidden");
  sessionStorage.setItem("page", page_id);
  if (callback && params) {
    callback(params);
  } else if (callback) {
    callback();
  }
}

function sort_az(arr, key) {
  console.log(arr, "ddd");
  const sorted = arr.sort((a, b) => {
    const nameA = a[key].toUpperCase();
    const nameB = b[key].toUpperCase();

    if (nameA < nameB) {
      return -1;
    }
    if (nameA > nameB) {
      return 1;
    }
    return 0;
  });
  return sorted;
}

async function toggle_blocked(event, user_id = null, user_is_blocked = null) {
  if (!user_id) {
    user_id = event.target.dataset.id;
    user_is_blocked = event.target.dataset.blocked;
  }

  console.log("user_id", user_id);
  console.log("user_is_blocked", user_is_blocked);

  if (event.target.innerText == "Unblocked") {
    event.target.innerHTML = "Blocked";
    event.target.classList.remove("bg-green-500");
    event.target.classList.add("bg-red-500");
  } else {
    event.target.innerText = "Unblocked";
    event.target.classList.add("bg-green-500");
    event.target.classList.remove("bg-red-500");
  }
  try {
    const response = await fetch(
      `api/api-toggle-user-blocked.php?user_id=${user_id}&user_is_blocked=${user_is_blocked}`
    );
    const data = await response.text();
    console.log(data);
  } catch (error) {
    console.log(error);
  }
}

async function delete_user(user_id) {
  try {
    const response = await fetch(`api/api-delete-user.php?user_id=${user_id}`, {
      method: "DELETE",
    });

    const data = await response.text();
    console.log(data);
    empty_cart();
    window.location.href = "/";
  } catch (error) {
    console.error("Fetch error:", error.message);
  }
}

async function delete_this_user(user_id) {
  try {
    const response = await fetch(`api/api-delete-user.php?user_id=${user_id}`, {
      method: "DELETE",
    });

    if (response.ok) {
      const response = await response.text();
      console.log(response);
      window.location.href = "/";
    }
  } catch (error) {
    console.error("Fetch error:", error.message);
  }
}

function add_zero(number) {
  return number < 10 ? `0${number}` : `${number}`;
}

function to_date(unix_stamp) {
  let stamp = parseInt(unix_stamp);
  const dateObj = new Date(stamp);
  const year = dateObj.getFullYear().toString().slice(2);
  const month = add_zero(dateObj.getMonth() + 1);
  const day = add_zero(dateObj.getDate());
  const hours = add_zero(dateObj.getHours());
  const minutes = add_zero(dateObj.getMinutes());

  return `${month}/${day}/${year} ${hours}:${minutes}`;
}

function clear_session() {
  localSession.clear();
}
