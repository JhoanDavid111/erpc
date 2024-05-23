
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<h2 class="title-c m-tb-40">Nueva Actividad de Gestión</h2>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


	    <div class="container mt-5">
        <form>
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="area">Área</label>
                    <input type="text" class="form-control" id="area" name="area">
                </div>
                <div class="col-md-6 form-group">
                    <label for="num_documento">Número de documento</label>
                    <input type="text" class="form-control" id="num_documento" name="num_documento">
                </div>
            </div>
            <div class="form-group">
                <label for="nombre_contratista">Nombre futuro contratista</label>
                <input type="text" class="form-control" id="nombre_contratista" name="nombre_contratista">
            </div>
            <div class="form-group">
                <label for="objeto">Objeto</label>
                <textarea class="form-control" id="objeto" name="objeto" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Obligaciones</label>
                <div id="obligaciones-container">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="obligacion">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger eliminar-obligacion">Eliminar</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="agregar-obligacion">Agregar obligación</button>
            </div>

            <div class="form-group">
                <label>Estudios</label>
                <div id="estudios-container">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="estudio">
                        <div class="input-group-append">
                            <input type="file" class="form-control-file" name="soporte">
                            <button type="button" class="btn btn-danger eliminar-estudio">Eliminar</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="agregar-estudio">Agregar estudio</button>
            </div>

            <div class="form-group">
                <label for="experiencia">Experiencia</label>
                <textarea class="form-control" id="experiencia" name="experiencia" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="honorarios">Honorarios</label>
                <input type="text" class="form-control" id="honorarios" name="honorarios">
            </div>

            <button type="submit" class="btn btn-primary">Enviar formulario</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Agregar nueva obligación
            $("#agregar-obligacion").click(function() {
                $("#obligaciones-container").append('<div class="input-group mb-2"><input type="text" class="form-control" name="obligacion"><div class="input-group-append"><button type="button" class="btn btn-danger eliminar-obligacion">Eliminar</button></div></div>');
            });

            // Eliminar obligación
            $(document).on("click", ".eliminar-obligacion", function() {
                $(this).closest(".input-group").remove();
            });

            // Agregar nuevo estudio con soporte
            $("#agregar-estudio").click(function() {
                $("#estudios-container").append('<div class="input-group mb-2"><input type="text" class="form-control" name="estudio"><div class="input-group-append"><input type="file" class="form-control-file" name="soporte"><button type="button" class="btn btn-danger eliminar-estudio">Eliminar</button></div></div>');
            });

            // Eliminar estudio
            $(document).on("click", ".eliminar-estudio", function() {
                $(this).closest(".input-group").remove();
            });
        });
    </script>


