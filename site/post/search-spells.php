<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 29/12/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$vocations = array();

if (isSet($_POST["promote_no"]) OR isSet($_POST["promote_1"]) OR isSet($_POST["promote_2"])) {
	if (isSet($_POST["voc_sorcerer"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 1;
	
	if (isSet($_POST["voc_tribal"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 2;
	
	if (isSet($_POST["voc_elfian"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 3;
	
	if (isSet($_POST["voc_wild"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 4;
	
	if (isSet($_POST["voc_ninja"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 5;
	
	if (isSet($_POST["voc_amazon"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 6;
	
	if (isSet($_POST["voc_dwarfian"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 7;
	
	if (isSet($_POST["voc_monk"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 8;
}

if (isSet($_POST["promote_1"]) OR isSet($_POST["promote_2"])) {
	if (isSet($_POST["voc_sorcerer"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 11;
	
	if (isSet($_POST["voc_tribal"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 12;
	
	if (isSet($_POST["voc_elfian"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 13;
	
	if (isSet($_POST["voc_wild"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 14;
	
	if (isSet($_POST["voc_ninja"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 15;
	
	if (isSet($_POST["voc_amazon"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 16;
	
	if (isSet($_POST["voc_dwarfian"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 17;
	
	if (isSet($_POST["voc_monk"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 18;
}

if (isSet($_POST["promote_2"])) {
	if (isSet($_POST["voc_sorcerer"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 21;
	
	if (isSet($_POST["voc_tribal"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 22;
	
	if (isSet($_POST["voc_elfian"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 23;
	
	if (isSet($_POST["voc_wild"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 24;
	
	if (isSet($_POST["voc_ninja"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 25;
	
	if (isSet($_POST["voc_amazon"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 26;
	
	if (isSet($_POST["voc_dwarfian"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 27;
	
	if (isSet($_POST["voc_monk"]) OR isSet($_POST["voc_all"]))
		$vocations[] = 28;
}

$spells = getSpells(array(
	"vocations" => $vocations,
	"vip" => (isSet($_POST["vip_yes"]))
));

echo(json_encode($spells));
?>