document.addEventListener("DOMContentLoaded", () => {
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
      build_search_users(search_admin(event));
      console.log("search_admin_users");
    });
  });
});

function reload_page() {
  location.reload();
  show_page("search_users");
}

async function search_admin(event) {
  const search = event.target.search.value;

  console.log(search);
  const response = await fetch("api/api-search-users-admin.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ search }),
  });
  const data = await response.json();
  return data;
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
