{{-- <x-app-layout> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- En-tête -->
    <div

    <!-- Liste des poubelles -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden ">
        <!-- En-tête de liste -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Liste des Poubelles</h3>
        </div>

        <!-- Contenu dynamique -->
        <ul id="binsList" class="divide-y divide-gray-200 dark:divide-gray-700">
            <!-- Les poubelles seront insérées ici dynamiquement -->
        </ul>

        <!-- Template pour l'état vide -->
        <div id="emptyState" class="hidden p-8 text-center text-gray-500 dark:text-gray-400">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <p class="mt-4">Aucune poubelle enregistrée</p>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 px-6">

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Récupérer l'ID de l'utilisateur connecté depuis une balise meta ou une variable PHP
        const userId = {{ auth()->id() }};
        loadBins(userId);

        function loadBins(userId) {
            fetch(`/api/bins/${userId}`)
                .then(response => response.json())
                .then(data => {
                    const binsList = document.getElementById('binsList');
                    const emptyState = document.getElementById('emptyState');
                    
                    if (data.data.length === 0) {
                        binsList.innerHTML = '';
                        emptyState.classList.remove('hidden');
                        return;
                    }

                    emptyState.classList.add('hidden');
                    binsList.innerHTML = data.data.map(bin => `
                        <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <div class="h-3 w-3 rounded-full bg-green-500 animate-pulse"></div>
                                        <div class="h-3 w-3 rounded-full bg-green-200 absolute top-0 left-0 animate-ping"></div>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 dark:text-white">
                                            ${bin.name}
                                        </h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            ${bin.location} - ${bin.serial_number}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        Dernière mise à jour: ${new Date(bin.updated_at).toLocaleDateString()}
                                    </span>
                                    <div class="flex space-x-2">
                                        <button onclick="viewBin(${bin.id})" class="p-2 text-blue-600 hover:bg-blue-100 rounded-full">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        <button onclick="deleteBin(${bin.id})" class="p-2 text-red-600 hover:bg-red-100 rounded-full">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    `).join('');
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Impossible de charger les poubelles'
                    });
                });
        }

        window.viewBin = function(binId) {
            window.location.href = `/poubelles/${binId}`;
        }

        window.deleteBin = function(binId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Cette action est irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    fetch(`/api/bins/${binId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur lors de la suppression');
                        }
                        Swal.fire(
                            'Supprimé!',
                            'La poubelle a été supprimée.',
                            'success'
                        );
                        loadBins(userId); // Recharger la liste
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        Swal.fire(
                            'Erreur!',
                            'La suppression a échoué.',
                            'error'
                        );
                    });
                }
            });
        }
    });
    </script>
</div>

