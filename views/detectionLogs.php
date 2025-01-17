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
                <div class="mb-4 flex justify-end space-x-4">
                    <div>
                        <label for="startDate" class="block text-sm font-medium text-gray-700">Desde:</label>
                        <input type="date" id="startDate"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            onchange="saveDetectionFilters(); filterDetectionLogs()">
                    </div>
                    <div>
                        <label for="endDate" class="block text-sm font-medium text-gray-700">Hasta:</label>
                        <input type="date" id="endDate"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            onchange="saveDetectionFilters(); filterDetectionLogs()">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200 bg-white">
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
                        <tbody id="table-body_d" class="bg-white divide-y divide-gray-200">
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>
        function toggleMobileMenu() {
            var mobileMenu = document.getElementById("mobile-menu");
            mobileMenu.classList.toggle("hidden");
        }

        function saveDetectionFilters() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            localStorage.setItem('startDate', startDate);
            localStorage.setItem('endDate', endDate);
        }

        function getSavedFilters() {
            const today = new Date().toISOString().slice(0, 10);
            document.getElementById('startDate').value = today;
            document.getElementById('endDate').value = today;
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

        function filterDetectionLogs() {
            if (!validateDates()) return;

            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            axios.post('http://localhost/App/index.php', new URLSearchParams({
                action: 'getDetectionLogs',
                startTime: startDate + 'T00:00:00Z',
                endTime: endDate + 'T23:59:59Z'
            }).toString(), {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
                .then(response => {
                    const logs = response.data;
                    const tableBody = document.getElementById('table-body_d');
                    tableBody.innerHTML = '';
                    logs.forEach(log => {
                        const row = document.createElement('tr');
                        row.classList.add('hover:bg-gray-100');
                        row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${log.action}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${log.timestamp}</td>
            `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching logs:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            getSavedFilters();
            filterDetectionLogs();
            setInterval(filterDetectionLogs, 5000);
        });
    </script>
</body>

</html>
