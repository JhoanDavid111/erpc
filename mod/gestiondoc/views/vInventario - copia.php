<script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css"/>

<script type="text/javascript" src="../src/js/jquery.tree.js"></script>
<link rel="stylesheet" type="text/css" href="../src/css/jquery.tree.css"/>

<script type="text/javascript">
    //<!--
    $(document).ready(function () {
        $("#accordion").accordion({
            'collapsible': true,
            'active': null,
            'heightStyle': 'content'
        });
        $('.jquery').each(function () {
            eval($(this).html());
        });
        $('.button').button();
    });
    //-->
</script>
  
 <style type="text/css">
        body {
            font-family: verdana, arial;
            font-size: 0.8em;
        }

        code {
            white-space: pre;
        }
    </style>


<h3 class="title-c">
	INVENTARIO DOCUMENTAL
</h3>
<br>
<br>
<br>

<h4>
<a href="<?=base_url?>views/pdf.php?idcali=2" target="_blank" title="Imprimir">
    <i class="fa fa-file-pdf-o" style="color: #523178;"></i>
</a>
</h4>

<div id="accordion">	

   <!--  <h3><a href="#">Inventario Documental</a></h3> -->
    <div id="example-3"> 
        <p></p>
        <code class="jquery" lang="text/javascript">
           <!--  $('#example-3 div').tree({
                onCheck: {
                    node: 'expand'
                },
                onUncheck: {
                    node: 'collapse'
                }
            }); -->
        </code>
        <div>
            <style>
                ul.inv {
                  list-style: none;
                  padding: 0;
                }
                li.inven {
                  padding-left: 1.3em;
                }
                li.inven:before {
                  content: "\f01c"; /* FontAwesome Unicode */
                  font-family: FontAwesome;
                  display: inline-block;
                  margin-left: -1.3em;
                  width: 1.3em;
                }
            </style>

            <?php if(isset($yearInv)): ?>
                <?php 
                    $radica= new Radica();                      
                 ?>
                <?php foreach($yearInv AS $y): ?>
                    <ul class="inv">
                        <li class="collapsed inven"><input type="checkbox"><span style="color: #6f42c1"><strong><?=$y['YEAR(fecha)'];?></strong></span>
                        <?php 
                            $areas = $radica->getAreasInv($y['YEAR(fecha)']);
                         ?>
                         <?php foreach($areas AS $a): ?>
                             <ul>
                                <li class="collapsed"><input type="checkbox"><span style="color: #F95708"><strong><?=$a['valnom'];?></strong></span>
                                <?php 
                                    $series = $radica->getSeriesInv($a['depid'],$y['YEAR(fecha)']);
                                 ?>
                                 <?php foreach($series AS $s): ?>
                                    <ul>
                                        <li class="collapsed"><input type="checkbox"><span><strong><?=$s['destrd'];?></strong></span>
                                    
                                        <?php 
                                             $expedientes = $radica->getExpInv($s['ultserie'],$y['YEAR(fecha)'],$a['depid']);
                                         ?>
                                         <?php foreach($expedientes AS $e): ?>
                                            <ul>
                                                <li class="collapsed"><input type="checkbox"><span><?=$e['nomserie'];?></span>
                                            </ul>
                                         <?php endforeach; ?>
                                    </ul>
                                 <?php endforeach; ?>
                                
                            </ul>
                         <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            <?php endif; ?>


            
        </div>
    </div>
</div>     




  




   

   