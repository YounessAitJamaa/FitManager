<aside id="sidebar" class="w-64 bg-gray-800 text-white p-6 flex flex-col transition-all duration-300 h-screen">

    <!-- Toggle Button -->
    <button id="toggleBtn" class="mb-6 text-white hover:text-gray-300 self-end">
        <svg id="arrowIcon" class="w-6 h-6 transition-transform duration-300 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Sidebar Title -->
    <h2 id="sidebarTitle" class="text-2xl font-bold mb-8">Dashboard</h2>

    <!-- Navigation -->
    <nav class="flex-1">
        <ul class="space-y-4">

            <li>
                <a href="../pages/index.php" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                    <!-- Home Icon -->
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001 1h4a1 1 0 001-1m-6 0V9" />
                    </svg>
                    <span class="ml-3 sidebar-text">Accueil</span>
                </a>
            </li>

            <li>
                <a href="../pages/cours.php" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                    <!-- Book Icon -->
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.105 0 2-.672 2-1.5S13.105 5 12 5s-2 .672-2 1.5S10.895 8 12 8z" />
                    </svg>
                    <span class="ml-3 sidebar-text">Cours</span>
                </a>
            </li>

            <li>
                <a href="../pages/equipements.php" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                    <!-- Equipment Icon -->
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m-7 4h8M5 8h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V10a2 2 0 012-2z" />
                    </svg>
                    <span class="ml-3 sidebar-text">Équipements</span>
                </a>
            </li>

        </ul>
    </nav>

    <!-- Logout -->
    <div class="mt-auto">
        <a href="../auth/logout.php" class="flex items-center justify-center px-3 py-2 rounded hover:bg-gray-700 bg-red-600">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6-4v8" />
            </svg>
            <span class="ml-3 sidebar-text">Déconnexion</span>
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
