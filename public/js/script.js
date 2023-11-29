document.addEventListener('DOMContentLoaded', () => {
  initializeCart();
  updateCartDropdown();
  setupLoginFormListener();
  displayOrderSummaryRows();

  if (document.startViewTransition) {
    window.navigation.addEventListener('navigate', (event) => {
      const toUrl = new URL(event.destination.url)
      const params = new URLSearchParams(toUrl.search)

      // si incluye el parámetro ?login o ?logout no intercepta la navegación para que se recargue la página completa
      if (params.has('login') || params.has('logout')) {
        event.continue();
      } else if (params.has('checkout')) {
        setupOrderFormListener();
      } else {
        // si no es una navegación en el mismo dominio (origen) no intercepta
        if (location.origin !== toUrl.origin) return

        // si es una navegación en el mismo dominio (origen) intercepta
        event.intercept({
          async handler() {
            // carga la página de destino utilizando un fetch para obtener el HTML
            const response = await fetch(toUrl)
            const text = await response.text()
            // extrae el contenido del main del HTML usando una expresión regular
            const [, data] = text.match(/<main\b[^>]*>([\s\S]*?)<\/main>/i)

            document.startViewTransition(() => {
              const main = document.querySelector('main')
              main.innerHTML = data
              window.scrollTo({
                top: 0,
                behavior: 'smooth'
              });

              displayOrderSummaryRows();
            })
          }
        })
      }
    })
  }
});

function initializeCart() {
  if (!localStorage.getItem('cart')) {
    setCart([]);
  }
}

function getCart() {
  return JSON.parse(localStorage.getItem('cart')) || [];
}

function setCart(cart) {
  localStorage.setItem('cart', JSON.stringify(cart));
}

function updateCartDropdown() {
  animateCart();
  const cart = getCart();

  const cartEmpty = document.querySelector('#cart-empty');
  const cartArticles = document.querySelector('#cart-articles');

  if (cart.length === 0) {
    cartEmpty.classList.remove('hidden');
    cartArticles.classList.add('hidden');
  } else {
    cartEmpty.classList.add('hidden');
    cartArticles.classList.remove('hidden');
  }

  let cartContent = '';
  let cartCount = 0;
  let total = 0;

  cart.forEach(product => {
    let precio = parseFloat(product.precio);
    let cantidad = +product.cantidad;
    cartCount += cantidad;
    total += precio * cantidad;
    cartContent += `
    <article class="flex space-x-4 border-b px-2">
        <img alt="${product.nombre}" src="public/img/${product.imagenes[0]}" alt="${product.nombre}" class="w-20 h-20 object-contain p-2">
        <div class="flex-1 overflow-hidden">
            <h5 class="text-lg truncate mb-2">${product.nombre}</h5>
            <div class="flex justify-between">
              <h2 class="text-xl font-semibold text-gray-600 truncate">${product.precio}€</h2>
              <input type="number" name="cantidad" value="${product.cantidad}" min="1" class="border border-gray-300 px-2 py-1 rounded w-20 focus:outline-blue-600" onchange="updateProductQuantity(${product.id}, this.value)" />
              <button class="text-red-500 hover:text-red-600 focus:outline-none remove-from-cart" data-product-id="${product.id}" onclick="removeFromCart(${product.id})">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>
    </article>`;
  });

  document.querySelector("#cart-count").textContent = cartCount;
  document.querySelector("#articulos").innerHTML = cartContent;
  document.querySelector("#total").textContent = `Total: ${total.toFixed(2)} €`;
  displayOrderSummaryRows();
}

function addToCart() {
  const form = document.querySelector('#productForm');
  const formData = JSON.parse(form.getAttribute('data-product'));
  const cantidad = +document.querySelector('#cantidad').value;
  formData.cantidad = cantidad;


  let cart = getCart();

  let existingProductIndex = cart.findIndex(item => item.id === formData.id);

  if (existingProductIndex !== -1) {
    cart[existingProductIndex].cantidad += cantidad;
  } else {
    cart.push(formData);
  }

  setCart(cart);
  updateCartDropdown();
  document.querySelector('#cart-icon-add').classList.add('animate-bounce');
  setTimeout(() => document.querySelector('#cart-icon-add').classList.remove('animate-bounce'), 500);
}

