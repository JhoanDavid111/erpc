<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/style-dash.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<!---LINKS MODAL--->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <title>Registro de E/S</title>
</head>
<body>

<div class="barsupnew">
    <img src="../../intranet/img/logobarcc.png" width="100%">
</div>
<?php if(!$nodocemp){ ?>
    <form class="m-tb-40" action="<?=$direc;?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-12 frob" id="go1" style="text-align: center;margin-top: 180px;">
                <span class="tnom TtCcES">
                    <i class="fa-solid fa-right-left"></i>
                    FUNCIONARIOS DE PLANTA
                </span>
            </div>
            <div class="form-group col-md-3 frob" id="go1" style="text-align: center;">
            </div>
            <div class="form-group col-md-6 frob" id="go1" style="text-align: center;">
                <br><br>
                <label for="nodocemp" style="font-size: 15px;color: #000;">Número de documento</label>
                <input type="text" class="form-control form-control-sm" id="nodocemp" maxlength="100" name="nodocemp" style="font-size: 15px;border-color: #0e0852;" required onchange="this.form.submit();" autofocus />
                <input type="hidden" name="ope" value="save">
            </div>
            <div class="form-group col-md-3 frob" id="go1" style="text-align: center;">
            </div>
        </div>
    </form>
<?php }elseif($nodocemp){ ?>
    <div class="row" style="display: flex;align-items: center;">
        <div class="form-group col-md-12 frob ajuies" style="margin-top: 0px;" id="go1" >
            <form class="m-tb-40" name="myForm" action="<?=$direc;?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-12" id="go1" style="text-align: center;margin-top: 180px;">
                        <big><span class="tnom TtCcES">
                        <?php
                        if(!$dtUds){ 
                            if(!$rdtT) echo "INGRESO";
                            else echo "SALIDA";
                        }
                        ?>
                        </span></big>
<!-- Recarga de página 1000 es 1 segundo, 3000 es 3 seg INICIO -->
                        <script type="text/javascript">
                            setInterval(recargar,3000);
                            function recargar() {
                                window.location.href = 'index';
                            }
                        </script>
<!-- Recarga de página 1000 es 1 segundo, 3000 es 3 seg FIN -->
                        <?php if($msjerr){ ?>
                            <br>
                            <div class="boxven parpadea"><?=$msjerr;?></div>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-12" id="go1" style="text-align: center;">
                        <span class="tnom txtES">
                            <!-- <input type="hidden" name="fotusu" id="perid" value="<?=$image_url;?>" > -->
                            
                            <?php if(!$dtUds){ ?>
                                <input type="hidden" name="perid" value="<?=$val[0]['perid'];?>" >
                                <?=$val[0]['nomusu'];?>
                            <?php }else{ ?>
                                <div class="boxven parpadea">
                                    <span style="font-weight: bold;color: #ff0000;font-size: 50px;">USUARIO SIN VALIDACIÓN</span>
                                </div>
                            <?php } ?>
                            <br>
                            C.C. <?php if($nodocemp) echo number_format($nodocemp, 0, ',', '.');?>
                        </span>
                    </div>
                
                    <div class="form-group col-md-12" id="go1" style="text-align: center;color: #4eac31;">
                        <label for="fechos" style="font-size: 15px;color: #4eac31;">Fecha y Hora</label>
                        <br>
                        <big><big>
                            <?=$fechos;?>
                        </big></big>
                        <input type="hidden" name="ope" value="edi">
                    </div>
                </div>
                <div class="row">
                    <?php if($datEle){ foreach($datEle AS $dEl){ ?>
                        <div class="form-group col-md-3" id="go1" style="margin: 0 auto;color: #000; left: 10px;">
                            <?php if(file_exists($dEl['rutfot'])){ ?>
                                <img src="<?=$dEl['rutfot'];?>" class="fotele">
                            <?php } else{ ?>
                                <img src="img/user.jpg" class="fotele">
                            <?php } ?>
                            <input type="checkbox" name="ideles[]" <?php if($dEl['preele']==1) echo "checked"; ?> style="width: 25px;height: 25px;margin-top: -25px;display: block;position: absolute;z-index: 1;" value="<?=$dEl['idele'];?>">
                            <br>
                            <strong><?=$dEl['nomele'];?></strong> 
                            <small><?=$dEl['nidele'];?></small>
                        </div>
                    <?php }} ?>

                                
                </div>
            </form>
        </div>
    </div>
<?php } ?>


<div class="barinfnew">
    <a href="https://files.conexioncapital.co/assets/public/media/file/file/TERMINOS-Y-CONDICIONES-DE-USO.pdf?VersionId=b96fSrwEuv5Ct7KgC27mW2klox9voeJB" target="_blank">Política de tratamiento de datos personales -  Términos y Condiciones -  Términos y condiciones de uso propiedad intelectual</a><br>
    Copyright © Canal Capital
</div>
</body>
</html>