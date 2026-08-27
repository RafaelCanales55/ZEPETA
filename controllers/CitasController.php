<?php
require_once __DIR__ . "/../models/CitasModel.php";

class CitasController {

    public function index(){

        $modelo = new CitasModel();

        // =========================
        // GUARDAR / ACTUALIZAR
        // =========================
        if(isset($_POST['guardar'])){

            $fecha = $_POST['fecha'] ?? '';
            $hora  = $_POST['hora'] ?? '';

            $error = false;

            
            foreach($modelo->obtener() as $c){
                if(
                    ($c['fecha'] ?? '') == $fecha &&
                    ($c['hora'] ?? '') == $hora &&
                    ($c['folio'] ?? '') != ($_POST['folio'] ?? '')
                ){
                    $error = true;
                    break;
                }
            }

            
            if($error){

                echo "<script>
                document.addEventListener('DOMContentLoaded', function(){
                    Swal.fire({
                        icon: 'error',
                        title: 'Horario no disponible',
                        text: 'Ya existe una cita en esa fecha y hora',
                        confirmButtonColor: '#d33'
                    });
                });
                </script>";

                $editar = $_POST;
                $datos = $modelo->obtener();

                require __DIR__ . "/../views/citas/citas.php";
                return;
            }

            // =========================
            // GENERAR FOLIO
            // =========================
            if(!empty($_POST['folio'])){
                $folio = $_POST['folio'];
            } else {

                $prefijo = "CT" . date("Ymd");
                $contador = 1;

                foreach($modelo->obtener() as $c){
                    if(strpos($c['folio'] ?? '', $prefijo) === 0){
                        $contador++;
                    }
                }

                $folio = $prefijo . "-" . str_pad($contador, 3, "0", STR_PAD_LEFT);
            }

            $cita = [
                "folio" => $folio,
                "nombre" => $_POST['nombre'] ?? '',
                "apellido" => $_POST['apellido'] ?? '',
                "area" => $_POST['area'] ?? '',
                "fecha" => $fecha,
                "hora" => $hora
            ];

            if(!empty($_POST['folio'])){
                $modelo->actualizar($folio, $cita);
            } else {
                $modelo->guardar($cita);
            }

            header("Location: index.php?modulo=citas");
            exit;
        }

        // =========================
        // ELIMINAR
        // =========================
        if(isset($_GET['eliminar'])){
            $modelo->eliminar($_GET['eliminar']);
            header("Location: index.php?modulo=citas");
            exit;
        }

        // =========================
        // EDITAR
        // =========================
        $editar = null;

        if(isset($_GET['editar'])){
            foreach($modelo->obtener() as $c){
                if(($c['folio'] ?? '') == $_GET['editar']){
                    $editar = $c;
                    break;
                }
            }
        }

        $datos = $modelo->obtener();

        require_once __DIR__ . "/../views/citas/citas.php";
    }

    // =========================
    // BUSCAR
    // =========================
    public function buscar(){

        $modelo = new CitasModel();
        $datos = $modelo->buscar($_POST['buscar'] ?? '');
        $editar = null;

        require_once __DIR__ . "/../views/citas/citas.php";
    }
}