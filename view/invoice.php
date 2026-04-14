<?php
include('../controllers/salesController.php');
include('../controllers/inventoryController.php');
include('../controllers/invoiceController.php');

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
    <main class="flex-1 p-8 overflow-y-auto bg-gray-50/50">
        <!-- Breadcrumbs & Header -->
        <div class="flex justify-between items-end mb-8">
            <div>
                <a href="/view/sales.php"><div class="text-sm text-gray-400 mb-1">Ventas <span class="mx-1"></a>&rsaquo;</span> <span class="text-cyan-600">Detalle de Factura</span></div>
                <h1 class="text-4xl font-serif text-gray-900 tracking-tight">Invoice Details</h1>
            </div>
            <div class="flex gap-3">
                <button class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg text-sm flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download PDF
                </button>
                <button class="px-5 py-2.5 bg-cyan-500 text-white font-semibold rounded-lg text-sm flex items-center gap-2 shadow-md shadow-cyan-500/30 hover:bg-cyan-600 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Print Invoice
                </button>
            </div>
        </div>

        <!-- Invoice Main Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 mb-8 relative">
            <!-- Card Header -->
            <div class="flex justify-between items-center border-b border-gray-100 pb-8 mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 font-serif text-xl bg-gray-900 rounded-xl flex items-center justify-center text-white shadow-lg shadow-gray-900/20">
                        IC
                    </div>
                    <div>
                        <h2 class="text-2xl font-serif text-gray-900 tracking-tight">Italo Components</h2>
                        <p class="text-[9px] font-bold text-gray-400 tracking-widest uppercase">Premium Software Components</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-block bg-amber-100 text-amber-700 text-[9px] font-bold px-3 py-1 rounded-full tracking-widest uppercase mb-3">Invoice Paid</span>
                    <div>
                        <p class="text-[9px] font-bold text-gray-400 tracking-widest uppercase mb-1">Reference No.</p>
                        <p class="text-lg font-mono text-gray-800 font-bold tracking-wide">ICF-2026-<?php ?></p>
                    </div>
                </div>
            </div>

            <!-- 3 Columns Info -->
            <div class="grid grid-cols-3 gap-8 mb-12">
                <div>
                    <h4 class="text-[9px] font-bold text-gray-400 tracking-widest uppercase mb-4">Issued By</h4>
                    <h3 class="text-sm font-bold text-gray-900 mb-1">Italo Components Corp.</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mb-3">Av. 28 de Julio 715, Suite 40<br>Cercado de Lima, PE 15046</p>
                    <span class="text-xs text-gray-500 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        +51 960 144 123
                    </span>
                    <p class="text-xs text-gray-500 flex items-center gap-2">
                        <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                        billing@italocomp.com
                    </p>
                </div>
                <div>
                    <h4 class="text-[9px] font-bold text-gray-400 tracking-widest uppercase mb-4">Bill To</h4>
                    <h3 class="text-sm font-bold text-gray-900 mb-1">Vanguard Design Studio</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mb-3">888 Marble Row, Floor 12<br>New York, NY 10014</p>
                    
                </div>
                <div>
                    <h4 class="text-[9px] font-bold text-gray-400 tracking-widest uppercase mb-4">Dates & Terms</h4>
                    <div class="grid grid-cols-2 gap-y-4 text-xs">
                        <span class="text-gray-400">Invoice Date:</span>
                        <span class="text-gray-900 font-semibold text-right">Oct 24, 2023</span>
                        
                        
                        
                        <span class="text-gray-400">Payment Method:</span>
                        <span class="text-gray-900 font-semibold text-right">Wire Transfer</span>
                    </div>
                </div>
            </div>

            <table class="w-full text-left">
                <thead>
                    <th>
                        <tr class="pb-4 border-b border-gray-100 text-[9px] font-bold text-gray-400 tracking-widest uppercase text-center" >
                            <td >ID</td>
                            <td >IMAGEN</td>
                            <td>PRODUCTO</td>
                            <td>CANTIDAD</td>
                            <td>PRECIO</td>
                            <td class="text-right">TOTAL</td>
                        </tr>
                    </th>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs" >
                    <tr class="gap-4 pb-4 border-b border-gray-100 text-20 font-bold text-gray-400 tracking-widest uppercase text-center" >
                        <td class="px-4 py-4 align-middle">ID</td>
                        <td class="px-4 py-4 align-middle">
                            <div class="w-20 h-20 mx-auto rounded-md bg-gray-100 overflow-hidden shrink-0 border border-gray-200 shadow-sm my-2">
                                <img src="https://images.unsplash.com/photo-1587293852726-70cdb56c2866?auto=format&fit=crop&w=150&q=80" alt="Product" class="w-full h-full object-cover">
                            </div>
                        </td>
                        
                        <td class="px-8 py-4">
                            <div class="font-bold text-gray-900"><?php echo $sale['product_name']; ?></div>
                            <div class="text-[10px] text-gray-400"><?php echo $sale['category']; ?></div>
                        </td>
                        <td>5</td>
                        <td class="text-center">$4.00</td>
                        <td class="text-right">$20.00</td>
                    </tr>
                </tbody>
            </table>


            <!-- Summary Table -->
            <div class="flex justify-end mb-12">
                <div class="w-80">
                    <div class="flex justify-between py-2 text-xs">
                        <span class="text-gray-500">Subtotal:</span>
                        <span class="text-gray-900">$5,580.00</span>
                    </div>
                    <div class="flex justify-between py-2 text-xs">
                        <span class="text-gray-500">Tax (8.5%):</span>
                        <span class="text-gray-900">$474.30</span>
                    </div>
                    <div class="flex justify-between py-2 text-xs">
                        <span class="text-gray-500">Shipping:</span>
                        <span class="text-gray-900">$125.00</span>
                    </div>
                    <div class="flex justify-between py-5 mt-4 border-t border-gray-100">
                        <span class="text-sm font-bold text-gray-900 self-center">Total Amount:</span>
                        <span class="text-2xl font-serif text-teal-800 font-bold">$6,179.30</span>
                    </div>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="flex justify-between items-center pt-8 border-t border-gray-100 text-[10px] text-gray-400">
                <p class="italic text-gray-500 font-serif text-xs">"La calidad de nuestros productos es lo que nos mantiene lideres en el mercado. Gracias por confiar en nosotros."</p>
                <div class="flex items-center gap-6 font-medium">
                    <span class="flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg> 
                        WWW.ITALOCOMPONENTS.COM
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        +51 960 144 123
                    </span>
                </div>
            </div>
        </div>

        
    </main>
</body>
<script>
    
</script>
</html>