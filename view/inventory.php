<?php
include('../controllers/inventoryController.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex h-screen overflow-hidden">
    <?php include('components/sidebar.php'); ?>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <!-- Header -->
        <header class="flex justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Inventario</h1>
                <p class="text-gray-500">Gestiona el catálogo de productos, controla el stock y ajusta precios con precisión editorial.</p>
            </div>
            
        </header>

        <!-- Product Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-10">
            <div class="flex items-center gap-2 mb-8 text-cyan-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-semibold uppercase tracking-wider text-xs">Nuevos Productos</span>
            </div>

            <form action="" id="product-form" method="post" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Preview Placeholder -->
                <div class="md:col-span-1">
                    <div class="w-full h-100 bg-gray-100 rounded-2xl relative overflow-hidden flex items-center justify-center border-2 border-dashed border-gray-200">
                        <img id="image" src="https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=1000&auto=format&fit=crop" class="max-w-full max-h-full object-contain block opacity-80" alt="Preview">
                    </div>
                </div>
                
                <!-- Form Fields -->
                <div class="md:col-span-2 flex flex-col justify-between gap-6">
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <input type="hidden" name="image" id="input-image" value="<?php echo $image ?>" >
                    
                    <!-- Fila 1: Nombre (Ocupa todo el ancho) -->
                    <div class="relative w-full">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Nombre del Producto</label>
                        <div class="relative">
                            <input id="product-name" type="text" placeholder="Ej: iPhone 15 Pro Max" name="name" value="<?php echo $name ?>" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 pr-10">
                            <!-- Loader posicionado dentro del input -->
                            <div id="search-loader" class="hidden absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="animate-spin h-5 w-5 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            </div>
                        </div>
                        <!-- Dropdown de sugerencias -->
                        <div id="amazon-results" class="hidden absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-2xl max-h-64 overflow-y-auto divide-y divide-gray-100 top-full"></div>
                    </div>

                    <!-- Fila 2: Categoría, Precio, Stock -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Categoría</label>
                            <select class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 appearance-none" name="category">
                                <!-- JS llenará esto -->
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Precio</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">$</span>
                                <input type="number" step="0.01" value="<?php echo $price ?>" name="price" placeholder="0.00" class="w-full bg-gray-100 border-none rounded-lg pl-8 pr-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Stock Inicial</label>
                            <input type="number" value="<?php echo $stock ?>" placeholder="0" name="stock" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500">
                        </div>
                    </div>

                    <!-- Fila 3: Botones -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-2">
                        <button type="submit" name="saveAction" class="flex-1 bg-cyan-600 text-white px-8 py-3 rounded-lg text-sm font-semibold hover:bg-cyan-700 transition shadow-sm cursor-pointer">Guardar en Catálogo</button>
                        <button type="reset" class="flex-1 bg-gray-200 text-gray-600 px-8 py-3 rounded-lg text-sm font-semibold hover:bg-gray-300 transition cursor-pointer">Limpiar Formulario</button>
                    </div>
                </div>
            </form>
        </div>
                <!-- Product List -->
                    <div>
                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <h2 class="text-2xl font-serif text-gray-900 mb-1">Listado de Artículos</h2>
                                <p class="text-sm text-gray-400">Auditoría completa de existencias en tiempo real.</p>
                            </div>
                            <div class="flex items-center gap-4 ">
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                    </span>
                                    <input type="text" placeholder="Buscar productos..." class=" w-100 pl-10  pr-4 py-2 bg-white border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 w-64 shadow-sm text-sm">
                                </div>
                            </div>
                        </div>
                    </div>  
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-50 uppercase text-[10px] font-bold text-gray-400 tracking-widest">
                            <th class="px-8 py-5">id</th>
                            <th class="px-8 py-5">Imagen</th>
                            <th class="px-8 py-5">Producto</th>
                            <th class="px-8 py-5">Stock</th>
                            <th class="px-8 py-5">Precio</th>
                            <th class="px-8 py-5 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php 
                        foreach($productList as $product){?>

                            <tr id="<?php echo $product['id']; ?>" class="hover:bg-gray-50/50 transition">
                                <td class=" py-4 text-xs text-center"><span class="bg-gray-50 text-gray-400 px-2 py-1 rounded-full border border-gray-100"><?php echo $product['id'] ?></span></td>
                                <td class="px-8 py-4">
                                    <img src="<?php echo $product['image']; ?>" class="h-10 w-10 object-cover rounded-lg shadow-sm" alt="img">
                                </td>
                                <td class="px-8 py-4 w-200">
                                    <div class="font-serif text-gray-900 leading-tight"><?php echo $product['name'] ?></div>
                                    <div class="text-[10px] text-gray-400"><?php echo $product['category'] ?></div>
                                </td>
                                <td class="px-8 py-4"><span class="bg-orange-50 text-orange-600 text-[10px] font-bold px-3 py-1.5 rounded-full border border-orange-100"><?php echo $product['stock'] ?> Unid.</span></td>
                                <td class="px-8 py-4 font-bold"><?php echo $product['price'] ?></td>
                                <td class="px-8 py-4">
                                    <div class="flex justify-end gap-3 text-gray-300">
                                        <button class="hover:text-cyan-500 cursor-pointer" onclick="editProduct(<?php echo htmlspecialchars(json_encode($product)); ?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </button>
                                        <button class="hover:text-red-500" onclick="eraseProduct(<?php echo htmlspecialchars(json_encode($product)); ?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg></button>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
                
                <!-- Pagination Footer -->
                <div class="px-8 py-6 bg-gray-50/50 flex justify-between items-center text-[10px] font-bold text-gray-400 uppercase tracking-widest border-t border-gray-100">
                    <div>Mostrando <?php echo count($productList); ?> productos</div>
                    
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    
    function editProduct(product) {
        document.querySelector('input[name="id"]').value = product.id;
        document.querySelector('input[name="name"]').value = product.name;
        document.getElementById('image').src = product.image;
        document.querySelector('select[name="category"]').value = product.category;
        document.querySelector('input[name="price"]').value = product.price;
        document.querySelector('input[name="stock"]').value = product.stock;
        
        // we de an smooth scroll to the top of the page to show the form
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };


    function eraseProduct(product) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: `¿Seguro que deseas eliminar "${product.name}"? Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'rounded-2xl border-2 border-gray-100 shadow-xl',
                title: 'text-2xl font-bold text-gray-800',
                htmlContainer: 'text-gray-600 ',
                confirmButton: 'bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg ml-3 transition-colors',
                cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-lg transition-colors'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // we redirect the url to the handleRequest() in the php file
                window.location.href = `?deleteId=${product.id}`;
            }
        });
    }
    

    function selectCategory() {
        const inputCategory = document.querySelector('select[name="category"]');
        // Usamos la variable $categoryList que definimos en el controlador
        const categoriesList = <?php echo json_encode($categoryList); ?>;
        
        // Limpiamos el select antes de llenar
        inputCategory.innerHTML = '<option value="" disabled selected>Selecciona una categoría</option>';

        if (Array.isArray(categoriesList)) {
            categoriesList.forEach(category => {
                const item = document.createElement('option');
                item.value = category;
                item.textContent = category;
                // Si la categoría coincide con la del producto que estamos editando, la seleccionamos
                if (category === "<?php echo $category; ?>") {
                    item.selected = true;
                }
                inputCategory.appendChild(item);
            });
        }
    }

    // 5. Llamamos a la función para que se ejecute
    selectCategory();


    // When the windows is loaded, we reed if URL has "?status=deleted" from PHP
    window.onload = function() {
        //returns the entire URL of the current page as a string
        const params = new URLSearchParams(window.location.search);
        console.log(params);
        if(params.get('status') === 'deleted') {
            //Show a success alert
            Swal.fire({
                title: '¡Eliminado!',
                text: 'El producto fue borrado con éxito.',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            // uptade the page with a new url, this method have to use ({object}, title usuals is ignored by browsers, new url(this is our base URL view/inventory.php))
            window.history.replaceState({}, document.title, window.location.pathname);
        } else if(params.get('status') === 'saved') {
            Swal.fire({
                title: '¡Guardado!',
                text: 'El producto se guardó correctamente en el catálogo.',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    };
</script>
<script>
    const API_CONFIG = <?php echo json_encode([
        "API_URL" => $API_URL,
        "API_KEY" => $API_KEY,
        "API_HOST" => $API_HOST,
        
    ]); ?>;
</script>
<script src="../connection/api.js"></script>
</html>