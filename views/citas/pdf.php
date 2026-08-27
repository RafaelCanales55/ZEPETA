<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Citas</title>

<style>
body{ font-family: Arial; padding:20px;}
.header{ display:flex; justify-content:space-between;}
.logo{ width:100px;}
table{ width:100%; border-collapse:collapse; margin-top:20px;}
th{ background:#333; color:#fff; padding:8px;}
td{ border:1px solid #ccc; padding:6px;}
tr:nth-child(even){ background:#f2f2f2;}
</style>

</head>
<body>

<button onclick="window.print()">🖨️ Imprimir PDF</button>

<div class="header">
    <img src="public/img/logo.png" class="logo">

    <div>
        <h2>Reporte de Citas</h2>
        <p>Sistema Zepeta</p>
    </div>

    <div>
        <?= $fecha ?>
    </div>
</div>

<table>
<tr>
<th>#</th>
<th>Folio</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Área</th>
<th>Fecha</th>
<th>Hora</th>
</tr>

<?php $i=1; foreach($datos as $c): ?>
<tr>
<td><?= $i++ ?></td>
<td><?= $c['folio'] ?></td>
<td><?= $c['nombre'] ?></td>
<td><?= $c['apellido'] ?></td>
<td><?= $c['area'] ?></td>
<td><?= $c['fecha'] ?></td>
<td><?= $c['hora'] ?></td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>