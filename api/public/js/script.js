document.addEventListener('DOMContentLoaded', () => {
  initializeCart();
  updateCartDropdown();
  if (document.startViewTransition) {
    window.navigation.addEventListener('navigate', (event) => {
      const toUrl = new URL(event.destination.url)

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

          })
        }
      })
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
        <img src="public/img/default.png" alt="Producto" class="w-20 h-20 p-2">
        <div class="flex-1 overflow-hidden">
            <h5 class="text-lg truncate mb-2">${product.nombre}</h5>
            <div class="flex justify-between">
              <h2 class="text-xl font-semibold text-gray-600 truncate">${product.precio}€</h2>
              <input type="number" name="cantidad" value="${product.cantidad}" min="1" class="border border-gray-300 px-2 py-1 rounded-lg w-20 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" onchange="updateProductQuantity(${product.id}, this.value)" />
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
}

function addToCart(event) {
  event.preventDefault();

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
  productElement.classList.add('animate-pulse', 'bg-red-100', 'border-red-500', 'text-red-900', 'rounded-lg');

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

function handleLogin() {
  const loginForm = document.getElementById("loginForm");
  const loginMessage = document.getElementById("loginMessage");

  const formData = new FormData(loginForm);

  fetch('login.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(responseJson => {
      loginMessage.textContent = responseJson.msg;

      if (responseJson.success) {
        loginMessage.classList.add('bg-green-500');
        loginMessage.classList.remove('bg-red-500');
        location.reload();
      } else {
        loginMessage.classList.add('bg-red-500');
        loginMessage.classList.remove('bg-green-500');
      }

      loginMessage.classList.remove('opacity-0');
      setTimeout(() => {
        loginMessage.classList.add('opacity-0');
      }, 3000);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}
