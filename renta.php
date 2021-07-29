
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/estilosGlobales.css">
</head>

<body>
<?php
require_once './menu.php';
?>
<br>
<br>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
<h4> Titulo espacio</h4>
            </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                        Ubicación:
                        </div>
                            <div class="mb-3"> 

                                <div>
                                    Metros cuadrados:
                                </div>
                            </div>

                                <div class="mb-3">
                                    <div>
                                    Descripción:
                                    </div>        
                                </div>
                            <div class="mb-3">                              

                                <div>
                                    Servicios:
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-sm-6"> </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <div>
                            <label for="check_in" class="form-label">Check-in</label>
                            <input type="date" name="check_in" required class="form-control form-control-sm" id="check_in" 
                            value="<?php echo htmlentities($_POST['check_in'] ?? '') ?>">
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <div>
                            <label for="check_out" class="form-label">Check-out</label>
                            <input type="date" name="check_out" required class="form-control form-control-sm" id="check_out" 
                            value="<?php echo htmlentities($_POST['check_out'] ?? '') ?>">
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="mb-3">
                                    <img src="img/espacio1.jpg" class="col-md-12 rounded float-md-end mb-3 ms-md-3" alt="Imagen espacio 1">
                                </div>
                                <div class="mb-3">
                                    <div>
                                        Totales
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <div>
                                            Precio x total de dias:
                                        </div>
                                    </div>
                                </div>
                            </div>                
<button type="submit" class="btn btn btn-primary">Reservar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>