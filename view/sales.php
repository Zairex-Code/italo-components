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
                                <input id="product-name" type="text" placeholder="Ej: iPhone 15 Pro Max" name="name" value="<?php echo $name ?>" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 pr-10" required>
                                <div id="search-loader" class="hidden absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="animate-spin h-5 w-5 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                </div>
                            </div>
                            <div id="amazon-results" class="hidden absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-2xl max-h-64 overflow-y-auto divide-y divide-gray-100 top-full"></div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2 tracking-widest">Categoría</label>
                            <select class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 appearance-none" name="category">
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
                            <select name="payment_type" class="w-full bg-gray-100 border-none rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500 appearance-none">
                                <option value="Efectivo" <?php echo ($payment_type == 'Efectivo') ? 'selected' : ''; ?>>Efectivo</option>
                                <option value="Tarjeta" <?php echo ($payment_type == 'Tarjeta') ? 'selected' : ''; ?>>Tarjeta</option>
                                <option value="Transferencia" <?php echo ($payment_type == 'Transferencia') ? 'selected' : ''; ?>>Transferencia</option>
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
                                <input type="number" id="input-price" step="0.01" value="<?php echo $price ?>" name="price" placeholder="0.00" class="w-full bg-gray-100 border-none rounded-lg pl-7 pr-4 py-3 text-sm focus:ring-2 focus:ring-cyan-500" required >
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
                            <th class="px-8 py-5">ID</th>
                            <th class="px-8 py-5">Imagen</th>
                            <th class="px-8 py-5">Producto</th>
                            <th class="px-8 py-5">Cliente</th>
                            <th class="px-8 py-5">fecha de venta</th>
                            <th class="px-8 py-5">Pago</th>
                            <th class="px-8 py-5">total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                       

                    </tbody>
                </table>
                <div class="px-8 py-6 bg-gray-50/50 flex justify-between items-center text-[10px] font-bold text-gray-400 uppercase tracking-widest border-t border-gray-100">
                    <div class="countText">Mostrando <?php echo count($productList); ?> productos</div>
                    
                </div>
            </div>
        </div>
    </main>
</body>
<script>
   
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