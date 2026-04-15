<?php
include('../controllers/salesController.php');
include('../controllers/inventoryController.php');

$productsInventory = $productList; 
$categoryListSales = $categoryList;
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
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Ventas</h1>
                <p class="text-gray-500">Gestiona las transacciones de venta y el seguimiento de los productos vendidos.</p>
            </div>
            
        </header>

        <!-- Product Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-10">
            <div class="flex items-center gap-2 mb-8 text-cyan-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-semibold uppercase tracking-wider text-xs">Nuevas Ventas</span>
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
                    
                    <!-- Fila 1: Producto, Categoría -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="relative w-full">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Nombre del Producto</label>
                            <div class="relative">
                                <input id="product-name" type="text" placeholder="Buscar producto..." name="name" value="<?php echo $name ?>" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 pr-10" required autocomplete="off">

                                <div id="search-loader" class="hidden absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="animate-spin h-5 w-5 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                </div>
                            </div>
                            <!-- Resultados de búsqueda -->
                            <div id="input-name-results" class="hidden absolute left-0 right-0 z-[100] mt-2 bg-white border border-gray-200 rounded-xl shadow-2xl max-h-80 overflow-y-auto divide-y divide-gray-100">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Categoría</label>
                            <select class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 appearance-none pointer-events-none" name="category" readonly tabindex="-1">
                                <!-- JS llenará esto -->
                            </select>
                        </div>
                    </div>

                    <!-- Fila 2: Cliente y Tipo de Pago -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Cliente</label>
                            <input type="text" name="customer" placeholder="Nombre del cliente" value="<?php echo $customer ?>" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Tipo de Pago</label>
                            <select name="payment_type" id="input-payment-type" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 appearance-none">
                                <?php foreach($paymentTypesList as $type): ?>
                                    <option value="<?php echo $type; ?>" <?php echo ($payment_type == $type) ? 'selected' : ''; ?>><?php echo $type; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Fila 3: Cantidad, Precio Unitario, IGV, Total -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Cantidad</label>
                            <input type="number" id="input-quantity" value="<?php echo $quantity ?>" placeholder="1" name="quantity" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500" required>
                            <div class="mt-1.5 flex items-center gap-1.5 px-1">
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter">Stock Disp:</span>
                                <span id="label-stock-available" class="text-[10px] font-bold text-cyan-600 bg-cyan-50 px-1.5 rounded-md border border-cyan-100/50">0</span>
                                <input type="hidden" name="stock_available" id="input-stock-available" value="<?php echo $stock ?>">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Precio Unit.</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">$</span>
                                <input type="number" id="input-price" step="0.01" value="<?php echo $price ?>" name="price" placeholder="0.00" class="w-full bg-gray-50 border-none rounded-lg pl-7 pr-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 cursor-not-allowed" required readonly>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">IGV (18%)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">$</span>
                                <input type="number" id="input-igv" step="0.01" value="<?php echo $igv ?>" name="igv" placeholder="0.00" class="w-full bg-gray-50 border-none rounded-lg pl-7 pr-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500" readonly>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Total</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">$</span>
                                <input type="number" id="input-total" step="0.01" value="<?php echo $total ?>" name="total" placeholder="0.00" class="w-full bg-cyan-50 border-none rounded-lg pl-7 pr-4 py-3 text-sm font-bold text-cyan-700 focus:ring-2 focus:ring-cyan-500" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 4: Botones (Uno arriba del otro) -->
                    <div class="flex flex-col gap-3 mt-2">
                        <button type="submit" name="saveAction" class="w-full bg-cyan-600 text-white px-8 py-3 rounded-lg text-sm font-semibold hover:bg-cyan-700 transition shadow-sm cursor-pointer order-1">Registrar Venta</button>
                        <button type="reset" class="w-full bg-gray-200 text-gray-600 px-8 py-3 rounded-lg text-sm font-semibold hover:bg-gray-300 transition cursor-pointer order-2">Limpiar Formulario</button>
                    </div>
                </div>
            </form>
        </div>
                <!-- Product List -->
                    <div>
                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <h2 class="text-2xl font-serif text-gray-900 mb-1">Listado de Ventas</h2>
                                <p class="text-sm text-gray-400">Auditoría completa de ventas realizadas.</p>
                            </div>
                            <div class="flex items-center gap-4 ">
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                    </span>
                                    <input type="text" id="table-search" placeholder="Buscar por ID, nombre o categoría..." class=" w-100 pl-10  pr-4 py-2 bg-white border border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 w-64 shadow-sm text-sm">
                                </div>
                            </div>
                        </div>
                    </div>  
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-50 uppercase text-[10px] font-bold text-gray-400 tracking-widest">
                            <th class="px-4 py-5">ID</th>
                            <th class="px-4 py-5">Imagen</th>
                            <th class="px-4 py-5">Producto</th>
                            <th class="px-4 py-5">Cliente</th>
                            <th class="px-4 py-5">fecha de venta</th>
                            <th class="px-4 py-5">Cantidad</th>
                            <th class="px-4 py-5">Pago</th>
                            <th class="px-4 py-5">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs">
                        <?php foreach($salesList as $sale): 
                            // Cálculo unificado del total en el servidor para la tabla
                            $sub = $sale['price'] * $sale['quantity'];
                            $desc = ($sale['payment_type'] == 'Tarjeta OH') ? ($sub * 0.05) : 0;
                            $total_con_igv = ($sub - $desc) * 1.18;
                        ?>
                            <tr class="sales-row hover:bg-gray-50/50 transition cursor-pointer" onclick="invoice(<?php echo $sale['id']; ?>)" >
                                

                                        <td class="px-4 py-4"><?php echo $sale['id']; ?></td>
                                        <td class="px-4 py-4">
                                            <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden border border-gray-100 flex items-center justify-center">
                                                <?php if($sale['image']): ?>
                                                    <img src="<?php echo $sale['image']; ?>" class="w-full h-full object-cover" alt="Product">
                                                <?php else: ?>
                                                    <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 w-180">
                                            <div class="font-bold text-gray-900" ><?php echo $sale['product_name']; ?></div>
                                            <div class="text-[10px] text-gray-400"><?php echo $sale['category']; ?></div>
                                        </td>
                                        <td class="px-4 py-4"><?php echo $sale['customer_name']; ?></td>
                                        <td class="px-4 py-4 text-gray-400"><?php echo $sale['sale_date']; ?></td>
                                        <td class="px-4 py-4">
                                            <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-3 py-1.5 rounded-full border border-blue-100">
                                                <?php echo $sale['quantity']; ?> Unid.
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="bg-orange-50 text-orange-600 text-[10px] font-bold px-3 py-1.5 rounded-full border border-orange-100">
                                                <?php echo $sale['payment_type'] ?>
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 font-bold text-gray-900">$<?php echo number_format($total_con_igv, 2); ?></td>
                                    </tr>
                                
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="px-8 py-6 bg-gray-50/50 flex justify-between items-center text-[10px] font-bold text-gray-400 uppercase tracking-widest border-t border-gray-100">
                    <div class="countText">Mostrando <?php echo count($salesList); ?> ventas</div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
    const inputName = document.getElementById('product-name');
    const nameResults = document.getElementById('input-name-results');
    const inputId = document.getElementById('id');
    const imageSection = document.getElementById('image');
    const inputCategory = document.querySelector('select[name="category"]');
    const labelStock = document.getElementById('label-stock-available');
    const inputStock = document.getElementById('input-stock-available');
    const inputQuantity = document.getElementById('input-quantity');
    const inputPrice = document.getElementById('input-price');
    const inputIgv = document.getElementById('input-igv');
    const inputTotal = document.getElementById('input-total');
    const inputPaymentType = document.getElementById('input-payment-type');

    const productsList = <?php echo json_encode($productsInventory); ?>;

    function calculateTotals() {
        const subtotal = (parseFloat(inputQuantity.value) || 0) * (parseFloat(inputPrice.value) || 0);
        const discount = (inputPaymentType.value === "Tarjeta OH") ? subtotal * 0.05 : 0;
        const total = (subtotal - discount) * 1.18;
        const igv = (subtotal - discount) * 0.18;

        inputIgv.value = igv.toFixed(2);
        inputTotal.value = total.toFixed(2);
    }

    inputQuantity.addEventListener('input', calculateTotals);
    inputPrice.addEventListener('input', calculateTotals);
    inputPaymentType.addEventListener('change', calculateTotals);

    function selectCategory() {
        const inputCategorySelect = document.querySelector('select[name="category"]');
        const categoriesList = <?php echo json_encode($categoryListSales); ?>;
        inputCategorySelect.innerHTML = '<option value="" disabled selected>Selecciona una categoría</option>';

        if (Array.isArray(categoriesList)) {
            categoriesList.forEach(category => {
                const item = document.createElement('option');
                item.value = category;
                item.textContent = category;
                inputCategorySelect.appendChild(item);
            });
        }
    }
    selectCategory();

    function invoice(id){
        window.location.href = `/view/invoice.php/?invoiceID=${id}`;
    }


    function renderProducts(query = "") {
        query = query.toLowerCase().trim();
        nameResults.innerHTML = '';
        
        const filteredProducts = productsList.filter(product => 
            (product.name && product.name.toLowerCase().includes(query)) || 
            (product.category && product.category.toLowerCase().includes(query))
        );

        if (filteredProducts.length > 0) {
            nameResults.classList.remove('hidden');
            filteredProducts.forEach( product => {
                const item = document.createElement('div');
                item.className = 'flex items-center space-x-4 p-4 hover:bg-cyan-50 cursor-pointer transition-all border-l-4 border-transparent hover:border-cyan-500 group';
                
                const title = product.name || 'Sin nombre';
                const price = product.price || '0.00';
                const image = product.image || 'https://images.unsplash.com/photo-1540959733332-e94e7bf0bd40?q=80&w=200&auto=format&fit=crop';
                const stock = product.stock || 0;
                const category = product.category || 'Sin categoría';

                item.innerHTML = `
                    <div class="relative shrink-0">
                        <img src="${image}" class="w-12 h-12 object-cover bg-white rounded-lg border border-gray-100 shadow-sm transition-transform group-hover:scale-105" onerror="this.src='https://via.placeholder.com/150'">
                        ${stock < 5 ? '<span class="absolute -top-1 -right-1 flex h-3 w-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span></span>' : ''}
                    </div>
                    <div class="flex-grow min-w-0">
                        <div class="flex justify-between items-start gap-2">
                            <p class="text-sm font-bold text-gray-800 truncate group-hover:text-cyan-600 transition-colors">${title}</p>
                            <span class="text-[10px] font-black text-cyan-700 bg-cyan-100/50 px-2 py-0.5 rounded-md shrink-0">$${price}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter">${category}</span>
                            <span class="text-[9px] font-bold ${stock > 0 ? 'text-green-600' : 'text-red-600'} bg-gray-50 px-1.5 rounded border border-gray-100 italic">Stock: ${stock}</span>
                        </div>
                    </div>`;

                item.addEventListener('click', () => {
                    inputName.value = title;
                    inputId.value = product.id;
                    imageSection.src = image;
                    inputPrice.value = price;
                    inputCategory.value = category;
                    labelStock.textContent = stock;
                    inputStock.value = stock;
                    
                    calculateTotals();
                    nameResults.classList.add('hidden');
                });
                nameResults.appendChild(item);
            });
        } else {
            nameResults.innerHTML = '<div class="p-4 text-center text-sm text-gray-500">No se encontraron productos</div>';
            nameResults.classList.remove('hidden');
        }
    }

    inputName.addEventListener("input", (e) => {
        renderProducts(e.target.value);
    });

    inputName.addEventListener("click", () => {
        renderProducts(inputName.value);
    });

    inputName.addEventListener("focus", () => {
        renderProducts(inputName.value);
    });

    // Close results when clicking outside
    document.addEventListener('click', (e) => {
        if (!inputName.contains(e.target) && !nameResults.contains(e.target)) {
            nameResults.classList.add('hidden');
        }
    });

    const searchInput = document.getElementById('table-search');
    searchInput.addEventListener('input', function() {
        const rows = document.querySelectorAll('.sales-row');
        const query = this.value.toLowerCase().trim();
        let counter = 0;

        rows.forEach(row => {
            const id = row.cells[0].textContent.toLowerCase();
            const name = row.cells[2].querySelector('div:first-child').textContent.toLowerCase();
            const category = row.cells[2].querySelector('div:last-child').textContent.toLowerCase();

            if (id.includes(query) || name.includes(query) || category.includes(query)) {
                row.classList.remove('hidden');
                counter++;
            } else {
                row.classList.add('hidden');
            }
            
        })
        const countText = document.querySelector('.countText');
        if (countText) {
            countText.textContent = `Mostrando ${counter} productos encontrados`;
        }
    });

    window.onload = function() {
        const params = new URLSearchParams(window.location.search);
        if(params.get('status') === 'saved') {
            Swal.fire({
                title: '¡Venta Registrada!',
                text: 'La transacción se guardó correctamente y el stock fue actualizado.',
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