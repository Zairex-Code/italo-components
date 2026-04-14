<!-- Sidebar -->
<aside class="w-20 bg-white border-r border-gray-100 flex flex-col items-center py-8 gap-10 h-screen">
    <div class="p-3 bg-gray-900 text-cyan-600 rounded-xl font-serif text-xl">
        <a href="">
            IC
            
        </a>
    </div>
    <?php 
    // Detectamos la página actual
    $current_page = basename($_SERVER['PHP_SELF']); 
    ?>
    <nav class="flex flex-col gap-6 text-gray-400">
        <div class=" <?php echo ($current_page == 'index.php' || $current_page == '') ? 'bg-cyan-500/80 text-white rounded-xl p-2 cursor-pointer hover:bg-cyan-700' : 'hover:text-cyan-500 cursor-pointer '; ?>">
            <a href="/view/index.html">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
            </a>
        </div>


        <div class="<?php echo ($current_page == 'inventory.php') ? 'bg-cyan-500/80 text-white rounded-xl p-2 cursor-pointer hover:bg-cyan-700' : 'hover:text-cyan-500 cursor-pointer '; ?>">
            <a href="/view/inventory.php">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            </a>
        </div>
        
        <div class="hover:text-cyan-500 cursor-pointer item-sidebar <?php echo ($current_page == 'sales.php') ? 'bg-cyan-500/80 text-white rounded-xl p-2 cursor-pointer hover:bg-cyan-700' : 'hover:text-cyan-500 cursor-pointer '; ?>">
            <a href="/view/sales.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </a>
        </div>
        
    </nav>
    <div class="mt-auto">
        <img src="https://ui-avatars.com/api/?name=Dylan&background=0D8ABC&color=fff" class="w-10 h-10 rounded-full border-2 border-cyan-100" alt="Profile">
    </div>
</aside>
