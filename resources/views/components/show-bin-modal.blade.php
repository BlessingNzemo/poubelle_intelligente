<!-- Modal de détails -->
<div id="showBinModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden overflow-y-auto overflow-x-hidden w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Contenu du modal -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- En-tête du modal -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="binModalTitle">
                    Détails de la poubelle
                </h3>
                <button type="button" onclick="closeShowModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <!-- Corps du modal -->
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informations générales -->
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nom</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binName"></p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Numéro de série</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binSerialNumber"></p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Emplacement</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binLocation"></p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Date d'installation</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binCreatedAt"></p>
                        </div>
                    </div>

                    <!-- Données des capteurs -->
                    <div id="sensorData" class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Niveau de remplissage</p>
                            <div class="flex items-center space-x-2">
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div id="fillLevelBar" class="bg-green-600 h-2.5 rounded-full" style="width: 0%"></div>
                                </div>
                                <span id="fillLevelText" class="text-sm font-medium text-gray-900 dark:text-white">0%</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Température</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binTemperature">N/A</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Humidité</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binHumidity">N/A</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">État d'ouverture</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binIsOpen">N/A</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Latitude</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binLatitude">N/A</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Longitude</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="binLongitude">N/A</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Dernière mise à jour</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white" id="lastUpdate">N/A</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showBinDetails(binId) {
    fetch(`/api/bins/${binId}/details`)
        .then(response => response.json())
        .then(data => {
            const bin = data.data;

            // Mettre à jour les informations générales
            document.getElementById('binModalTitle').textContent = bin.name;
            document.getElementById('binName').textContent = bin.name;
            document.getElementById('binSerialNumber').textContent = bin.serial_number;
            document.getElementById('binLocation').textContent = bin.location;
            document.getElementById('binCreatedAt').textContent = bin.created_at;

            // Vérifier si les données des capteurs sont disponibles
            if (bin.has_sensor_data && bin.sensor_data) {
                const sensorData = bin.sensor_data;

                // Mettre à jour les données des capteurs
                document.getElementById('fillLevelBar').style.width = `${sensorData.fill_level}%`;
                document.getElementById('fillLevelText').textContent = `${sensorData.fill_level}%`;
                document.getElementById('binTemperature').textContent = `${sensorData.temperature}°C`;
                document.getElementById('binHumidity').textContent = `${sensorData.humidity}%`;
                document.getElementById('binIsOpen').textContent = sensorData.is_open ? 'Ouvert' : 'Fermé';
                document.getElementById('binLatitude').textContent = sensorData.latitude;
                document.getElementById('binLongitude').textContent = sensorData.longitude;
                document.getElementById('lastUpdate').textContent = sensorData.last_update;

                // Afficher la section des données des capteurs
                document.getElementById('sensorData').classList.remove('hidden');
            } else {
                // Masquer la section des données des capteurs si non disponibles
                document.getElementById('sensorData').classList.add('hidden');
            }

            // Afficher le modal
            document.getElementById('showBinModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Erreur:', error);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Impossible de charger les détails de la poubelle'
            });
        });
}

function closeShowModal() {
    document.getElementById('showBinModal').classList.add('hidden');
}
</script>