function onAddToCartClick(element) {
  addToCart(element.value);

  const notification = document.getElementById('add-to-cart-notification');
  notification.style.display = 'block';
}
