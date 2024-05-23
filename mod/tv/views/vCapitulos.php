
<h2 class="title-c m-tb-40">Cápitulos</h2>
<br><br>
<br><br>
<span>Encuentre aquí la lista de capítulos de las<span>
<span class="badge badge-danger" style="font-size: 30px;">Series</span>
<span>&nbsp;&nbsp;&nbsp;y Capítulos&nbsp;&nbsp;&nbsp;</span>
<span class="badge badge-success" style="font-size: 30px;">Unitarios</span>

<br><br>


<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dterpceTVcapi"  style="width:100%;">
        <thead>
            <tr>
                <th>Código Unico</th>
                <th>Nombre</th>
                <th>Temporada</th>
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos as $document): ?>  
                 <?php foreach($document as $key => $value): ?> 
                    <?php if($key !== '_id'): ?>
                        <?php //echo $key; ?>
                        <?php //echo $value['serieid']; ?>
                        <tr>

                            <td>
                                <?php 
                                    $codigo = substr($value['codigounico'], 0,5);
                                    $nt = substr($value['codigounico'], 5,2); 
                                    $nt2 = substr($value['codigounico'], 8,3);
                                ?>
                                <a href="<?=base_url?>tv/capitulosDet&idserie=<?=$value['codigounico'];?>" title="Editar">
                                
                                    <label for="" style="background: black;">
                                        <?php if($value['temporada']>0){ ?>
                                            <span class="badge badge-danger" ><?=$codigo;?></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-success" ><?=$codigo;?></span>
                                        <?php } ?>
                                        <span class="badge badge-dark" ><?=$nt;?></span>
                                        <span class="badge badge-danger" >T</span>
                                        <span class="badge badge-dark" ><?=$nt2;?></span>
                                    </label>    

                                    <?php if($value['cc']==true) { ?>
                                        <span class="badge badge-light">C</span>
                                        <?php }else{ ?>
                                        <span class="badge badge-light" >X</span>
                                    <?php } ?>   

                                    <?php if($value['st']==true) { ?>
                                        <span class="badge badge-light">S</span>
                                        <?php }else{ ?>
                                        <span class="badge badge-light" >X</span>
                                    <?php } ?>

                                    <?php if($value['lsc']==true) { ?>
                                        <span class="badge badge-light">L</span>
                                        <?php }else{ ?>
                                        <span class="badge badge-light" >X</span>
                                    <?php } ?> 
                                </a>
 
                            </td>

                            <td style="max-width: 400px !important;">
                                <?=$value['nombre'];?>
                            </td>

                            <td style="text-align: center;">
                                 <?=$value['temporada'];?>
                            </td>

                            <td style="text-align: center;">
                                <?php 
                                    $segundoss = $value['duracion'];
                                    $horas = floor($segundoss/3600);
                                    $minutos = floor(($segundoss - ($horas*3600))/60);
                                    $seg = floor($segundoss - (($horas * 3600)+ ($minutos*60)));
                                    if($horas<10){
                                        $horas = "0".$horas;
                                    }
                                    if($minutos<10){
                                        $minutos = "0".$minutos;
                                    }
                                    if($seg<10){
                                        $seg = "0".$seg;
                                    }
                                    echo $horas.":".$minutos.":".$seg;
                                ?>

                            </td>
                            
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>

            <?php endforeach; ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Código Unico</th>
                <th>Nombre</th>
                <th>Temporada</th>
                <th>Duración</th>
            </tr>
        </tfoot>
    </table>
    
</div>