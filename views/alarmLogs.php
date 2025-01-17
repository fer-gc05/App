<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de alarma</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="h-full">
    <div class="min-h-full flex flex-col">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="index.php?view=alarm"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Alarma</a>
                                <a href="index.php?view=alarmLogs"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Registro
                                    de activación</a>
                                <a href="index.php?view=detectionLogs"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Registro
                                    de detección</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="-mr-2 flex md:hidden">
                            <button type="button"
                                class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
                                <span class="sr-only">Open main menu</span>
                                <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:hidden hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3 shadow">
                    <a href="index.php?view=alarm"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Alarma</a>
                    <a href="index.php?view=alarmLogs"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Registro
                        de activación</a>
                    <a href="index.php?view=detectionLogs"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Registro
                        de detección</a>
                </div>
            </div>
        </nav>
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">I.E Los Gómez</h1>
            </div>
        </header>
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:justify-between">
                    <div class="flex flex-col gap-2">
                        <label for="searchInput" class="block text-sm font-medium text-gray-700">Buscar:</label>
                        <input type="text" id="searchInput"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            oninput="saveFilters(); filterLogs()">
                    </div>
                    <div class="flex flex-col gap-2 sm:flex-row sm:gap-4">
                        <div>
                            <label for="startDate" class="block text-sm font-medium text-gray-700">Desde:</label>
                            <input type="date" id="startDate"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                onchange="validateDates(); saveFilters(); filterLogs()">
                        </div>
                        <div>
                            <label for="endDate" class="block text-sm font-medium text-gray-700">Hasta:</label>
                            <input type="date" id="endDate"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                onchange="validateDates(); saveFilters(); filterLogs()">
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acción
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha y Hora
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function saveFilters() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            localStorage.setItem('searchInput', searchInput);

        }

        function getSavedFilters() {
            const searchInput = localStorage.getItem('searchInput') || '';
            document.getElementById('searchInput').value = searchInput;

        }

        function validateDates() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const today = new Date().toISOString().slice(0, 10);

            if (startDate && endDate && startDate > endDate) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    text: 'La fecha limite superior no puede ser menor a la fecha limite inferior.',
                });
                document.getElementById('startDate').value = today;
                document.getElementById('endDate').value = today;
                return false;
            }

            if (startDate === '') {
                document.getElementById('startDate').value = today;
            }

            if (endDate === '') {
                document.getElementById('endDate').value = today;
            }

            return true;
        }

        async function filterLogs() {
            if (!validateDates()) return;

            const searchInput = document.getElementById('searchInput').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            try {
                const response = await axios.post('http://localhost/App/index.php', new URLSearchParams({
                    action: 'getAlarmLogs',
                    search: searchInput,
                    startTime: startDate,
                    endTime: endDate
                }));

                const data = response.data;

                if (Array.isArray(data)) {
                    const tableBody = document.getElementById('table-body');
                    tableBody.innerHTML = '';
                    data.forEach((log) => {
                        const row = document.createElement('tr');
                        row.classList.add('bg-white');
                        row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">${log.action}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">${log.timestamp}</div>
                    </td>
                `;
                        tableBody.appendChild(row);
                    });
                } else {
                    console.error('Error: La respuesta del servidor no es un array.', data);
                }
            } catch (error) {
                console.error('Error:', error.response ? error.response.data : error.message);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date().toISOString().slice(0, 10);
            document.getElementById('startDate').value = today;
            document.getElementById('endDate').value = today;
            getSavedFilters();
            filterLogs();
            setInterval(filterLogs, 5000);
        });
    </script>
</body>

</html>
