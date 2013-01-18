<?php
/*
* Configuration de SPIP pour GTP
*/

//fonction qui permet de créer les métas de config du site
function gtp_config_site() {	
	ecrire_meta('YAML','oui');
	
}
//fonction qui permet de créer une rubrique
function create_rubrique($titre, $id_parent='0', $descriptif='') {
	$id_rubrique = find_rubrique($titre);
	if ($id_rubrique == 0) {
		$id_rubrique = sql_insertq(
			"spip_rubriques", array(
				"titre" => $titre,
				"id_parent" => $id_parent,
				"descriptif" => $descriptif
			)
		);
		sql_updateq(
			"spip_rubriques", array(
				"id_secteur" => $id_rubrique
			), "id_rubrique=$id_rubrique"
		);
		spip_log("1. (create_rubrique) rubrique cree : id = $id_rubrique, titre = $titre", "soyezcreateurs_install");
	}
	else if ($id_rubrique > 0) {
		$id_rubrique = id_rubrique($titre);
		remplacer_rubrique($id_rubrique, $id_parent, $descriptif);
	}
	return $id_rubrique;
}
//fonction qui permet de créer le tout
function gtp_config_gogo() {
	//les rubriques
	create_rubrique('10. Outils', '0', "Vous trouverez dans cette rubrique:\n\n-* Les Éditos\n-* Des articles concernant le site lui-même\n");
}
?>
