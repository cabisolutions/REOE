<!DOCTYPE html>
<html lang="es-MX">
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
                Titulo espacio
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        
                                <div>
                                Ubicación:
                                </div>
                            <br>
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
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div>
                                        Check-in:
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div>
                                        Check-out:
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div>
                                        Dia/Mes:
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <div>
                                        Dia/Mes:
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
                            <div class="row">  
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Reservar</button>
                    </div>
                </form>    
            </div>   
        </div>
    </div>
</body>
</html>