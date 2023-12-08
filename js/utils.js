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

function show_page(page_id) {
  console.log(page_id);
  // Hide all the pages
  qAll(".page").forEach((page) => {
    page.classList.add("hidden");
  });
  // Show the one with the id
  q("#" + page_id).classList.remove("hidden");
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

async function toggle_blocked(event, user_id, user_is_blocked) {
  console.log("user_id", user_id);
  console.log("user_is_blocked", user_is_blocked);

  if (user_is_blocked == 0) {
    event.target.innerHTML = "blocked";
  } else {
    event.target.innerHTML = "unblocked";
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

    if (response.ok) {
      const response = await response.text();
      console.log(response);
      window.location.href = "/";
    }
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
