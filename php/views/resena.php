<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/normalize.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style_resena.css">
    <title>Reseña</title>
</head>
<body>
    <form action="../controllers/resena.php" method="post">
        <label for="idUsuarioT">ID del Turista:</label>
        <input type="text" name="idUsuarioT" required><br>

        <label for="idUsuarioR">ID del Restaurante:</label>
        <input type"text" name="idUsuarioR" required><br>

        <label for="fechaResenia">Fecha de la Reseña:</label>
        <input type="date" name="fechaResenia" required><br>

        <label for="caliRecinto">Calificación del Recinto:</label>
        <select name="caliRecinto" required>
            <option value="Insuficiente">Insuficiente</option>
            <option value="Medio">Medio</option>
            <option value="Excelente">Excelente</option>
        </select><br>

        <label for="caliPersonal">Calificación del Personal:</label>
        <select name="caliPersonal" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br>

        <label for="caliGeneral">Calificación General:</label>
        <select name="caliGeneral" required>
            <option value="Muy malo">Muy malo</option>
            <option value="Malo">Malo</option>
            <option value="Medio">Medio</option>
            <option value="Bueno">Bueno</option>
            <option value="Muy bueno">Muy bueno</option>
        </select><br>

        <label for="caliMenu">Calificación del Menú:</label>
        <select name="caliMenu" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br>

        <a type="submit" class="btn" href="javascript:void(0);" onclick="document.getElementById('submitBtn').click();">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Enviar Reseña
        </a>
        <button id="boton" href="#">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Volver
        </button>
        <input type="submit" id="submitBtn" value="Enviar solicitud de recuperación" style="display: none;">
    </form>

    <script>
        // Obtener el botón por su ID
        var boton = document.getElementById("boton");

        // Agregar un evento de clic al botón
        boton.addEventListener("click", function () {
            // Redirigir a la otra página dentro del mismo archivo
            window.location.href = "../models/panel_turista.php";
        });
    </script>
</body>
</html>
