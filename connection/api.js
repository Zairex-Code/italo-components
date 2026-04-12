
const inputName =document.querySelector('input[name="name"]');
const imageSection = document.getElementById('image');
const inputCategory = document.querySelector('input[name="category"]');
const inputPrice = document.querySelector('input[name="price"]');
const inputStock = document.querySelector('input[name="stock"]');

const amazonResults = document.getElementById('amazon-results');
const searchLoader = document.getElementById('search-loader');

const url = API_CONFIG.API_URL + '/search?query=Phone&page=1&country=US&sort_by=RELEVANCE&product_condition=ALL&is_prime=false&deals_and_discounts=NONE';
let debounceTimer;

const options = {
	method: 'GET',
    headers: {
        'x-rapidapi-key': API_CONFIG.API_KEY,
        'x-rapidapi-host': API_CONFIG.API_HOST,
        'Content-Type': 'application/json'
    }
};


const fetchProducts = async (query) => {

    
    const searchUrl = `${API_CONFIG.API_URL}/search?query=${query}&page=1&country=US&sort_by=RELEVANCE`;

    try {
        const response = await fetch(searchUrl,options);
		

        if (!response.ok) throw new Error('Error en la búsqueda');
        const products = await response.json();
        console.log(`Resultados para "${query}":`, products);
        return products;
    } catch (error) {
        console.error("Error al buscar productos:", error);
    }
};



inputName.addEventListener('input', (e) => {
	const query = inputName.value.trim();
	
	// we cancel the last timeout
	clearTimeout(debounceTimer);

	// the user must write at least 3 characters
	if(query.length < 3){
		amazonResults.classList.add('hidden');
		return;
	}

	// we set a new Timeout 
	debounceTimer = setTimeout(async () => {
		searchLoader.classList.remove('hidden');
		try{
			
			const responseData = await fetchProducts(query);
			console.log('Response Data:', responseData);
			
			// we use fallbacks to ensure we have an array to work with
			const productsList = responseData?.data?.products || responseData || [];
			
			amazonResults.innerHTML = "";
			
			// 3. Revisamos el length correctamente
			if (productsList.length > 0){
				amazonResults.classList.remove('hidden');
				productsList.forEach( product => {
					const item = document.createElement('div');
					
					
					item.className = 'flex items-center space-x-4 p-3 hover:bg-cyan-300 cursor-pointer transition-color border-transparent hover:border-cyan-500';
					
					// set fallbacks for title, price and image and avoid errors if some of these properties are missing
					const title = product.product_title || product.name || 'Sin nombre';
					
					const price = product.product_price || product.price || '';
					const image = product.product_photo || product.image || 'image not found';

					// 4. we inyect the data into the item and we also clean the price to remove any symbol and convert it to a number if it's a string
					item.innerHTML = `
						<img src="${image}" class="w-10 h-10 object-contain bg-white rounded-md border p-1 shrink-0"> 
						<div class="flex-grow min-w-0">
							<p class="text-sm font-semibold text-gray-800 truncate">${title}</p>
							<p class="text-xs text-blue-600 font-bold">${price}</p>
						</div>`;

					item.onclick = (event) => {
						event.stopPropagation();
						inputName.value = title;
						
						
						imageSection.src = image;
						// if price is a string we remove any symbol and we convert it to a number, if it's already a number we just set it
						inputPrice.value = typeof price === 'string' ? price.replace(/[^0-9.]/g, '') : price;
						amazonResults.classList.add('hidden');	
					};
					amazonResults.appendChild(item);
				});
			} else {
				amazonResults.classList.add('hidden');
			}
		} catch(error) { // 5. corregido "error"
			console.error('Error Amazon Search: ', error);
		} finally {
			searchLoader.classList.add('hidden');
		}
	}, 600); 

});









// Ejemplo de uso:
//searchProducts('Laptop');
