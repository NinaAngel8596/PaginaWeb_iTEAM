function buscarPorNombre() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value;

    // Realiza una solicitud AJAX
    fetch(`buscar.php?nombre=${searchTerm}`)
        .then(response => response.json())
        .then(data => showHTML(data))
        .catch(error => console.error('Error:', error));
}


function showHTML(products) {
    const containerItems = document.querySelector('.container-items');
    containerItems.innerHTML = '';

    products.forEach(product => {
        const item = document.createElement('div');
        item.classList.add('item');

        const productContent = `
            <figure>
                <img src="images/${product.imagen}" alt="${product.nombre}" />
            </figure>
            <div class="info-product">
                <h2>${product.nombre}</h2>
                <p class="price">$${product.precio}</p>
                <button class="btn-add-cart">Añadir al carrito</button>
            </div>
        `;

        item.innerHTML = productContent;
        containerItems.appendChild(item);
    });
}

