<?php

include('../controllers/dashboardController.php');

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
    <main class="flex-1 p-8 overflow-y-auto bg-gray-50/50">
      <div class="my-10">
          <h1 class="text-[60px] font-serif text-gray-900 tracking-tight ">Italo Components</h1>
          <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Premium Software Components</p>
      </div>
        <!-- Breadcrumbs & Header -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
          <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex flex-col justify-between hover:shadow-md transition-shadow">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Total Ventas</span>
            <div class="flex items-end justify-between">
                <span class="text-3xl font-serif text-gray-900">$<?php echo number_format($totalSales, 2); ?></span>
                <span class="text-emerald-500 text-xs font-bold">+12%</span>
            </div>
          </div>
          <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex flex-col justify-between hover:shadow-md transition-shadow">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Descuento Ofrecido</span>
            <div class="flex items-end justify-between">
                <span class="text-3xl font-serif text-gray-900">$<?php echo number_format($totalDiscount, 2); ?></span>
                <span class="text-blue-500 text-xs font-bold">Promo Activa</span>
            </div>
          </div>
          <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex flex-col justify-between hover:shadow-md transition-shadow lowStockCard relative cursor-pointer">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Alerta de Bajo Stock</span>
            <div class="flex items-end justify-between">
                <span class="text-3xl font-serif text-rose-600"><?php echo count($lowStock); ?></span>
                <span class="bg-rose-50 text-rose-600 px-2 py-1 rounded-lg text-[10px] font-bold">REVISAR</span>
            </div>
            <!-- Dropdown Container -->
            <div class="lowStockDropDown hidden absolute top-full left-0 mt-2 w-full h- bg-white rounded-2xl shadow-xl border border-gray-100 z-50 max-h-96 overflow-y-auto"></div>
          </div>
        </div>


        <!-- Invoice Main Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10 mb-8 relative">
            <!-- Card Header -->
            <div class="mb-8 flex justify-between items-center">
                <h2 class="text-2xl font-serif text-gray-900 tracking-tight">Top Ventas</h2>
                <button class="text-xs font-bold text-cyan-600 hover:text-cyan-700 uppercase tracking-widest">Ver Todo</button>
            </div>
            
            <!-- Summary Table List -->
            <div class="space-y-6">
                <!-- Item 1 -->
                <div class="flex items-center justify-between group cursor-pointer">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center border border-gray-100 group-hover:border-cyan-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-900 text-sm">Nombre del Componente</span>
                            <span class="text-xs text-gray-400 uppercase tracking-widest font-medium">Categoría Premium</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-serif text-gray-900">$</div>
                        <div class="text-[10px] font-bold text-emerald-500 uppercase tracking-wider">12 unidades vendidas</div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-px bg-gray-50"></div>

                <!-- Item 2 -->
                <div class="flex items-center justify-between group cursor-pointer">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center border border-gray-100 group-hover:border-cyan-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-900 text-sm">Controlador Interactivo</span>
                            <span class="text-xs text-gray-400 uppercase tracking-widest font-medium">Backend Sync</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-serif text-gray-900">$850.00</div>
                        <div class="text-[10px] font-bold text-emerald-500 uppercase tracking-wider">9 unidades vendidas</div>
                    </div>
                </div>
            </div>
        </div>

        
    </main>
</body>
<script>
const lowStockDropDown = document.querySelector(".lowStockDropDown");
const lowStockCard = document.querySelector(".lowStockCard");


    function renderProducts() {
        lowStockDropDown.innerHTML = '';
        
        // Convertimos el array de PHP a un objeto JSON de JavaScript
        const lowStockProducts = <?php echo json_encode($lowStock); ?>;

        if (lowStockProducts && lowStockProducts.length > 0) {
            lowStockDropDown.classList.toggle('hidden');
            lowStockProducts.forEach( product => {
                const item = document.createElement('div');
                item.className = 'flex items-center h-20 space-x-4 p-4 hover:bg-cyan-50 cursor-pointer transition-all border-b border-gray-50 last:border-0 group';
                
                const title = product.name || 'Sin nombre';
                const price = product.price || '0.00';
                const image = product.image || 'https://via.placeholder.com/150';
                const stock = product.stock || 0;
                const category = product.category || 'Sin categoría';

                item.innerHTML = `
                    <div class="relative shrink-0  ">
                        <img src="${image}" class="w-10 h-10 object-cover bg-white rounded-lg border border-gray-100 shadow-sm transition-transform group-hover:scale-105" onerror="this.src='https://via.placeholder.com/150'">
                        ${stock < 5 ? '<span class="absolute -top-1 -right-1 flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span></span>' : ''}
                    </div>
                    <div class="flex-grow min-w-0">
                        <div class="flex justify-between items-start gap-2">
                            <p class="text-sm font-bold text-gray-800 truncate group-hover:text-cyan-600 transition-colors">${title}</p>
                            <span class="text-sm font-black text-cyan-700 bg-cyan-50 px-1.5 py-0.5 rounded shrink-0">$${price}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">${category}</span>
                            <span class="text-[10px] font-bold ${stock > 0 ? 'text-amber-600' : 'text-red-600'} bg-gray-50 px-1 rounded border border-gray-100 italic">Stock: ${stock}</span>
                        </div>
                    </div>`;

                lowStockDropDown.appendChild(item);
            });
        } else {
            lowStockDropDown.innerHTML = '<div class="p-4 text-center text-xs text-gray-500">No hay productos con bajo stock</div>';
            lowStockDropDown.classList.toggle('hidden');
        }
    }

    lowStockCard.addEventListener("click", (e) => {
        e.stopPropagation();
        renderProducts();
    });

    // Close results when clicking outside
    document.addEventListener('click', (e) => {
        if (!lowStockCard.contains(e.target)) {
            lowStockDropDown.classList.add('hidden');
        }
    });
</script>
</html>