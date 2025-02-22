<!-- filepath: /C:/wamp64/www/PoubelleIntelligent/resources/views/components/add-bin-modal.blade.php -->
<!-- Main modal -->
<div id="add-bin-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden overflow-y-auto overflow-x-hidden md:inset-0 h-full flex justify-center items-center bg-gray-900 bg-opacity-50 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- En-tête Modal -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Ajouter une nouvelle poubelle
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ms-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="toggleModal()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Corps Modal -->
            <div class="p-4 md:p-5">
                <form id="addBinForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="serial_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de série</label>
                        <div class="flex">
                            <input type="text" name="serial_number" id="serial_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required readonly />
                            <button type="button" onclick="generateSerialNumber()" class="ms-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Générer</button>
                        </div>
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Emplacement</label>
                        <input type="text" name="location" id="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div>
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Utilisateur</label>
                        <select id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </select>
                    </div>
                    <button type="submit" id="saveBin" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Ajouter la poubelle</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Charger les utilisateurs au chargement de la page
    loadUsers();

    // Gestionnaire de soumission du formulaire
    $('#addBinForm').on('submit', function(event) {
        event.preventDefault();

        // Récupérer les données du formulaire
        var formData = {
            serial_number: $('#serial_number').val(),
            name: $('#name').val(),
            location: $('#location').val(),
            user_id: $('#user_id').val()
        };

        // Récupérer le token CSRF
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Envoyer la requête API
        $.ajax({
            url: '/api/bins',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Succès!',
                    text: 'La poubelle a été créée avec succès'
                }).then((result) => {
                    toggleModal();
                    location.reload();
                });
            },
            error: function(xhr) {
                let errorMessage = 'Une erreur est survenue';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = Object.values(xhr.responseJSON.errors).join('\n');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur!',
                    text: errorMessage
                });
            }
        });
    });
});

// Fonction pour charger les utilisateurs
function loadUsers() {
    $.get('/api/users', function(users) {
        const select = $('#user_id');
        select.empty();
        users.forEach(function(user) {
            select.append(new Option(user.name, user.id));
        });
    });
}

// Fonction pour générer le numéro de série
function generateSerialNumber() {
    $.get('/api/generate-serial', function(data) {
        $('#serial_number').val(data.serial_number);
    });
}

// Fonction pour basculer la visibilité de la modal
function toggleModal() {
    $('#add-bin-modal').toggleClass('hidden');
}
</script>
