document.addEventListener("DOMContentLoaded", () => {
  build_restaurants();
});

async function build_restaurants() {
  const json = await get_restaurants();
  console.log(json, "dsds");

  const sorted = sort_az(json.restaurants, "restaurant_name");

  const restaurant_grid = q("#restaurant_grid");

  sorted.forEach((restaurant) => {
    const template = q("#restaurant_article");
    console.log(template);
    const clone = template.content.cloneNode(true);
    q(".restaurant_name", clone).innerText = restaurant.restaurant_name;
    let article = q("article", clone);
    article.id = restaurant.restaurant_id;
    article.addEventListener("click", () => {
      console.log(article.id);
    });
    restaurant_grid.appendChild(clone);
  });
}
