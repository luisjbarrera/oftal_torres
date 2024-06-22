<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Visor de imagenes | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Ion.RangeSlider -->
    <link href="../vendors/normalize-css/normalize.css" rel="stylesheet">
    <link href="../vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="../vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <!-- Bootstrap Colorpicker -->
    <link href="../vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="../vendors/cropper/dist/cropper.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <?php
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
          $i = $_GET["TZS2C"];
          $f = $_GET["TtS2c"];
          /* // Descifra el valor de i
          $key = "h.ksjkjsadgfugfcpoqsvlazsfhniuhndjf@bhbscd#m";
          $iv = base64_decode(substr($i, 0, openssl_cipher_iv_length('AES-256-CBC')));
          $encrypted = base64_decode(substr($i, openssl_cipher_iv_length('AES-256-CBC')));
          echo $decryptedI = openssl_decrypt($encrypted, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv); */
          // Procesa el valor de i
      }else{ header("location: ../login.php"); }
  ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <!-- page content -->
        <div class="col-md-12" role="main">
          <div class="">
                                  <!--div class="page-title"> -->
                                  <!-- <div class="title_left"> -->
                                  <!--   <h4><small><?php //echo $i; ?></small></h4> -->
                                  <!-- </div> -->
                                  <!--/div> -->
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">

                

        
              

                <!-- image cropping -->
                <div class="container cropper">
                  <div class="row">
                    <div class="col-md-9">
                      <div class="img-container">
                        <img id="image" src="<?php echo $f.$i; ?>" alt="Picture">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="docs-preview clearfix">
                        <div class="img-preview preview-lg"></div>
                        <div class="img-preview preview-md"></div>
                        <div class="img-preview preview-sm"></div>
                        <div class="img-preview preview-xs"></div>
                      </div>

                      <div class="docs-data">
                        <div class="input-group input-group-sm">
                          <label class="input-group-addon" for="dataX">X</label>
                          <input type="text" class="form-control" id="dataX" placeholder="x">
                          <span class="input-group-addon">px</span>
                        </div>
                        <div class="input-group input-group-sm">
                          <label class="input-group-addon" for="dataY">Y</label>
                          <input type="text" class="form-control" id="dataY" placeholder="y">
                          <span class="input-group-addon">px</span>
                        </div>
                        <div class="input-group input-group-sm">
                          <label class="input-group-addon" for="dataWidth">Ancho</label>
                          <input type="text" class="form-control" id="dataWidth" placeholder="width">
                          <span class="input-group-addon">px</span>
                        </div>
                        <div class="input-group input-group-sm">
                          <label class="input-group-addon" for="dataHeight">Alto</label>
                          <input type="text" class="form-control" id="dataHeight" placeholder="height">
                          <span class="input-group-addon">px</span>
                        </div>
                        <div class="input-group input-group-sm">
                          <label class="input-group-addon" for="dataRotate">Rotaci&oacute;n</label>
                          <input type="text" class="form-control" id="dataRotate" placeholder="Angulo de rotaci&oacute;n">
                          <span class="input-group-addon">º</span>
                        </div>
                        <div>
                          <h4><small><?php echo 'Centro Oftal. Torres: '.$i; ?></small></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-9 docs-buttons">
                      <!-- <h3 class="page-header">Toolbar:</h3> -->
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Mover">
                            <span class="fa fa-arrows"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Recortar">
                            <span class="fa fa-crop"></span>
                          </span>
                        </button>
                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Aumentar zoom 0.1">
                            <span class="fa fa-search-plus"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Disminuir zoom -0.1">
                            <span class="fa fa-search-minus"></span>
                          </span>
                        </button>
                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                          <span class="docs-tooltip" data-toggle="tooltip" title="&quot;Mover&quot; a la izquierda">
                            <span class="fa fa-arrow-left"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                          <span class="docs-tooltip" data-toggle="tooltip" title="&quot;Mover&quot; a la derecha">
                            <span class="fa fa-arrow-right"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                          <span class="docs-tooltip" data-toggle="tooltip" title="&quot;Mover&quot; para arriba">
                            <span class="fa fa-arrow-up"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                          <span class="docs-tooltip" data-toggle="tooltip" title="&quot;Mover&quot; para abajo">
                            <span class="fa fa-arrow-down"></span>
                          </span>
                        </button>
                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Girar a la izquierda">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Girar a la izquierda en -45º">
                            <span class="fa fa-rotate-left"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Girar a la derecha">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Girar a la derecha en 45º">
                            <span class="fa fa-rotate-right"></span>
                          </span>
                        </button>
                      </div>

                      

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Aceptar">
                            <span class="fa fa-check"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Limpiar">
                            <span class="fa fa-remove"></span>
                          </span>
                        </button>
                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Bloquear aspecto">
                            <span class="fa fa-lock"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Desbloquear aspecto">
                            <span class="fa fa-unlock"></span>
                          </span>
                        </button>
                      </div>

                      <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Restablecer imagen">
                            <span class="fa fa-refresh"></span>
                          </span>
                        </button>
                        <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                          <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Importar imagen">
                            <span class="fa fa-upload"></span>
                          </span>
                        </label>
                        <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Destruir imagen">
                            <span class="fa fa-power-off"></span>
                          </span>
                        </button>
                      </div>
                      <div class="btn-group btn-group-crop">
                        <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Descargar imagen seccionada">
                            <span class="fa fa-download"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Descargar imagen de 160x90">
                            
                            <span class="fa fa-arrow-circle-o-down"></span>
                          </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }">
                          <span class="docs-tooltip" data-toggle="tooltip" title="Descargar imagen de 320x180">
                            
                            <span class="fa fa-arrow-circle-down"></span>
                          </span>
                        </button>
                      </div>

                      <!-- Show the cropped image in modal -->
                      <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="getCroppedCanvasTitle">Recortada</h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.png">Descargar</a>
                            </div>
                          </div>
                        </div>
                      </div><!-- /.modal -->
                      
                      <button type="button" class="btn btn-primary" data-method="moveTo" data-option="0">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Mover a la posición 0">
                          0,0
                        </span>
                      </button>
                      <button type="button" class="btn btn-primary" data-method="zoomTo" data-option="1">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Hacer Zoom">
                          100%
                        </span>
                      </button>
                      
                      
                    </div><!-- /.docs-buttons -->

                    <div class="col-md-3 docs-toggles">
                      <!-- <h3 class="page-header">Toggles:</h3> -->
                      <div class="dropup docs-options">
                        <button type="button" class="btn btn-primary btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true">
                        Opciones
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="responsive" checked>
                              Sensible
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="restore" checked>
                              restaurar
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="checkCrossOrigin" checked>
                              comprobar origen cruzado
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="checkOrientation" checked>
                              comprobar orientación
                            </label>
                          </li>

                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="modal" checked>
                              modal
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="guides" checked>
                              guías
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="center" checked>
                              center
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="highlight" checked>
                              destacar
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="background" checked>
                              fondo
                            </label>
                          </li>

                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="autoCrop" checked>
                              recorte automático
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="movable" checked>
                              movable
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="rotatable" checked>
                              rotatable
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="scalable" checked>
                              scalable
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="zoomable" checked>
                              zoomable
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="zoomOnTouch" checked>
                              zoomOnTouch
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="zoomOnWheel" checked>
                              zoomOnWheel
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="cropBoxMovable" checked>
                              cropBoxMovable
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="cropBoxResizable" checked>
                              cropBoxResizable
                            </label>
                          </li>
                          <li role="presentation">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="toggleDragModeOnDblclick" checked>
                              toggleDragModeOnDblclick
                            </label>
                          </li>
                        </ul>
                      </div><!-- /.dropdown -->

                    </div><!-- /.docs-toggles -->
                  </div>
                </div>
                <!-- /image cropping -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Ion.RangeSlider -->
    <script src="../vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <!-- Bootstrap Colorpicker -->
    <script src="../vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- jquery.inputmask -->
    <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- jQuery Knob -->
    <script src="../vendors/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- Cropper -->
    <script src="../vendors/cropper/dist/cropper.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
    <!-- Initialize datetimepicker -->
<script  type="text/javascript">
   $(function () {
                $('#myDatepicker').datetimepicker();
            });
    
    $('#myDatepicker2').datetimepicker({
        format: 'DD.MM.YYYY'
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
    });
    
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    $('#datetimepicker6').datetimepicker();
    
    $('#datetimepicker7').datetimepicker({
        useCurrent: false
    });
    
    $("#datetimepicker6").on("dp.change", function(e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    
    $("#datetimepicker7").on("dp.change", function(e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
</script>
  </body>
</html>