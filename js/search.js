document.addEventListener("DOMContentLoaded", () => {
  q(".search_orders_admin").addEventListener("submit", (event) => {
    event.preventDefault();
    show_page("orders_admin");
    build_html_admin(search_api(event, "api/api-search-orders-admin.php"));
  });

  q(".search_orders_partner").addEventListener("submit", (event) => {
    event.preventDefault();
    show_page("orders_partner");
    build_html_partner(search_api(event, "api/api-search-orders-partner.php", parseInt(event.target.user_id.value)));
  });

  q(".search_orders_user").addEventListener("submit", (event) => {
    event.preventDefault();
    show_page("orders_user");
    build_html_users(search_api(event, "api/api-search-orders-user.php", parseInt(event.target.user_id.value)));
  });

  qAll(".search_admin_users").forEach((search_form) => {
    search_form.addEventListener("submit", (event) => {
      event.preventDefault();
      const form = event.target;
      show_page("search_users");
    });
  });

  qAll(".search_admin_users_form").forEach((form) => {
    form.addEventListener("submit", (event) => {
      event.preventDefault();
      show_page("search_users");
      build_search_users(search_api(event, "api/api-search-users-admin.php"));
    });
  });

  q(".search_admin_orders").addEventListener("submit", (event) => {
    event.preventDefault();
    show_page("orders_admin");
    const json = search_api(event, "api/api-search-orders-admin.php");
    build_orders("admin", json);
  });
});

function reload_page() {
  location.reload();
  show_page("search_users");
}

async function search_api(event, path, user_id = null) {
  const search = event.target.search.value;
  console.log(search, "search");
  console.log(user_id, "user_id");
  if (user_id === null) {
    console.log("no user_id", user_id);
  }

  console.log(search);
  const response = await fetch(path, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ search, user_id }),
  });
  const data = await response.json();
  return data;
}

async function build_html_admin(json) {
  const orders = await json;
  console.log(orders, "orders");
  build_orders("admin", orders);
}

async function build_html_partner(json) {
  const orders = await json;
  console.log(orders, "orders");
  build_orders_partner("partner", orders);
}

async function build_html_users(json) {
  const orders = await json;
  console.log(orders, "orders");
  build_orders("user", orders);
}

async function build_search_users(json) {
  const users = await json;
  console.log(users);
  const tbody = document.querySelector("#search_users");
  const template = document.querySelector("#search_user");
  remove_elements("search_tr");
  users.forEach((user) => {
    const clone = template.content.cloneNode(true);
    clone.querySelector(".search_user_id").innerText = user.user_id;
    clone.querySelector(".search_user_name").innerText = user.user_name;
    clone.querySelector(".search_user_last_name").innerText = user.user_last_name;
    clone.querySelector(".search_user_email").innerText = user.user_email;
    clone.querySelector(".search_user_role").innerText = user.user_role;
    blocked = clone.querySelector(".search_user_blocked");
    if (user.user_blocked == 1) {
      blocked.innerText = "Blocked";
      blocked.classList.add("bg-red-500");
      blocked.setAttribute("blocked", 1);
      blocked.setAttribute("id", user.user_id);
    } else {
      blocked.classList.add("bg-green-500");
      blocked.innerText = "Unblocked";
      blocked.setAttribute("blocked", 0);
      blocked.setAttribute("id", user.user_id);
    }

    tbody.appendChild(clone);
  });
}
