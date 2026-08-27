<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Citas</title>
    <link rel="stylesheet" href="public/css/citas.css">
</head>
<body>

<div class="contenedor">

    <!-- HEADER -->
    <div class="top-bar">
        <h2 class="titulo">Módulo Citas</h2>

        <div class="lado-derecho">
            <img src="public/img/logo.png" class="logo">
            <a href="index.php" class="btn-icon">🏠</a>
            <a href="index.php?logout=1" class="btn-salir">Salir</a>
        </div>
    </div>

    <!-- FORMULARIO -->
    <div class="formulario">
        <form method="POST">

            <input type="hidden" name="folio" value="<?= $editar['folio'] ?? '' ?>">

            <div class="grid-form">

                <input type="text" name="nombre" placeholder="Nombre"
                    value="<?= $editar['nombre'] ?? '' ?>" required>

                <input type="text" name="apellido" placeholder="Apellido"
                    value="<?= $editar['apellido'] ?? '' ?>" required>

                <!-- SELECT AREA -->
                <select name="area" required>
                    <option value="">Seleccionar área</option>
                    <?php
                    $areas = ["Nutrición",
                        "Yoga",
                        "Psicología",
                        "Psicología infantil",
                        "Tanatología",
                        "Servicios jurídicos",
                        "Inglés",
                        "Pedagogía"
                    ];

                    foreach($areas as $a){
                        $selected = (($editar['area'] ?? '') == $a) ? 'selected' : '';
                        echo "<option $selected>$a</option>";
                    }
                    ?>
                </select>

                <input type="date" name="fecha"
                    value="<?= $editar['fecha'] ?? '' ?>" required>

                <input type="time" name="hora"
                    value="<?= $editar['hora'] ?? '' ?>" required>

            </div>

            <div class="acciones-form">
                <button type="submit" name="guardar" class="btn-guardar">
                    Guardar
                </button>
            </div>

        </form>
    </div>

    <!-- BUSCADOR -->
    <div class="buscador">
        <form method="POST" action="index.php?modulo=citas&accion=buscar">

            <input type="text" name="buscar" placeholder="Buscar por folio">

            <button class="btn-buscar">Buscar</button>

            <a href="index.php?modulo=citas" class="btn-buscar">
                Mostrar todos
            </a>

            <a href="index.php?pdf=1&modulo=citas" target="_blank" class="btn-pdf">
                PDF
            </a>

        </form>
    </div>

    <!-- TABLA -->
    <div class="tabla-responsive">
        <table>
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Área</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($datos as $c): ?>
                <tr>
                    <td><?= $c['folio'] ?></td>
                    <td><?= $c['nombre'] ?></td>
                    <td><?= $c['apellido'] ?></td>
                    <td><?= $c['area'] ?></td>
                    <td><?= $c['fecha'] ?></td>
                    <td><?= $c['hora'] ?></td>
                    <td>
                        <a href="index.php?modulo=citas&editar=<?= $c['folio'] ?>"
                           class="btn-actualizar">Editar</a>

                        <a href="index.php?modulo=citas&eliminar=<?= $c['folio'] ?>"
                           class="btn-eliminar"
                           onclick="return confirm('¿Eliminar cita?')">
                           Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

</div>

<!-- SWEET ALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>