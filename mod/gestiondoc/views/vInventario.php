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

<form class="m-tb-40" action="<?=base_url;?>views/pdf.php" method="POST">
    <div class="row">
       
        <div class="form-group col-md-6">
            <label for="fecha">Seleccionar año del inventario a generar:</label>
            <input type="date"  class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="form-group col-md-6">
            <label for="fecha">area:</label>
            <select name="area" id="" class="form-control form-control-sm" style="height: 50px;">
                <?php foreach ($asigarea AS $are): ?>
                <option value="<?=$are['valid']?>"><?=$are['valnom'];?></option>                                              
                <?php endforeach ?>
            </select>
        </div>
        <input type="hidden" name="pefid" value="<?=$_SESSION['pefid'];?>">
        <input type="hidden" name="depid" value="<?=$_SESSION['depid'];?>">
        <div class="form-group col-md-12">
            <button id="btnsolicitar" class="btn-secondary-canalc">Generar</button>
        </div>
        
    </div>
    
</form>

<!-- <h4>
<a href="<?=base_url?>views/pdf.php?idcali=2&pefid=<?=$_SESSION['pefid'];?>&depid=<?=$_SESSION['depid'];?>" target="_blank" title="Imprimir">
    <i class="fa fa-file-pdf-o" style="color: #523178;"></i>
</a>
</h4> -->





  




   

   