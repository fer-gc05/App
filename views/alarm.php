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
    <div class="min-h-full">
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
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page">Alarma</a>
                                <a href="index.php?view=alarmLogs"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page">Registro de activacion</a>
                                <a href="index.php?view=detectionLogs"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page">Registro de deteccion</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="hidden md:block relative">
                            <button id="user-menu-button"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium"
                                onclick="toggleDropdown()">Cuenta</button>
                            <div id="user-menu"
                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    onclick="event.preventDefault(); event.stopPropagation(); logout();">Cerrar
                                    sesión</a>
                                <a href="index.php?view=users"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Gestion de
                                    usuarios</a>
                            </div>
                        </div>
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
                        de activacion</a>
                    <a href="index.php?view=detectionLogs"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Registro
                        de deteccion</a>
                    <div class="border-t border-gray-700"></div>
                    <a href=""
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                        onclick="event.preventDefault(); event.stopPropagation(); logout()">Cerrar sesión</a>
                    <a href="index.php?view=users"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Gestion
                        de usuarios</a>
                </div>
            </div>
        </nav>
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">I.E Los Gómez</h1>
            </div>
        </header>
        <main class="px-4 sm:px-6 lg:px-8 py-6">
            <div class="max-w-7xl mx-auto">
                <div class="overflow-x-auto">
                    <div class="sm:overflow-x-auto">
                        <div class="shadow overflow-x-auto border-b border-gray-200 sm:rounded-lg">
                            <div class="sm:flex sm:flex-row sm:justify-start sm:items-center sm:w-full">
                                <div class="w-full sm:w-auto">
                                    <div class="table-responsive">
                                        <table class="w-full table-fixed divide-y divide-gray-200">
                                            <!-- Tabla de alarmas -->
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="sm:w-1/6 px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                                        Nombre
                                                    </th>
                                                    <th scope="col"
                                                        class="sm:w-2/6 px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                                        <!-- Ocultar en dispositivos móviles -->
                                                        Descripción
                                                    </th>

                                                    <th scope="col"
                                                        class="sm:w-1/6 px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                                        Estado
                                                    </th>
                                                    <th scope="col"
                                                        class="sm:w-1/6 px-6 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap sm:w-1/6">
                                                        <div class="text-xs sm:text-sm text-gray-900 break-all"
                                                            style="word-wrap: break-word;">Laser</div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap sm:w-2/6 hidden sm:table-cell">
                                                        <!-- Añade la clase 'hidden' para ocultar en móviles -->
                                                        <div class="text-xs sm:text-sm text-gray-900 break-all"
                                                            style="word-wrap: break-word;">Alarma Perimetral</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap sm:w-1/6 status-label">
                                                        <span id="alarmState"
                                                            class="text-xs sm:text-sm text-black-800"></span>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap sm:w-1/6 text-xs sm:text-sm font-medium">
                                                        <div class="flex items-center justify-center sm:flex-wrap">
                                                            <!-- Add 'justify-center' class to center the buttons -->
                                                            <button onclick="turnOnAlarm();"
                                                                class="py-1 px-3 sm:px-2 mr-2 bg-green-500 text-white rounded-lg">
                                                                <i class='bx bx-power-off'></i>
                                                            </button>
                                                            <button onclick="turnOffAlarm();"
                                                                class="py-1 px-3 sm:px-2 mr-2 bg-red-500 text-white rounded-lg">
                                                                <i class='bx bx-power-off'></i>
                                                            </button>
                                                            <button onclick="showMainMenu();"
                                                                class="py-1 px-3 sm:px-2 mr-2 bg-blue-500 text-white rounded-lg">
                                                                <i class='bx bx-cog'></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function toggleMobileMenu() {
            var mobileMenu = document.getElementById("mobile-menu");
            mobileMenu.classList.toggle("hidden");
        }

        function toggleDropdown() {
            const dropdown = document.getElementById('user-menu');
            dropdown.classList.toggle('hidden');
        }

        function closeDropdownAndExecute(callback) {
            const dropdown = document.getElementById('user-menu');
            dropdown.classList.add('hidden');

            if (typeof callback === 'function') {
                callback();
            }
        }

        document.addEventListener('click', function (event) {
            const dropdown = document.getElementById('user-menu');
            const button = document.getElementById('user-menu-button');

            if (!dropdown.contains(event.target) && event.target !== button) {
                dropdown.classList.add('hidden');
            }
        });

        function turnOnAlarm() {
            Swal.fire({
                title: 'Introduzca la contraseña',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    class: 'bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 block w-full placeholder-gray-500 text-gray-700 focus:outline-none focus:bg-white focus:border-blue-500'
                },
                showCancelButton: true,
                confirmButtonText: 'Activar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    if (!password) {
                        Swal.showValidationMessage('La contraseña es requerida');
                    } else {
                        return axios.post('http://localhost/App/index.php', new URLSearchParams({
                            action: 'turnOnAlarm',
                            password: password
                        }), {
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        })
                            .then(response => {
                                const data = response.data;
                                if (data.message === 'Alarm activated') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Alarma activada!',
                                        text: 'La alarma ha sido activada correctamente',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else if (data.message === 'Alarm already activated') {
                                    Swal.fire({
                                        icon: 'info',
                                        title: '¡Alarma ya activada!',
                                        text: 'La alarma ya se encuentra activada',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else if (data.error === 'Incorrect password') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'La contraseña es incorrecta',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Ocurrió un error al intentar activar la alarma.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }

        function turnOffAlarm() {
            Swal.fire({
                title: 'Introduzca la contraseña',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    class: 'bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 block w-full placeholder-gray-500 text-gray-700 focus:outline-none focus:bg-white focus:border-blue-500'
                },
                showCancelButton: true,
                confirmButtonText: 'Desactivar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    if (!password) {
                        Swal.showValidationMessage('La contraseña es requerida');
                    } else {
                        return axios.post('http://localhost/App/index.php', new URLSearchParams({
                            action: 'turnOffAlarm',
                            password: password
                        }), {
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        })
                            .then(response => {
                                const data = response.data;
                                if (data.message === 'Alarm deactivated') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Alarma desactivada!',
                                        text: 'La alarma ha sido desactivada correctamente',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else if (data.message === 'Alarm already deactivated') {
                                    Swal.fire({
                                        icon: 'info',
                                        title: '¡Alarma desactivada!',
                                        text: 'La alarma ya se encuentra desactivada',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                } else if (data.error === 'Incorrect password') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'La contraseña es incorrecta',
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Ocurrió un error al intentar activar la alarma.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            alarmState();
        });

        async function alarmState() {
            let alarmStateElement = document.getElementById('alarmState');

            while (true) {
                try {
                    const response = await axios.post('http://localhost/App/index.php', new URLSearchParams({
                        action: 'checkAlarmStatus',
                        alarmId: 1
                    }), {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    });

                    const data = response.data;

                    if (data.status === 'Alarm activated') {
                        alarmStateElement.textContent = 'Activa';
                        alarmStateElement.classList.remove('text-red-800');
                        alarmStateElement.classList.add('text-green-800');
                    } else if (data.status === 'Alarm deactivated') {
                        alarmStateElement.textContent = 'Inactiva';
                        alarmStateElement.classList.remove('text-green-800');
                        alarmStateElement.classList.add('text-red-800');
                    } else {
                        console.error('Estado inesperado recibido:', data.status);
                    }

                } catch (error) {
                    console.error('Error al obtener el estado de la alarma:', error);
                }

                await new Promise(resolve => setTimeout(resolve, 2000));
            }
        }

        function showMainMenu() {
            Swal.fire({
                title: 'Menú',
                html: `<button onclick="automotion();" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 w-full">Configurar automatización</button>
                  <button onclick="updatePassword();" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Cambiar contraseña</button>`,
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false,
                customClass: {
                    container: 'text-left'
                }
            });
        }

        function updatePassword() {
            Swal.fire({
                title: 'Cambiar contraseña',
                html: `<div class="input-container">
                      <input type="password" id="currentPassword" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 mb-4 block w-full placeholder-gray-500 text-gray-700 focus:outline-none focus:bg-white" placeholder="Contraseña actual">
                      </div>
                     <div class="input-container">
                      <input type="password" id="newPassword" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 mb-4 block w-full placeholder-gray-500 text-gray-700 focus:outline-none focus:bg-white" placeholder="Nueva contraseña">
                      </div>`,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Ok',
                cancelButtonText: 'Cancelar',
                showValidationMessage: true,
                preConfirm: () => {
                    const currentPassword = document.getElementById('currentPassword').value;
                    const newPassword = document.getElementById('newPassword').value;

                    if (!currentPassword || !newPassword) {
                        Swal.showValidationMessage('Por favor, complete todos los campos');
                    }

                    return axios.post('http://localhost/App/index.php', new URLSearchParams({
                        action: 'updatePassword',
                        currentPassword: currentPassword,
                        newPassword: newPassword
                    }), {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                        .then(response => {
                            const data = response.data;
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Contraseña actualizada',
                                    text: 'La contraseña ha sido actualizada correctamente',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            } else if (data.message === 'The current password is incorrect') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'La contraseña actual es incorrecta',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Error al actualizar la contraseña',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        });
                }
            })
        }

        function automotion() {
            axios.post('http://localhost/App/index.php', new URLSearchParams({
                action: 'getAutomationStatus'
            }), {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
                .then(response => {
                    const data = response.data;

                    const status = data.status;
                    const turnOnHour = data.turnOnHour;
                    const turnOffHour = data.turnOffHour;

                    const statusText = status == 1 ? 'Activa' : 'Inactiva';

                    Swal.fire({
                        title: 'Menú de automatización',
                        html: `
          <div class="p-4">
            <div class="mb-4">
              <p>Estado: <span class="${status == 1 ? 'text-green-500' : 'text-red-500'}">${statusText}</span></p>
              <p>Hora de enecendido: ${turnOnHour}</p>
              <p>Hora de apagado: ${turnOffHour}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <button onclick="activateAutomotion()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                <i class='bx bx-check-circle'></i>
              </button>
              <button onclick="deactivateAutomotion()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                <i class='bx bx-x-circle'></i>
              </button>
              <button onclick="updateAutomationSettings()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                <i class='bx bx-cog'></i>
              </button>
            </div>
          </div>`,
                        showCloseButton: true,
                        showCancelButton: false,
                        showConfirmButton: false,
                        customClass: {
                            container: 'text-left'
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Se produjo un error al recuperar datos de automatización', 'error');
                });

        }

        function activateAutomotion() {
            Swal.fire({
                title: 'Activar automatización?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Activar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('http://localhost/App/index.php', new URLSearchParams({
                        action: 'activateAutomation'
                    }), {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                        .then(response => {
                            const data = response.data;
                            Swal.fire({
                                text: 'Automatización activada',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        })
                        .catch(error => {
                            console.error('Error al activar la automatización:', error);
                            Swal.fire({
                                text: 'Error al activar la automatización',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        });
                }
            });
        }

        function deactivateAutomotion() {
            Swal.fire({
                title: 'Desactivar automatización?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Desactivar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('http://localhost/App/index.php', new URLSearchParams({
                        action: 'deactivateAutomation'
                    }), {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                        .then(response => {
                            const data = response.data;
                            Swal.fire({
                                text: 'Automatización desactivada',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        })
                        .catch(error => {
                            console.error('Error al desactivar la automatización:', error);
                            Swal.fire({
                                text: 'Error al desactivar la automatización',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        });
                }
            });
        }

        function updateAutomationSettings() {
            Swal.fire({
                title: 'Actualizar Configuración',
                html: `
            <div class="input-container">
                <label for="turnOnHour">Hora de encendido:</label>
                <input id="turnOnHour" type="time" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 mb-4 block w-full placeholder-gray-500 text-gray-700 focus:outline-none focus:bg-white" placeholder="Turn On Hour">
            </div>
            <div class="input-container">
                <label for="turnOffHour">Hora de apagado:</label>
                <input id="turnOffHour" type="time" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 mb-4 block w-full placeholder-gray-500 text-gray-700 focus:outline-none focus:bg-white" placeholder="Turn Off Hour">
            </div> `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const turnOnHour = document.getElementById('turnOnHour').value;
                    const turnOffHour = document.getElementById('turnOffHour').value;

                    return axios.post('http://localhost/App/index.php', new URLSearchParams({
                        action: 'updateAutomationConfiguration',
                        turnOnHour: turnOnHour,
                        turnOffHour: turnOffHour
                    }), {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                        .then(response => {
                            const data = response.data;
                            Swal.fire({
                                text: 'Configuración actualizada exitosamente',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Se produjo un error al actualizar la configuración', 'error');
                        });
                }
            });
        }

        async function checkAutomotion() {
            while (true) {
                try {
                    const response = await axios.post('http://localhost/App/index.php', new URLSearchParams({
                        action: 'checkAutomation'
                    }), {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    });

                } catch (error) {
                    console.error('Error al comprobar la automatización:', error);
                }

                await new Promise(resolve => setTimeout(resolve, 1000));
            }
        }
        checkAutomotion();

        function logout() {
            Swal.fire({
                title: 'Cerrar sesión',
                text: '¿Está seguro que desea cerrar sesión?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('http://localhost/App/index.php', new URLSearchParams({
                        action: 'logout'
                    }), {
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                        .then(response => {
                            window.location.href = 'http://localhost/App/index.php';
                        })
                        .catch(error => {
                            console.error('Error al cerrar sesión:', error);
                            Swal.fire({
                                text: 'Error al cerrar sesión',
                                icon: 'error',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        });
                }
            });
        }

    </script>
</body>

</html>
