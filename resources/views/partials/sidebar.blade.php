<!-- Sidebar flottant -->
<aside class="fixed left-0 top-0 h-screen w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 shadow-2xl transform transition-all duration-300 ease-in-out z-50">
    <div class="flex flex-col h-full">
        <!-- En-tête avec logo -->
        <div class="p-6 pb-4">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <x-application-logo class="w-8 h-8 text-green-500" />
                <span class="text-xl font-bold text-gray-800 dark:text-white">Poubelle intelligente</span>
            </a>
        </div>

        <!-- Menu principal -->
        <nav class="flex-1 overflow-y-auto px-3">
            <ul class="space-y-1">
                <!-- Tableau de bord -->
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center p-3 rounded-lg hover:bg-green-50 dark:hover:bg-gray-700 transition-colors group">
                        <svg class="w-5 h-5 text-green-500 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="ml-3 font-medium text-gray-700 dark:text-gray-200">Tableau de bord</span>
                    </a>
                </li>

                <!-- Poubelles connectées -->
                <li>
                    <a href="#"
                       class="flex items-center p-3 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors group">
                        <svg class="w-5 h-5 text-blue-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span class="ml-3 font-medium text-gray-700 dark:text-gray-200">Poubelles</span>
                    </a>
                </li>

                <!-- Analytics -->
                <li>
                    <a href="#"
                       class="flex items-center p-3 rounded-lg hover:bg-purple-50 dark:hover:bg-gray-700 transition-colors group">
                        <svg class="w-5 h-5 text-purple-500 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="ml-3 font-medium text-gray-700 dark:text-gray-200">Analytics</span>
                    </a>
                </li>

                <!-- Section Administration -->
                <li class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-600">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Administration</h3>
                    <ul class="mt-2 space-y-1">
                        <li>
                            <a href="#"
                               class="flex items-center p-3 rounded-lg hover:bg-yellow-50 dark:hover:bg-gray-700 transition-colors group">
                                <svg class="w-5 h-5 text-yellow-500 group-hover:text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="ml-3 font-medium text-gray-700 dark:text-gray-200">Paramètres</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Section compte utilisateur -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center space-x-3">
                <img class="w-9 h-9 rounded-full" src="{{ asset('images/avatar.svg') }}" alt="{{ Auth::user()->name }}">
                <div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-gray-500 hover:text-red-600 transition-colors">Déconnexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</aside>

{{-- <!-- Contenu principal -->
<div class="ml-64 p-8 transition-all duration-300 ease-in-out">
    <!-- Votre contenu existant ici -->
</div> --}}

<style>
    /* Animation personnalisée */
    .hover-scale {
        transition: transform 0.2s ease;
    }
    
    .hover-scale:hover {
        transform: translateX(4px);
    }

    /* Scrollbar personnalisée */
    nav::-webkit-scrollbar {
        width: 6px;
    }

    nav::-webkit-scrollbar-track {
        background: transparent;
    }

    nav::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 4px;
    }

    .dark nav::-webkit-scrollbar-thumb {
        background: #4b5563;
    }
</style>
