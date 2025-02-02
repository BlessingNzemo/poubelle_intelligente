@vite(['resources/css/app.css', 'resources/js/app.js'])
   @include('partials.sidebar')

    <!-- Main Content -->
    <div class="ml-64 p-8 bg-gray-900" >
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestion des Poubelles Connectées</h1>
            <a href="#" class="bg-green-600 text-white px-4 py-2 rounded-lg flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Ajouter une Poubelle
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 dark:text-gray-300">Poubelles Connectées</p>
                        <p class="text-2xl font-bold text-green-600">12</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 dark:text-gray-300">Poubelles Déconnectées</p>
                        <p class="text-2xl font-bold text-red-600">3</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 dark:text-gray-300">Taux de Remplissage Moyen</p>
                        <p class="text-2xl font-bold text-blue-600">62%</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bins List -->
        @include('poubelles.index')

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Niveau de Remplissage</h3>
                <div class="h-64" id="fillLevelChart"></div>
            </div>
            
            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Statut des Poubelles</h3>
                <div class="h-64" id="statusPieChart"></div>
            </div>
        </div>
    </div>
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="px-4 py-3 mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col items-end justify-between sm:flex-row">
                <!-- Navigation rapide -->
                <div class="flex justify-center flex-grow  space-x-6 text-sm text-gray-500 dark:text-gray-400">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-900 dark:hover:text-white">
                        Dashboard
                    </a>
                    <a href="#" class="hover:text-gray-900 dark:hover:text-white">
                        Paramètres
                    </a>
                    <a href="#" class="hover:text-gray-900 dark:hover:text-white">
                        Support
                    </a>
                </div>
    
                <!-- Copyright -->
                <div class="mt-4 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
                    <span>© 2024-2025 PoubelleIntelligente™. </span>
                    <a href="#" class="hover:text-gray-900 dark:hover:text-white">
                        Confidentialité
                    </a>
                </div>
            </div>
        </div>
    </footer>


<!-- Charting Library Script (Ex: Chart.js) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Fill Level Line Chart
    const fillCtx = document.getElementById('fillLevelChart').getContext('2d');
    new Chart(fillCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Niveau de remplissage (%)',
                data: [65, 59, 80, 81, 56, 55],
                borderColor: '#10B981',
                tension: 0.4
            }]
        }
    });

    // Status Pie Chart
    const statusCtx = document.getElementById('statusPieChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Connectées', 'Déconnectées'],
            datasets: [{
                data: [12, 3],
                backgroundColor: ['#10B981', '#EF4444']
            }]
        }
    });
</script>
