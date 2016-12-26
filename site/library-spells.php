<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 29/12/12   #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"js" => TRUE,
	"css" => TRUE
));
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Magias</h1>
		<span class="content">
			<fieldset id="spells-form">
				<legend>Pesquisar magias</legend>
				
				<table class="search">
					<thead>
						<tr>
							<th colspan="2">Vocação</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input id="voc_mage" type="checkbox" value="1"> Mage</td>
							<td><input id="voc_ninja" type="checkbox" value="1"> Ninja</td>
						</tr>
						<tr>
							<td><input id="voc_tribal" type="checkbox" value="1"> Tribal</td>
							<td><input id="voc_amazon" type="checkbox" value="1"> Amazon</td>
						</tr>
						<tr>
							<td><input id="voc_elfian" type="checkbox" value="1"> Elfian</td>
							<td><input id="voc_dwarfian" type="checkbox" value="1"> Dwarfian</td>
						</tr>
						<tr>
							<td><input id="voc_wild" type="checkbox" value="1"> Wild</td>
							<td><input id="voc_monk" type="checkbox" value="1"> Monk</td>
						</tr>
						<tr>
							<td colspan="2"><input id="voc_all" type="checkbox" checked="checked" value="1"> Selecionar todas vocações</td>
						</tr>
					</tbody>
				</table>
				
				<table class="search">
					<thead>
						<tr>
							<th colspan="2">VIP</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input id="vip_no" name="spells-vip" type="radio" value="0" checked="checked"> Não</td>
						</tr>
						<tr>
							<td><input id="vip_yes" name="spells-vip" type="radio" value="1"> Sim</td>
						</tr>
						<tr style="visibility: hidden">
							<td><input type="radio"> Sim</td>
						</tr>
					</tbody>
				</table>
				
				<table class="search last">
					<thead>
						<tr>
							<th colspan="2">Com Promote</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input id="promote_no" name="spells-promote" type="radio" value="1" checked="checked"> Sem promote</td>
						</tr>
						<tr>
							<td><input id="promote_1" name="spells-promote" type="radio" value="2"> 1ª Promote</td>
						</tr>
						<tr>
							<td><input id="promote_2" name="spells-promote" type="radio" value="3"> 2ª Promote</td>
						</tr>
					</tbody>
				</table>
				
				<button id="do-search" class="margintop large">Pesquisar</button>
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div class="box ghost">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Pesquisa</h1>
		<span class="content">
			<fieldset>
				<legend>Resultados de Pesquisa</legend>
				<table class="common">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Palavras</th>
							<th>Nível</th>
							<th>M.L.</th>
							<th>Vocações</th>
							<th>VIP</th>
						</tr>
					</thead>
					<tbody id="search-results">
					</tbody>
				</table>
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Legenda</h1>
		<span class="content">
			<fieldset>
				<legend>Legenda das vocações</legend>
				<table>
					<tr>
						<td><span class="ico16_tibia_magehat" title="Mage"></span> <label>Mage</label></td>
						<td><span class="ico16_tribal" title="Tribal"></span> <label>Tribal</label></td>
						<td><span class="ico16_elvish" title="Elfian"></span> <label>Elfian</label></td>
						<td><span class="ico16_tibia_warrior_helmet" title="Wild"></span> <label>Wild</label></td>
					</tr>
					<tr>
						<td><span class="ico16_shuriken" title="Ninja"></span> <label>Ninja</label></td>
						<td><span class="ico16_amazon" title="Amazon"></span> <label>Amazon</label></td>
						<td><span class="ico16_pick" title="Dwarfian"></span> <label>Dwarfian</label></td>
						<td><span class="ico16_tibia_book_3" title="Monk"></span> <label>Monk</label></td>
					</tr>
				</table>
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>