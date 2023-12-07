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