function removeFromCart(productId) {
  const productElement = document.querySelector(`[data-product-id="${productId}"]`).closest('article');

  // Se añade una clase para que se ejecute la animación de eliminación
  productElement.classList.add('animate-pulse', 'bg-red-100', 'border-red-500', 'text-red-900', 'rounded');

  // Cuando la transición se complete se elimina el producto del carrito
  setTimeout(() => {
    let cart = getCart().filter(product => +product.id !== productId);
    setCart(cart);
    updateCartDropdown();
  }, 1000);
}


function updateProductQuantity(productId, newQuantity) {
  let cart = getCart();
  let productToUpdate = cart.find(product => +product.id === productId);

  if (productToUpdate) {
    productToUpdate.cantidad = +newQuantity;
    setCart(cart);
    updateCartDropdown();
  }
}

function animateCart() {
  document.querySelector("#cart-icon").classList.add('animate-bounce');
  document.querySelector("#cart-count").classList.add('animate-ping');
  document.querySelector("#total").classList.add('animate-ping');
  setTimeout(() => {
    document.querySelector("#cart-icon").classList.remove('animate-bounce');
    document.querySelector("#cart-count").classList.remove('animate-ping')
    document.querySelector("#total").classList.remove('animate-ping');
  }
    , 600);
}

function setupLoginFormListener() {
  const loginForm = document.getElementById("loginForm");
  if (!loginForm) return;
  loginForm.addEventListener('submit', function (event) {
    event.preventDefault();
    handleLogin(event);
  });
}

function setupOrderFormListener() {
  const orderForm = document.getElementById("orderForm");
  if (!orderForm) return;
  orderForm.addEventListener('submit', function (event) {
    event.preventDefault();
    handleOrder(event);
  });
}

function handleLogin(event) {
  const formData = new FormData(event.target);
  const loginMessage = document.getElementById("loginMessage");

  fetch('api/login.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(responseJson => {
      if (responseJson.success) {
        loginMessage.classList.add('bg-green-500');
        loginMessage.classList.remove('bg-red-500');
        const url = new URL(location.href);
        url.searchParams.set('login', true);
        window.location.href = url;
      } else {
        loginMessage.classList.add('bg-red-500');
        loginMessage.classList.remove('bg-green-500');
      }
      loginMessage.textContent = responseJson.msg;
      loginMessage.classList.remove('opacity-0');
      setTimeout(() => {
        loginMessage.classList.add('opacity-0');
      }, 3000);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}

function handleOrder(event) {
  const formData = new FormData(event.target);
  // Crear un objeto a partir de los datos del formulario
  let formObject = {};
  formData.forEach(function (value, key) {
    formObject[key] = value;
  });

  const cart = getCart();

  // Combinar los datos del formulario y del carrito
  const order = {
    form: formObject,
    cart: cart
  };

  const orderMessage = document.getElementById("orderMessage");

  fetch('api/order.php', {
    method: 'POST',
    body: JSON.stringify(order),
  })
    .then(response => console.log('prueba order'))//response.json())
    .catch(error => {
      console.error('Error:', error);
    });
}

function displayOrderSummaryRows() {
  const cartItemsContainer = document.getElementById('summary-items');
  if (cartItemsContainer) {
    let cartHTML = '';
    let totalHTML = '';
    const cart = getCart();

    if (cart.length === 0) {
      cartHTML += `
      <tr>
        <td colspan="5" class="text-center p-32">No hay productos en el carrito</td>
      </tr>
      `;
    } else {
      cart.forEach(product => {
        cartHTML += `
      <tr class="border-b border-gray-200 hover:bg-gray-50 text-center">
        <td class="p-2">
        <img alt="${product.nombre}" src="public/img/${product.imagenes[0]}" alt="${product.nombre}" class="w-14 h-14 object-contain p-1">
        </td>
        <td>${product.nombre}</td>
        <td>${product.cantidad}</td>
        <td>${product.precio}€</td>
        <td>${(product.precio * product.cantidad).toFixed(2)}€</td>
      </tr>
      `;
      });
      totalHTML = "Total: " + cart.reduce((total, product) => total + (product.precio * product.cantidad), 0).toFixed(2) + "€";
    }

    document.getElementById('summary-total').textContent = totalHTML;
    cartItemsContainer.innerHTML = cartHTML;
  }
}

function changeImage(imageName) {
  document.getElementById('mainImage').src = '../public/img/' + imageName;
}