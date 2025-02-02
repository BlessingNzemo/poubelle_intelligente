@vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- En-tête -->
    <div class="flex items-center justify-between mb-8 px-6">
        <a href="{{ route('bins.index') }}" class="text-gray-500 hover:text-green-600 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour à la liste
        </a>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-500">Dernière mise à jour : {{ $bin->updated_at->diffForHumans() }}</span>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 px-6">
        <!-- Section gauche : Détails techniques -->
        <div class="space-y-6">
            <!-- En-tête -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $bin->name }}</h1>
                    <span class="px-4 py-1 rounded-full text-sm font-medium
                              {{ $bin->is_connected ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $bin->is_connected ? 'Connectée' : 'Déconnectée' }}
                    </span>
                </div>
                <p class="text-gray-600 dark:text-gray-300">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $bin->location }}
                </p>
            </div>

            <!-- Statistiques en temps réel -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Niveau de remplissage -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-gray-500 dark:text-gray-300 font-medium">Remplissage</h3>
                        <span class="text-lg font-bold
                                  {{ $bin->fill_level < 50 ? 'text-green-600' : ($bin->fill_level < 80 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $bin->fill_level }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="h-2 rounded-full
                                  {{ $bin->fill_level < 50 ? 'bg-green-600' : ($bin->fill_level < 80 ? 'bg-yellow-600' : 'bg-red-600') }}"
                             style="width: {{ $bin->fill_level }}%"></div>
                    </div>
                </div>

                <!-- Batterie -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-gray-500 dark:text-gray-300 font-medium">Batterie</h3>
                        <span class="text-lg font-bold
                                  {{ $bin->battery_level > 20 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $bin->battery_level }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="h-2 rounded-full bg-green-600" style="width: {{ $bin->battery_level }}%"></div>
                    </div>
                </div>

                <!-- Signal -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500 dark:text-gray-300 font-medium">Signal</h3>
                        <span class="text-lg font-bold
                                  {{ $bin->signal_strength > 2 ? 'text-green-600' : ($bin->signal_strength > 1 ? 'text-yellow-600' : 'text-red-600') }}">
                            @if($bin->signal_strength == 3) Fort
                            @elseif($bin->signal_strength == 2) Moyen
                            @else Faible @endif
                        </span>
                    </div>
                    <div class="flex space-x-1 mt-3">
                        @for($i = 0; $i < 3; $i++)
                            <div class="w-1/3 h-2 rounded-full
                                      {{ $i < $bin->signal_strength ? 'bg-green-600' : 'bg-gray-200' }}"></div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Carte de localisation -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Localisation</h3>
                <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-lg overflow-hidden">
                    <img src="https://static-maps.yandex.ru/1.x/?lang=fr_FR&ll={{ $bin->longitude }},{{ $bin->latitude }}&z=15&l=map&size=650,400"
                         alt="Localisation de la poubelle" class="object-cover">
                </div>
                <p class="text-sm text-gray-500 mt-2">Coordonnées GPS : {{ $bin->latitude }}, {{ $bin->longitude }}</p>
            </div>
        </div>

        <!-- Section droite : Historique et détails -->
        <div class="space-y-6">
            <!-- Graphique historique -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Historique de remplissage</h3>
                <div class="h-64" id="fillHistoryChart"></div>
            </div>

            <!-- Détails techniques -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Spécifications techniques</h3>
                <dl class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <dt class="text-sm text-gray-500">Type de capteur</dt>
                        <dd class="font-medium">{{ $bin->sensor_type }}</dd>
                    </div>
                    <div class="col-span-1">
                        <dt class="text-sm text-gray-500">Dernière maintenance</dt>
                        <dd class="font-medium">{{ $bin->last_maintenance->format('d/m/Y') }}</dd>
                    </div>
                    <div class="col-span-1">
                        <dt class="text-sm text-gray-500">Version firmware</dt>
                        <dd class="font-medium">v{{ $bin->firmware_version }}</dd>
                    </div>
                    <div class="col-span-1">
                        <dt class="text-sm text-gray-500">UUID</dt>
                        <dd class="font-mono text-sm">{{ $bin->uuid }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Alertes récentes -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Alertes récentes</h3>
                <div class="space-y-3">
                    @forelse($bin->recentAlerts as $alert)
                    <div class="flex items-start p-3 rounded-lg bg-red-50 dark:bg-red-900/20">
                        <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-red-800 dark:text-red-200">{{ $alert->message }}</p>
                            <p class="text-sm text-red-600 dark:text-red-300">{{ $alert->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-4">Aucune alerte récente</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Actions flottantes -->
    <div class="fixed bottom-6 right-6 flex space-x-3">
        <a href="{{ route('bins.edit', $bin->id) }}"
           class="bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
            </svg>
        </a>
        <form action="{{ route('bins.destroy', $bin->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="bg-red-600 text-white p-3 rounded-full shadow-lg hover:bg-red-700 transition-colors"
                    onclick="return confirm('Confirmer la suppression ?')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </form>
    </div>

    <!-- Scripts pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Graphique historique
        const ctx = document.getElementById('fillHistoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($bin->fillHistory->pluck('created_at')->map(fn($date) => $date->format('d/m H:i'))),
                datasets: [{
                    label: 'Niveau de remplissage (%)',
                    data: @json($bin->fillHistory->pluck('level')),
                    borderColor: '#10B981',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>

