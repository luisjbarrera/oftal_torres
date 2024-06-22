<div class="row justify-content-center"> <!-- Centrado horizontal -->
                            <div class="col-md-12"> <!-- Ajusta el ancho según prefieras -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="">
                                            <div class="form-group row">
                                                <div class="col-md-5">
                                                    <label for="nombrePaciente">Nombre del Paciente:</label>
                                                    <input type="text" id="nombrePaciente" name="txtnombrepaciente" class="form-control">
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="col-md-3 col-sm-3 " for="edad">Edad:</label>
                                                    <input type="text" id="edad" name="txtedad" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="motivoConsulta">Motivo de la Consulta:</label>
                                                    <textarea id="motivoConsulta" name="motivoConsulta" required="required" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Registre el motivo de la consulta" data-parsley-validation-threshold="10"></textarea>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="antecedentes">Antecedentes:</label>
                                                    <textarea id="antecedentes" name="txtAntecedentes" required="required" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Registre los antecedentes del paciente" data-parsley-validation-threshold="10"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="examenClinico">Examen Clínico:</label>
                                                    <select id="examenClinico" class="form-control" required>
                                                        <option value="">Seleccione un tipo de examen....</option>
                                                        <option value="press">Extracción</option>
                                                        <option value="net">Implante</option>
                                                        <option value="mouth">Curación</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <link rel="stylesheet" href="css/styles.css">
                                        </form>
                                    </div>

                                    <!-- Sección de herramientas e imagen -->
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group row">

                                                    <!-- Herramientas -->
                                                    <div class="mb-2">
                                                        <i id="pincel" class="icono fas fa-paint-brush" title="Pincel"></i>
                                                        <i id="colorAzul" class="icono fas fa-circle" style="color: blue;" title="Color Azul"></i>
                                                        <i id="colorRojo" class="icono fas fa-circle" style="color: red;" title="Color Rojo"></i>
                                                        <i id="colorAmarillo" class="icono fas fa-circle" style="color: yellow;" title="Color Amarillo"></i>
                                                        
                                                        <i id="borrador" class="icono fas fa-eraser" title="Borrador"></i>
                                                        <i id="tamanoPequeno" class="icono fas fa-circle" style="font-size: 10px;" title="Borrador Pequeño"></i>
                                                        <i id="tamanoMediano" class="icono fas fa-circle" style="font-size: 15px;" title="Borrador Mediano"></i>
                                                        <i id="tamanoGrande" class="icono fas fa-circle" style="font-size: 20px;" title="Borrador Grande"></i>

                                                        <i id="guardar" class="icono fas fa-save" title="Guardar"></i>
                                                    </div>


                                                <div class="form-group row">
                                                    <div id="canvasContainer" class="mb-12">
                                                        <canvas id="backgroundCanvas" width="600" height="400"></canvas>
                                                        <canvas id="drawingCanvas" width="600" height="400"></canvas>
                                                    </div>
                                                </div>
                                                <script src="js/script.js"></script>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Especificaciones y Tratamiento -->
                                    <div class="row justify-content-center mt-4">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="motivoConsulta">Especificaciones:</label>
                                                            <textarea id="Especificaciones" name="Especificaciones" required="required" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Registre las Especificaciones" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-5">
                                                            <label for="nombrePaciente">Diagnostico: </label>
                                                            <textarea id="Diagnostico" name="Diagnostico" required="required" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Registre las Diagnostico" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <label class="col-md-3 col-sm-3 " for="edad">CIE-10:</label>
                                                            <input type="text" id="cie10" name="cie10" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="antecedentes">Examenes auxiliares:</label>
                                                            <textarea id="exauxiliares" name="exauxiliares" required="required" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Registre los examenes auxiliares" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="antecedentes">Referencias:</label>
                                                            <textarea id="Referencias" name="Referencias" required="required" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Registre las referencias" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="antecedentes">Tratamiento realizado:</label>
                                                            <textarea id="Tratamientorealizado" name="Tratamientorealizado" required="required" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Registre el tratamiento realizado" data-parsley-validation-threshold="10"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>