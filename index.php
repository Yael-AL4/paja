<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAN Squad</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #000;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            background-color: #333;
            border-radius: 5px;
        }

        .section {
            display: none;
            padding: 20px;
            background-color: black;
            color: white;
            position: relative;
            z-index: 1;
        }

        .section.active {
            display: block;
        }

        .content-box {
            background-color: white;
            color: black;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .content-box:hover {
            background-color: #f0f0f0;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        .form-container input, .form-container button {
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            border: none;
            width: 80%;
            max-width: 300px;
        }

        .form-container button {
            background-color: white;
            color: black;
            cursor: pointer;
            font-weight: bold;
        }

        .profile-container {
            background-color: #333;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-container h2 {
            margin-bottom: 5px;
        }

        .profile-container p {
            margin: 5px 0;
        }

        .upload-form {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .upload-form input[type="text"], .upload-form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            resize: vertical;
        }

        .upload-form input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">NAN Squad</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#home" onclick="showSection('home')">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#cracked" onclick="showSection('cracked')">Cracked</a></li>
                <li class="nav-item"><a class="nav-link" href="#doxes" onclick="showSection('doxes')">Doxes</a></li>
                <li class="nav-item"><a class="nav-link" href="#team" onclick="showSection('team')">Team</a></li>
                <li class="nav-item"><a class="nav-link" href="#register" onclick="showSection('register')" id="registerLink">Registrarse</a></li>
                <li class="nav-item"><a class="nav-link" href="#login" onclick="showSection('login')" id="loginLink">Ingresar</a></li>
                <li class="nav-item"><span class="user-info" id="userInfo" onclick="toggleUserInfo()">
                    <span id="username"></span>
                    <img id="profileImg" src="" alt="Foto de Perfil">
                    <button onclick="logout(event)">Cerrar Sesión</button>
                </span></li>
            </ul>
        </div>
    </nav>

    <div id="home" class="section active">
        <center>
            <img src="https://steamuserimages-a.akamaihd.net/ugc/860608952292531464/84B7EC1BF2F39338FABA3B7941AF7C957E83401A/?imw=268&imh=268&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=true" alt="NAN Squad">
        </center>
        <center>
            <marquee>
                <h1>#NANSquad #hewillneverdie</h1>
            </marquee>
        </center>
    </div>

    <div id="doxes" class="section">
        <center>
            <div class="upload-form">
                <h2>Subir Doxeo</h2>
                <form id="doxForm" action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="doxTitle" placeholder="Título" required><br>
                    <textarea name="doxContent" rows="5" placeholder="Contenido" required></textarea><br>
                    <input type="text" name="doxAuthor" placeholder="Autor" required><br>
                    <input type="submit" value="Subir Doxeo">
                </form>
            </div>
        </center>
        <div id="doxList">
            <!-- Aquí se listarán los doxeos subidos -->
            <?php
            require 'config.php';

            try {
                $stmt = $pdo->query("SELECT * FROM doxes");
                while ($row = $stmt->fetch()) {
                    echo '<div class="content-box">';
                    echo '<h3>' . htmlspecialchars($row['titulo']) . '</h3>';
                    echo '<p>' . nl2br(htmlspecialchars($row['contenido'])) . '</p>';
                    echo '<p><small>Autor: ' . htmlspecialchars($row['autor']) . '</small></p>';
                    echo '</div>';
                }
            } catch (Exception $e) {
                echo 'Error al cargar los doxeos: ' . $e->getMessage();
            }
            ?>
        </div>
    </div>

    <div id="cracked" class="section">
        <center>
            <div class="content-box">
                <h2>Coming Soon</h2>
                <p>Esta sección estará disponible próximamente.</p>
            </div>
        </center>
    </div>

    <div id="team" class="section">
        <center>
            <div class="content-box">
                <h2>Equipo</h2>
                <p>Detalles del equipo aquí.</p>
            </div>
        </center>
    </div>

    <div id="register" class="section">
        <center>
            <div class="form-container">
                <h2>Registrarse</h2>
                <form id="registerForm" action="register.php" method="post">
                    <input type="text" name="username" placeholder="Usuario" required><br>
                    <input type="password" name="password" placeholder="Contraseña" required><br>
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </center>
    </div>

    <div id="login" class="section">
        <center>
            <div class="form-container">
                <h2>Ingresar</h2>
                <form id="loginForm" action="login.php" method="post">
                    <input type="text" name="username" placeholder="Usuario" required><br>
                    <input type="password" name="password" placeholder="Contraseña" required><br>
                    <button type="submit">Ingresar</button>
                </form>
            </div>
        </center>
    </div>

    <div id="profile" class="section">
        <div class="profile-container">
            <img id="profileImgView" src="" alt="Foto de Perfil">
            <h2 id="usernameView"></h2>
            <p id="userBio"></p>
        </div>
    </div>

    <script>
        function showSection(sectionId) {
            var sections = document.getElementsByClassName('section');
            for (var i = 0; i < sections.length; i++) {
                if (sections[i].id === sectionId) {
                    sections[i].classList.add('active');
                } else {
                    sections[i].classList.remove('active');
                }
            }
            var userInfo = document.getElementById('userInfo');
            if (userInfo.classList.contains('active')) {
                userInfo.classList.remove('active');
            }
        }

        function toggleUserInfo() {
            var userInfo = document.getElementById('userInfo');
            userInfo.classList.toggle('active');
        }

        function logout(event) {
            event.preventDefault();
            function logout() {
    const cookies = document.cookie.split("; ");
    for (let c of cookies) {
        const [name, _] = c.split("=");
        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
    }

    localStorage.clear();
    sessionStorage.clear();

    window.location.href = "/login";
}
            alert('Cerrar Sesión');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
