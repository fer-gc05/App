<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="bg-blue-100">
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl mb-4">Login</h2>
            <form id="loginForm" class="w-full max-w-md">
                <div class="mb-8">
                    <label for="user" class="block mb-2">Usuario</label>
                    <input type="text" id="user" name="username"
                        class="w-full px-4 py-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2">Contraseña</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded"
                        onclick="login(event);">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function login(event) {
            event.preventDefault();

            let username = document.getElementById('user').value;
            let password = document.getElementById('password').value;

            if (username === '' || password === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor, complete todos los campos',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                return;
            }

            axios.post('http://localhost/App/index.php', new URLSearchParams({
                action: 'login',
                username: username,
                password: password
            }), {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            })
                .then(response => {
                    let data = response.data;
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Bienvenido!',
                            text: 'Iniciando sesión...',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            window.location.href = 'http://localhost/App/index.php?view=alarm';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Usuario o contraseña incorrectos',
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
                        text: 'Ha ocurrido un error',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    console.error(error);
                });
        }
    </script>
</body>

</html>
