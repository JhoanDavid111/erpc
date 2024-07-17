<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Áreas</title>
    <style type="text/css">
    .highcharts-figure, .highcharts-data-table table {
        min-width: 360px;
        max-width: 1000px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
    </style>
</head>
<body>
<h2 class="title-c">Reporte de Áreas</h2>
<br><br>

<?php $url_action = base_url."reparepmj/index"; ?>
<form id="formdes" name="frmdes" method="POST" action="<?=$url_action;?>">
    <div style="display: inline-block;">
        <?php if($anos) { ?>
            <select name="ano" class="form-control" onchange="this.form.submit();">
                <?php foreach ($anos as $dtano) { ?>
                    <option <?php if($dtano["ano"] == $ano) echo "SELECTED"; ?>><?=$dtano["ano"];?></option>
                <?php } ?>
            </select>
        <?php } ?>
    </div>
</form>

<script src="../code/highcharts.js"></script>
<script src="../code/modules/series-label.js"></script>
<script src="../code/modules/exporting.js"></script>
<script src="../code/modules/export-data.js"></script>
<script src="../code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description"></p>
</figure>

<script type="text/javascript">
    Highcharts.chart('container', {

        title: {
            text: 'Planes'
        },

        subtitle: {
            text: 'Área / Mes'
        },

        yAxis: {
            title: {
                text: 'Valores'
            }
        },

        xAxis: {
            categories: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },

        series: [{
            <?php
            $con=1; 
            foreach ($areas as $f) {
            ?>
            name: '<?=strtoupper($f['valnom']);?>',
            data: [
                <?php
                $t = 0;
                for ($i=1; $i<=12; $i++) {
                    $datnoco = $contrato->setotarea($ano, $i, $f['valid']); 
                    if($datnoco) {
                        $can = 0;
                        foreach ($datnoco as $dtc) {
                            if($dtc['mes'] == $i) {
                                if($dtc['cant']) $can = $dtc['cant'];
                            }
                        }
                        echo $can;
                    } else {
                        echo 0;
                    }
                    if($i < 12) echo ",";
                }
                ?> 
            ]}, <?php
            if($con == count($areas)) echo "}"; 
            $con++;
            } ?>
        ]
    });
</script>

</body>
</html>

