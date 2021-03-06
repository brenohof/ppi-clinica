<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style/private.css">
    <title>Clínica - Painel Adiministrativo</title>
</head>

<body>
    <header>
        <nav class="p-4 navbar navbar-expand-md navbar-dark shadow">
            <div class="container">
                <a href="../../index.html" class="navbar-brand">
                    <img class="logo" src="../../assets/logo.svg" alt="" width="64" height="64">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="justify-content-end collapse navbar-collapse" id="navbarNav">
                    <li class="nav-item dropdown">
                        <a class="link nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastrar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a prop-spa="./cadastro-paciente.html" class="dropdown-item" href="#">Paciente</a></li>
                            <li><a form-funcionario="./cadastro-funcionario.html" id="form-funcionario" class="dropdown-item" href="#">Funcionário</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="link nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Listar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a prop-spa="./lista-pacientes.php" class="dropdown-item" href="#">Pacientes</a></li>
                            <li><a prop-spa="./lista-funcionarios.php" class="dropdown-item" href="#">Funcionários</a></li>
                            <li><a prop-spa="./lista-enderecos.php" class="dropdown-item" href="#">Endereços</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </nav>
    </header>
    <div class="display">
        <main class="mb-5">
            <div id="spa" class="container">
                <?php
                $login = true;
                ?>
            </div>
        </main>

        <footer></footer>
    </div>
    <!-- Scripts -->
    <script src="../../js/showMedico.js"></script>
    <script src="../../js/spa.js"></script>
    <script>
        window.onload = function() {
            singlePageApplication()
            specialPage('[form-funcionario]')
        }
    </script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>

</html>