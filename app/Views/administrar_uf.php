<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="js/control_mantenedor.js"></script>
<link rel="stylesheet" href="/css/administrar_uf_style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="card text-center">
    <div class="card-header">
        Mantenedor UF
    </div>
    <div class="card-body">
        <h5 class="card-title">Seleccione una opción</h5>
        <button class="btn btn-danger" onclick="resetearHistoricos()">Resetear Valores Historicos</button>
        <button id="addRow" data-toggle="modal" data-target="#modalIngresarRegistro" class="btn btn-success">Ingresar Registro</button>
        <?php if (count($registrosUf) > 0) : ?>
        <div style="width: 100%; height: 100%">
            <table id="tablaRegistros" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Unidad de medida</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="cuerpoTablaRegistros">
                    <?php foreach ($registrosUf as $registro) : ?>
                    <tr id="fila<?= $registro['id'] ?>">

                        <td><?= 'UF' ?></td>

                        <td><?= $datosUf['nombre'] ?></td>

                        <td><?= $datosUf['unidad_medida'] ?></td>

                        <td id="fecha<?= $registro['id'] ?>">
                            <?= substr($registro['fecha'], 0, 10) ?>
                        </td>

                        <td id="valor<?= $registro['id'] ?>">
                            <?= '$'.$registro['valor'] ?>
                        </td>

                        <td><button data-toggle="modal"
                                onclick="cargarDetalles('<?= $registro['id'] ?>', '<?= $registro['valor'] ?>', '<?= $registro['fecha'] ?>' )"
                                data-target="#modalModificarUf" class="btn btn-link">Modificar</button></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php else : ?>
        <h3>Ocurrio un error al cargar los registros historicos de UF o no existen registros historicos para UF</h3>
        <?php endif ?>
    </div>
</div>

<div id="loading-image" style="display: none;">
    <img src="/images/loading.gif" alt="Cargando">
</div>

<div class="modal fade" id="modalModificarUf" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModificarUf">Modificar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <form onsubmit="event.preventDefault()">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="valorRegistro">Valor del registro</label>

                                        <input id="valorRegistro" type="text" class="form-control" name="valorRegistro"
                                            value="" required>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fechaRegistro">Fecha de rergistro</label>

                                        <input id="fechaRegistro" type="text" class="form-control" name="fechaRegistro"
                                            value="" required>
                                    </div>
                                </div>

                                <input type="hidden" name="registroID" id="registroID" value="">

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 offset-md-1">
                                        <button onclick="actualizarRegistro()" class="btn btn-primary">
                                            Actualizar Registro
                                        </button>
                                        <button onclick="eliminarRegistro()" class="btn btn-danger">
                                            Eliminar Registro
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modalIngresarRegistro" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card text-center">
                <div class="card-header">
                    Ingresar un registro UF
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form onsubmit="event.preventDefault()">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="valornewRegistro">Valor del nuevo registro</label>

                                        <input id="valornewRegistro" type="text" class="form-control" name="valornewRegistro"
                                            value="" required>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fechanewRegistro">Fecha del nuevo rergistro</label>

                                        <input id="fechanewRegistro" type="text" class="form-control" name="fechanewRegistro"
                                            value="" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button onclick="ingresarRegistro()" class="btn btn-primary">
                                            Ingresar Registro
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<!-- La TAREA
Usando los datos de la API (mindicador.cl), generar un gráfico en donde pueda seleccionar tipo de indicador y despliegue datos con fecha desde hasta
Hacer un mantenedor de los datos históricos de UF, y permitir modificarlos a través de un CRUD (Requisito PHP Codeigniter, usando AJAX)
Mas cariño, mejor evaluación -->