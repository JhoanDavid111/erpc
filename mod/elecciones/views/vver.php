<h2 class="title-c">Visualizar en pantalla &nbsp;&nbsp;&nbsp;&nbsp;</h2>

<?php echo "<h4><br>Mostrando: ".$btn.". ".$nmnc." No. Registros: ".$ctd."</h4>"; ?>
<div class="row" style="margin-top: 10px;">
	<div class="form-group col-md-3" style="text-align: center;">
		<a href="<?=base_url;?>views/gra.php" target="_blank">
			<input type="button" class="btn-secondary-ccapital btnvisu" style="background-color: #00f;" value="Pantalla Full Hor.">
		</a>
	</div>
	<div class="form-group col-md-3" style="text-align: center;">
		<a href="<?=base_url;?>views/gravertical.php" target="_blank">
			<input type="button" class="btn-secondary-ccapital btnvisu" style="background-color: #00f;" value="Pantalla Full Ver.">
		</a>
	</div>
	<div class="form-group col-md-3" style="text-align: center;">
		<a href="<?=base_url;?>views/grachroma.php" target="_blank">
			<input type="button" class="btn-secondary-ccapital btnvisu" style="background-color: #0f0;" value="Banner Chroma">
		</a>
	</div>
	<div class="form-group col-md-3" style="text-align: center;">
		<a href="<?=base_url;?>views/grachromasupxyz.php" target="_blank">
			<input type="button" class="btn-secondary-ccapital btnvisu" style="background-color: #0f0;" value="Banner Web">
		</a>
	</div>

	<div class="form-group col-md-12">
		<h2>Actualizar datos</h2>
	</div>

	<?php if($dm){ foreach ($dm as $dtdm) { ?>		
		<?php 
			if(!$dtdm['elecdep'] && $dtdm['elecmun']){
				$dtdm['elecdep'] = $dtdm['elecmun'];
				$dtdm['elecmun'] = 0;
				$btn = "GO";
				$tbl = "elergo";
				$crp = 1;
				$styl = 'style="background: #FFA500;width: 44px;border-radius: 4px;padding: 5px 7px;height: 40px;"';
			}else{
				$btn = "AL";
				$tbl = "eleral";
				$crp = 3;
				$styl = 'style="background: #800080;color: #FFFFFF;width: 44px;border-radius: 4px;padding: 5px 7px;height: 40px;"';
			}
			$dpt = $dtdm['elecdep'];
			$mnc = $dtdm['elecmun'];
			$gBm = $mbas->getBolMax($tbl,$dpt,$mnc);
			if($gBm AND $gBm[0]["nb"]) $nb=$gBm[0]["nb"]; else $nb=0;
			$dcc = $mbas->getResCc($tbl,$dpt,$mnc,$crp,$nb);
		?>
		
		<div class="form-group col-md-4" style="text-align: left;padding: 2px !important;margin: 0px !important;">
			<?=$btn.". ".$dtdm['elenmun']." Boletín No. ".$nb;?>
		</div>
		<div class="form-group col-md-2" style="text-align: left;padding: 2px !important;margin: 0px !important;">
			<?php $cfg = NULL;
				if($dtdm['pch']==1){ 
				//$cfg = $mbas->getCfgC(1,$dpt,$mnc,$crp);
				//$cfg = $mbas->getCfg(1);
				$tcfg = 1;
			?>
			<form action="<?=base_url;?>xml/full" method="POST">
				<div class="row">
					<div class="form-group col-md-6" style="text-align: center;padding: 2px !important;margin: 0px !important;">
						<input type="hidden" name="btn" value="<?=$btn;?>">
						<input type="hidden" name="dpt" value="<?=$dpt;?>">
						<input type="hidden" name="mnc" value="<?=$mnc;?>">
						<input type="hidden" name="crp" value="<?=$crp;?>">
						<input type="hidden" name="nmnc" value="<?=$dtdm['elenmun'];?>">
						<input type="hidden" name="nb" value="<?=$nb;?>">
						<input type="hidden" name="cfg" value="<?=$tcfg;?>">
						<input type="number" name="ctd" min="1" max="<?php if($dcc && $dcc[0]['can']) echo $dcc[0]['can']; else echo "20";?>" value="<?php if($cfg && $cfg[0]['ctd']) echo $cfg[0]['ctd']; elseif($dcc && $dcc[0]['can']) echo $dcc[0]['can']; else echo "20";?>" style="width: 100%;padding: 5px 7px;height: 40px;">
					</div>
					<div class="form-group col-md-6" style="text-align: left;padding: 2px !important;margin: 0px !important;">
						<button type="submit" class="btn-secondary-ccapital" title="Pantalla Completa Horizontal" <?=$styl;?>><i class="fa fa-desktop" aria-hidden="true"></i></button>
					</div>
				</div>
			</form>
			<?php } ?>
		</div>
		<div class="form-group col-md-2" style="text-align: left;padding: 2px !important;margin: 0px !important;">
			<?php if($dtdm['pcv']==1){
			//$cfg = $mbas->getCfgC(2,$dpt,$mnc,$crp);
			$tcfg = 2;
			$cfg = $mbas->getCfg(2); ?>
			<form action="<?=base_url;?>xml/full" method="POST">
				<div class="row">
					<div class="form-group col-md-6" style="text-align: center;padding: 2px !important;margin: 0px !important;">
						<input type="hidden" name="btn" value="<?=$btn;?>">
						<input type="hidden" name="dpt" value="<?=$dpt;?>">
						<input type="hidden" name="mnc" value="<?=$mnc;?>">
						<input type="hidden" name="crp" value="<?=$crp;?>">
						<input type="hidden" name="nmnc" value="<?=$dtdm['elenmun'];?>">
						<input type="hidden" name="nb" value="<?=$nb;?>">
						<input type="hidden" name="cfg" value="<?=$tcfg;?>">
						<input type="number" name="ctd" min="1" max="<?php if($dcc && $dcc[0]['can']) echo $dcc[0]['can']; else echo "20";?>" value="<?php if($cfg && $cfg[0]['ctd']) echo $cfg[0]['ctd']; elseif($dcc && $dcc[0]['can']) echo $dcc[0]['can']; else echo "20";?>" style="width: 100%;padding: 5px 7px;height: 40px;">
					</div>
					<div class="form-group col-md-6" style="text-align: left;padding: 2px !important;margin: 0px !important;">
						<button type="submit" class="btn-secondary-ccapital" title="Pantalla Completa Vertical" <?=$styl;?>><i class="fa fa-list-alt" aria-hidden="true"></i></button>
					</div>
				</div>
			</form>
			<?php } ?>
		</div>
		<div class="form-group col-md-2" style="text-align: left;padding: 2px !important;margin: 0px !important;">
			<?php if($dtdm['bch']==1){
			//$cfg = $mbas->getCfgC(3,$dpt,$mnc,$crp);
			$tcfg = 3;
			$cfg = $mbas->getCfg(3); ?>
			<form action="<?=base_url;?>xml/full" method="POST">
				<div class="row">
					<div class="form-group col-md-6" style="text-align: center;padding: 2px !important;margin: 0px !important;">
						<input type="hidden" name="btn" value="<?=$btn;?>">
						<input type="hidden" name="dpt" value="<?=$dpt;?>">
						<input type="hidden" name="mnc" value="<?=$mnc;?>">
						<input type="hidden" name="crp" value="<?=$crp;?>">
						<input type="hidden" name="nmnc" value="<?=$dtdm['elenmun'];?>">
						<input type="hidden" name="nb" value="<?=$nb;?>">
						<input type="hidden" name="cfg" value="<?=$tcfg;?>">
						<input type="number" name="ctd" min="1" max="<?php if($dcc && $dcc[0]['can']) echo $dcc[0]['can']; else echo "20";?>" value="<?php if($cfg && $cfg[0]['ctd']) echo $cfg[0]['ctd']; elseif($dcc && $dcc[0]['can']) echo $dcc[0]['can']; else echo "20";?>" style="width: 100%;padding: 5px 7px;height: 40px;">
					</div>
					<div class="form-group col-md-6" style="text-align: left;padding: 2px !important;margin: 0px !important;">
						<button type="submit" class="btn-secondary-ccapital" title="Banner Chroma" <?=$styl;?>><i class="fa fa-window-minimize" aria-hidden="true"></i></button>
					</div>
				</div>
			</form>
			<?php } ?>
		</div>
		<div class="form-group col-md-2" style="text-align: left;padding: 2px !important;margin: 0px !important;">
			<?php if($dtdm['bwb']==1){
			//$cfg = $mbas->getCfgC(4,$dpt,$mnc,$crp);
			$tcfg = 4;
			$cfg = $mbas->getCfg(4); ?>
			<form action="<?=base_url;?>xml/full" method="POST">
				<div class="row">
					<div class="form-group col-md-6" style="text-align: center;padding: 2px !important;margin: 0px !important;">
						<input type="hidden" name="btn" value="<?=$btn;?>">
						<input type="hidden" name="dpt" value="<?=$dpt;?>">
						<input type="hidden" name="mnc" value="<?=$mnc;?>">
						<input type="hidden" name="crp" value="<?=$crp;?>">
						<input type="hidden" name="nmnc" value="<?=$dtdm['elenmun'];?>">
						<input type="hidden" name="nb" value="<?=$nb;?>">
						<input type="hidden" name="cfg" value="<?=$tcfg;?>">
						<input type="number" name="ctd" min="1" max="<?php if($dcc && $dcc[0]['can']) echo $dcc[0]['can']; else echo "20";?>" value="<?php if($cfg && $cfg[0]['ctd']) echo $cfg[0]['ctd']; elseif($dcc && $dcc[0]['can']) echo $dcc[0]['can']; else echo "20";?>" style="width: 100%;padding: 5px 7px;height: 40px;">
					</div>
					<div class="form-group col-md-6" style="text-align: left;padding: 2px !important;margin: 0px !important;">
						<button type="submit" class="btn-secondary-ccapital" title="Banner Web" <?=$styl;?>><i class="fa fa-globe" aria-hidden="true"></i></button>
					</div>
				</div>
			</form>
			<?php $cfg = NULL;
			} ?>
		</div>
	<?php }} ?>
</div>