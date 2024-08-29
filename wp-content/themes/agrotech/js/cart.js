let cartState = {
  total: 0,
  data: {},
};


function updateCartCookie() {
  cookieStore.set('at_cart', JSON.stringify(cartState));
}

function updateProductsCounter(count) {
  const productsCounter = document.getElementById('cart-products-counter');
  productsCounter.textContent = count;
}

function updateState() {
  updateCartCookie();
  updateProductsCounter(cartState.total);
}

function addToCart(id) {
  if (cartState.data.hasOwnProperty(id)) {
    cartState.data[id].amount++;
  } else {
    cartState.data[id] = { amount: 1 };
  }
  cartState.total++;
  updateState();
}

function onRemoveClick(element) {
  const id = element.value;
  cartState.total -= cartState.data[id].amount;
  delete cartState.data[id];
  updateState();
  window.location.reload();
}

function onPlusClick(element) {
  const id = element.value;
  cartState.data[id].amount++;
  cartState.total++;
  updateState();
  window.location.reload();
}

function onMinusClick(element) {
  const id = element.value;

  if (cartState.data[id].amount - 1 === 0) {
    onRemoveClick(element);
  } else {
    cartState.data[id].amount--;
    cartState.total--;
    updateState();
    window.location.reload();
  }
}

onload = () => {
  cookieStore.get('at_cart').then((cookie) => {
    const cartCookieValue = cookie.value;
    cartState = JSON.parse(cartCookieValue);
    updateProductsCounter(cartState.total);
  });
}
