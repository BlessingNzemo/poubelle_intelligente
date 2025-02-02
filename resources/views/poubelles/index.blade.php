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
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            <!-- Poubelle connectée -->
            {{-- @foreach($bins as $bin) --}}
            <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <!-- Indicateur de statut -->
                        <div class="relative">
                            <div class="h-3 w-3 rounded-full
                            {{-- @if($bin->is_connected) --}}

                            {{-- bg-green-500 @else bg-red-500 @endif animate-pulse --}}
                            "></div>
                            <div class="h-3 w-3 rounded-full

                            {{-- @if($bin->is_connected)  --}}

                            {{-- bg-green-200 @else bg-red-200 @endif absolute top-0 left-0 animate-ping --}}
                            "></div>
                        </div>

                        <!-- Informations principales -->
                        <div>
                            <h4 class="font-semibold text-gray-800 dark:text-white">
                                {{-- {{ $bin->name }} --}} Poubelle#12354

                            </h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{-- {{ $bin->location }} -  --}} Kinshasa
                                <span class="
                                {{-- @if($bin->fill_level > 80) --}}


                                text-red-500

                                {{-- @elseif($bin->fill_level > 50) --}}
                                 {{-- text-yellow-500 @else text-green-500 @endif"> --}}
                                    {{-- {{ $bin->fill_level }} --}}

                                  10  % remplie
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Métadonnées -->
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Dernière mise à jour: 12-05-2025

                            {{-- {{ $bin->last_update->diffForHumans() }} --}}
                        </span>
                        <!-- Menu d'actions -->
                        <div class="relative">
                            <button class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-10">
                                <a href="
                                {{-- {{ route('bins.show', $bin->id) }} --}}
                                 " class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Détails</a>
                                <a href="
                                {{-- {{ route('bins.edit', $bin->id) }} --}}
                                 " class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Modifier</a>
                                <form action="
                                {{-- {{ route('bins.destroy', $bin->id) }} --}}
                                 " method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            {{-- @endforeach --}}

            <!-- État vide -->
            {{-- @if($bins->isEmpty()) --}}
            <li class="p-8 text-center text-gray-500 dark:text-gray-400">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <p class="mt-4">Aucune poubelle enregistrée</p>
            </li>
            {{-- @endif --}}
        </ul>
    </div>

    <!-- Pagination -->
    <div class="mt-6 px-6">

    </div>

