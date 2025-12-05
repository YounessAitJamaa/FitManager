<aside id="sidebar" class="w-64 bg-slate-950 text-slate-50 p-6 flex flex-col transition-all duration-300 h-screen border-r border-slate-800">

    <!-- Toggle Button -->
    <button id="toggleBtn" class="mb-8 text-slate-400 hover:text-slate-200 transition-colors self-end">
        <svg id="arrowIcon" class="w-5 h-5 transition-transform duration-300 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Logo Section -->
    <div class="mb-8 pb-8 border-b border-slate-800">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-pink-500 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-sm">D</span>
            </div>
            <h2 id="sidebarTitle" class="text-xl font-bold text-slate-50 transition-opacity duration-300">Dashboard</h2>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1">
        <ul class="space-y-2">

            <li>
                <a href="../pages/index.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-indigo-400 transition-all duration-200 group">
                    <svg class="w-5 h-5 flex-shrink-0 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001 1h4a1 1 0 001-1m-6 0V9" />
                    </svg>
                    <span class="sidebar-text text-sm font-medium">Home</span>
                </a>
            </li>

            <li>
                <a href="../pages/cours.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-indigo-400 transition-all duration-200 group">
                    <svg class="w-5 h-5 flex-shrink-0 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747m0-13c5.5 0 10 4.745 10 10.747S17.5 27.747 12 27.747" />
                    </svg>
                    <span class="sidebar-text text-sm font-medium">Courses</span>
                </a>
            </li>

            <li>
                <a href="../pages/equipements.php" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-indigo-400 transition-all duration-200 group">
                    <svg class="w-5 h-5 flex-shrink-0 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-7 4h8M5 8h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2z" />
                    </svg>
                    <span class="sidebar-text text-sm font-medium">Equipment</span>
                </a>
            </li>

        </ul>
    </nav>

    <!-- Logout -->
    <div class="pt-6 border-t border-slate-800">
        <a href="../auth/logout.php" class="flex items-center justify-center gap-3 px-4 py-3 rounded-lg bg-gradient-to-r from-pink-600 to-red-600 text-white hover:from-pink-700 hover:to-red-700 transition-all duration-200 font-medium text-sm">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6-4v8" />
            </svg>
            <span class="sidebar-text">Logout</span>
        </a>
    </div>

</aside>

<script>
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleBtn");
    const sidebarText = document.querySelectorAll(".sidebar-text");
    const sidebarTitle = document.getElementById("sidebarTitle");
    const arrowIcon = document.getElementById("arrowIcon");

    let isCollapsed = false;

    toggleBtn.addEventListener("click", () => {
        isCollapsed = !isCollapsed;

        // Toggle sidebar width
        sidebar.classList.toggle("w-64");
        sidebar.classList.toggle("w-20");

        // Hide/show text
        sidebarText.forEach(text => text.classList.toggle("hidden"));

        // Hide title
        sidebarTitle.classList.toggle("hidden");

        // Rotate arrow
        arrowIcon.classList.toggle("rotate-180");
    });
</script>
