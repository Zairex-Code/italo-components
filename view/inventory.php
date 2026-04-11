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
                    <div class="aspect-video bg-gray-100 rounded-2xl relative overflow-hidden flex items-center justify-center border-2 border-dashed border-gray-200">
                        <img src="https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=1000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-80" alt="Preview">
                        <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 to-transparent">
                            <span class="bg-yellow-400 text-[10px] font-bold px-2 py-0.5 rounded text-black mb-2 inline-block">PREVIEW</span>
                            <h3 class="text-white font-serif text-xl">Mármol Carrara Premium</h3>
                        </div>
                    </div>
                </div>
                
                <!-- Form Fields -->
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 items-end">
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    
                    <div class="col-span-1 sm:col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Nombre del Producto</label>
                        <input type="text" placeholder="Ej: Mármol Carrara Premium" name="name" value="<?php echo $name ?>" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Categoría</label>
                        <select class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 appearance-none" name="category" value="<?php echo $category ?>">
                            <option <?php echo ($categories == 'Revestimientos') ? 'selected' : '' ?>>Revestimientos</option>
                            <option <?php echo ($categories == 'Mobiliario') ? 'selected' : '' ?>>Mobiliario</option>
                            <option <?php echo ($categories == 'Iluminación') ? 'selected' : '' ?>>Iluminación</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest" >Precio</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">$</span>
                            <input type="number" step="0.01" value="<?php echo $price ?>" name="price" placeholder="0.00" class="w-full bg-gray-100 border-none rounded-lg pl-8 pr-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Stock Inicial</label>
                        <input type="number" value="<?php echo $stock ?>" placeholder="0" name="stock" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500">
                    </div>
                    <div class="flex flex-col gap-2">
                        <button type="submit" name="saveAction"  class="bg-[#111827] text-white px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-black transition w-full">Guardar en Catálogo</button>
                        <button type="reset" class="bg-gray-200 text-gray-600 px-8 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-300 transition w-full">Limpiar</button>
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

                            <tr id="product-row-<?php echo $product['id']; ?>" class="hover:bg-gray-50/50 transition">
                                <td class=" py-4 text-xs text-center"><span class="bg-gray-50 text-gray-400 px-2 py-1 rounded-full border border-gray-100"><?php echo $product['id'] ?></span></td>
                                <td class="px-8 py-4">
                                    <img src="https://images.unsplash.com/photo-1540932239986-30128078f3c5?q=80&w=100&auto=format&fit=crop" class="w-12 h-12 rounded-xl object-cover shadow-sm bg-gray-100" alt="img">
                                </td>
                                <td class="px-8 py-4">
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
                    <div>Mostrando 3 de 128 productos</div>
                    <div class="flex items-center gap-2">
                        <button class="p-1 px-2 border border-gray-200 rounded hover:bg-white"><</button>
                        <button class="p-1 px-3 bg-cyan-700 text-white rounded">1</button>
                        <button class="p-1 px-3 border border-gray-200 rounded hover:bg-white">2</button>
                        <button class="p-1 px-2 border border-gray-200 rounded hover:bg-white">></button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    function editProduct(product) {
        document.querySelector('input[name="id"]').value = product.id;
        document.querySelector('input[name="name"]').value = product.name;
        document.querySelector('select[name="category"]').value = product.category;
        document.querySelector('input[name="price"]').value = product.price;
        document.querySelector('input[name="stock"]').value = product.stock;
        
        // Scroll suave hacia el formulario
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
                // Dejamos de lado el AJAX complejo y navegamos a la URL como PHP clásico
                window.location.href = `?deleteId=${product.id}`;
            }
        });
    }

    // Cuando la página cargue, leemos si la URL tiene "?status=deleted" de PHP
    window.onload = function() {
        const params = new URLSearchParams(window.location.search);
        if(params.get('status') === 'deleted') {
            // Mostramos la alerta de éxito
            Swal.fire({
                title: '¡Eliminado!',
                text: 'El producto fue borrado con éxito.',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            // Limpiamos la URL visualmente para que la alerta no se vuelva a mostrar si actualiza la página con F5
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    };
</script>

</html>