document.addEventListener("DOMContentLoaded", () => {
  // build_restaurants();
  const index_page = q("#pages");
  const user = index_page.getAttribute("data-session");

  if (user === "user") {
    // Your JavaScript function or code for logged-in users
    show_page("restaurants", build_restaurants);
    // build_orders("user");
  } else if (user === "partner") {
    show_page("orders_partner");
    build_orders("partner");
  } else if (user === "admin") {
    show_page("admin");
    build_orders("admin");
  } else {
    show_page("restaurants", build_restaurants);
  }

  q("#empty_cart").addEventListener("click", () => {
    empty_cart();
  });
});

async function build_restaurants() {
  const json = await get_restaurants();
  const sorted = sort_az(json.restaurants, "restaurant_name");
  const restaurant_grid = q("#restaurant_grid");
  const template = q(".restaurant_article");
  remove_elements("restau");
  sorted.forEach((restaurant) => {
    const clone = template.content.cloneNode(true);
    q(".restaurant_name", clone).innerText = restaurant.restaurant_name;
    let article = q("article", clone);
    article.id = restaurant.restaurant_id;
    article.addEventListener("click", (event) => {
      get_products(event, restaurant.restaurant_name, restaurant.restaurant_id);
    });
    restaurant_grid.appendChild(clone);
  });
}

async function build_orders(user) {
  console.log("BUILD ORDER HERE");
  const json = await get_orders(user);
  console.log(json, "THEORDERS");
  let template, container, under_delivery;
  if (user === "admin") {
    container = q("#admin_orders");
    template = q("#admin_order");
  } else if (user === "partner") {
    container = q("#partner_orders");
    template = q("#partner_order");
  } else {
    container = q("#user_orders");
    template = q("#user_order");
  }
  under_delivery = q("#under_delivery");
  under_delivery_order = q("#under_delivery_order");
  json.orders.forEach((order) => {
    const created_time = parseInt(order.created_at);
    const scheduled_time = parseInt(order.scheduled_at);
    const clone = template.content.cloneNode(true);
    const order_id = (q(".order_id", clone).innerText = order.order_id);
    const restaurant_id = (q(".restaurant_id_order", clone).innerText = order.restaurant_fk);
    const user_id = (q(".user_id_order", clone).innerText = order.user_fk);
    const restaurant_name = (q(".restaurant_name_order", clone).innerText = order.restaurant_name);
    const address = (q(".address_order", clone).innerText = order.address);
    const zip = (q(".zip_order", clone).innerText = order.zip);
    const city = (q(".city_order", clone).innerText = order.city);
    const created_at = (q(".created_at_order", clone).innerText = to_date(created_time * 1000));
    const scheduled = (q(".scheduled_at_order", clone).innerText = to_date(scheduled_time * 1000));
    q(".view_order", clone).href = `/order?order_id=${order_id}`;
    if (is_delivered(order.scheduled_at)) {
      container.appendChild(clone);
    } else {
      under_delivery.appendChild(clone);
    }
  });
}

async function build_products(products, restaurant_name, restaurant_id) {
  console.log(products);
  const product_grid = q("#product_grid");
  const drinks_grid = q("#drinks_grid");
  const menu_grid = q("#menu_grid");
  sorted = sort_az(products.products, "product_name");
  q(".restaurant_title").innerText = restaurant_name;
  q(".restaurant_title").id = restaurant_id;
  const template = q("#product_article");
  remove_elements("product");
  sorted.forEach((product) => {
    const clone = template.content.cloneNode(true);
    q(".product_name", clone).innerText = product.product_name;
    q(".price", clone).innerText = product.price;
    console.log(product.type);
    let buy_btn = q(".buy", clone);
    buy_btn.id = product.product_id;
    buy_btn.setAttribute("data-restaurant", restaurant_id);
    buy_btn.addEventListener("click", (event) => {
      event.preventDefault();
      console.log("wow");
      console.log("ddd", buy_btn.id);
      add_to_cart("cart", buy_btn.id);
      console.log(localStorage.getItem("cart"));
    });
    if (product.type === "food") {
      product_grid.appendChild(clone);
    } else if (product.type === "drink") {
      drinks_grid.appendChild(clone);
    } else {
      menu_grid.appendChild(clone);
    }
  });
}

function is_delivered(scheduled_at) {
  const current_time = new Date().getTime();

  //make into miliseconds
  // console.log(to_date(current_time), to_date(parseInt(scheduled_at) * 1000));
  if (current_time < parseInt(scheduled_at) * 1000) {
    return false;
  }
  return true;
}
function add_zero(number) {
  return number < 10 ? `0${number}` : `${number}`;
}

function to_date(unix_stamp) {
  const dateObj = new Date(unix_stamp);
  const year = dateObj.getFullYear().toString().slice(2);
  const month = add_zero(dateObj.getMonth() + 1);
  const day = add_zero(dateObj.getDate());
  const hours = add_zero(dateObj.getHours());
  const minutes = add_zero(dateObj.getMinutes());

  return `${month}/${day}/${year} ${hours}:${minutes}`;
}
