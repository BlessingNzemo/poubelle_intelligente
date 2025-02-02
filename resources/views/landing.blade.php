<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-400 to-blue-500 dark:from-green-600 dark:to-blue-700">
        <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8 lg:py-24">
            <div class="grid items-center gap-8 lg:grid-cols-2">
                <div class="max-w-lg mx-auto text-center lg:text-left lg:mx-0">
                    <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                        Gestion Intelligente des Déchets
                    </h1>
                    <p class="mt-4 text-xl text-green-100">
                        Optimisez la collecte de vos déchets avec notre solution IoT écologique et connectée.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 mt-8 lg:justify-start">
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 text-lg font-semibold text-green-600 bg-white rounded-full hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Commencer maintenant
                        </a>
                        <a href="#features" class="inline-flex items-center px-6 py-3 text-lg font-semibold text-white border-2 border-white rounded-full hover:bg-white hover:text-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Découvrir
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <img src="{{asset('images/robot.svg')}}" alt="Poubelle Intelligente" class="w-full max-w-md mx-auto rounded-lg ">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white sm:text-4xl">
                Fonctionnalités Principales
            </h2>
            <div class="grid gap-8 mt-12 sm:grid-cols-2 lg:grid-cols-3">
                <div class="relative p-8 bg-white rounded-lg shadow-md dark:bg-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="absolute top-0 left-0 p-4">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <div class="mt-16">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Tableau de Bord</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Suivez en temps réel le niveau de remplissage et optimisez vos collectes.</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center mt-4 text-green-600 hover:text-green-500">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
                <div class="relative p-8 bg-white rounded-lg shadow-md dark:bg-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="absolute top-0 left-0 p-4">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <div class="mt-16">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Statistiques</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Analysez vos données de collecte pour une meilleure prise de décision.</p>
                    </div>
                    <a href="#" class="inline-flex items-center mt-4 text-green-600 hover:text-green-500">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
                <div class="relative p-8 bg-white rounded-lg shadow-md dark:bg-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="absolute top-0 left-0 p-4">
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <div class="mt-16">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Alertes</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Recevez des notifications intelligentes pour une gestion proactive.</p>
                    </div>
                    <a href="#" class="inline-flex items-center mt-4 text-green-600 hover:text-green-500">
                        En savoir plus
                        <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 dark:text-white sm:text-4xl">
                Notre Impact
            </h2>
            <div class="grid gap-8 mt-12 sm:grid-cols-3">
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-green-100">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-green-600">30%</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Réduction des coûts</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-green-100">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-green-600">50%</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Optimisation des collectes</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-green-100">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold text-green-600">25%</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Réduction CO2</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
