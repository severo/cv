<?php

function creer_lien_riche($lien) {

	$lien_or = $lien;

	// lien local ?
	if (FALSE
	AND preg_match(',^https?://('
		.preg_quote(_HOST).'/messages/(\d+)|'
		.preg_quote(_SHORT_HOST).'/([a-f0-9]+)'
		.'),',
	$lien, $r)) {
		if ($r[3]) # short
			$id_me = base_convert($r[3],36,10);
		else
			$id_me = $r[2];

		if ($id_me
		AND $t = texte_de_me($id_me)) {
			$t = array_filter(explode("\n", $t));
			$titre = supprimer_tags(typo_seenthis(couper($t[0], 60)));
			if (!strlen($titre)) $titre = $lien;
			return "<style>    a.internal-link { text-decoration: none;  } a.internal-link span.titre { text-decoration: underline;  }  a.internal-link span.url {     display:inline-block;     width:1px;     height:1px;     overflow:hidden;     color:transparent;    }    a.internal-link::before {     content: '❝';  }    a.internal-link::after {     content: '❞';  text-decoration: none;}    }    </style>    <a href='$lien' class='internal-link'><span class='url'>$lien </span><span class='titre'>$titre</span></a>";
		}
	}

	// Supprimer slash final
	$lien = preg_replace(",/$,", "", $lien);

	include_spip("inc/lien_court");
	$intitule = lien_court($lien, 45);

	if (function_exists('recuperer_favicon')) {
		$favicon_file_path = recuperer_favicon($lien_or);
		if ($favicon_file_path) {
			$favicon_type = pathinfo($favicon_file_path, PATHINFO_EXTENSION);
			$favicon_data = base64_encode(file_get_contents($favicon_file_path));
			$style = " style='background-image:url(data:image/$favicon_type;base64,$favicon_data);'";
		}
	}

	$le_lien = "<span class='lien_lien'$style>$total<a href=\"$lien_or\" class='spip_out'$titre$lang>$intitule</a></span>";

	$le_lien = str_replace("&", "&amp;", $le_lien);
	$le_lien = str_replace("&amp;amp;", "&amp;", $le_lien);


	return $le_lien;
}

?>
