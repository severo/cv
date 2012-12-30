<?php

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Installation/maj des tables cv
 *
 * @param string $nom_meta_base_version
 * @param string $version_cible
 */
function cv_upgrade($nom_meta_base_version, $version_cible){
	$maj = array();
	
	// Première installation
	$maj['create'] = array(
	);
	
	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

/**
 * Desinstallation/suppression des tables cv
 *
 * @param string $nom_meta_base_version
 */
function gis_vider_tables($nom_meta_base_version) {
	effacer_meta($nom_meta_base_version);
	// Effacer la config
	effacer_meta('gis');
}

?>
