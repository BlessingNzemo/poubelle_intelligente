<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16">
            <div class="grid gap-8 lg:grid-cols-2">
                <div class="flex flex-col justify-center">
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        La Gestion des Déchets Intelligente
                    </h1>
                    <p class="mb-6 text-gray-500 lg:mb-8 dark:text-gray-400">
                        Optimisez la collecte de vos déchets grâce à notre solution connectée et écologique.
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                            Commencer maintenant
                        </a>
                        <a href="#features" class="border border-gray-300 hover:bg-gray-100 px-6 py-3 rounded-lg">
                            Découvrir
                        </a>
                    </div>
                </div>
                <img src="/images/smart-bin.png" alt="Poubelle Intelligente" class="hidden lg:block">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-8 text-3xl font-bold text-center">Fonctionnalités Principales</h2>
            <div class="grid gap-8 md:grid-cols-3">
                <a href="{{ route('dashboard') }}" class="p-6 bg-white rounded-lg shadow hover:shadow-lg">
                    <h3 class="mb-2 text-xl font-bold">Tableau de Bord</h3>
                    <p>Suivez en temps réel le niveau de remplissage</p>
                </a>
                <a href="#" class="p-6 bg-white rounded-lg shadow hover:shadow-lg">
                    <h3 class="mb-2 text-xl font-bold">Statistiques</h3>
                    <p>Analysez vos données de collecte</p>
                </a>
                <a href="#" class="p-6 bg-white rounded-lg shadow hover:shadow-lg">
                    <h3 class="mb-2 text-xl font-bold">Alertes</h3>
                    <p>Recevez des notifications intelligentes</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-8 text-3xl font-bold text-center">Notre Impact</h2>
            <div class="grid gap-8 md:grid-cols-3 text-center">
                <div>
                    <h3 class="text-3xl font-bold text-green-600">30%</h3>
                    <p>Réduction des coûts</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-green-600">50%</h3>
                    <p>Optimisation des collectes</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-green-600">25%</h3>
                    <p>Réduction CO2</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
