<?php
/**
 *  LexiData Corrector
 *
 *  This is a simple script that provide the correction for LexiData Toy.
 *  It can be use to create custom "learning file".
 *
 *  @author     Thierry 'Akarun' Lagasse
 *  @since      dec 2012
 *  @link       http://passtech.be
 *
 *  .......................................................
 *
 *  @link       http://www.lexidata.be
 */

// ============================================================================

$serie = intval(trim($_REQUEST['serie']));
$groupe = intval(trim($_REQUEST['groupe']));

if ( $serie < 1 || 60 < $serie ) { $serie = 1; }
if ( $groupe < 1 || 60 < $groupe ) { $groupe = 1; }

// Tableau des positions des verroux (x12)
$verroux = array(8,13,17,22,26,29,32,35,39,44,48,53);

// Tableau des reponses (x60)
$reponses = array(
    3,1,2,3,2,3,1,2,1,2,
    1,2,3,1,3,2,2,3,2,3,
    1,1,2,1,2,3,1,3,1,2,
    3,2,3,1,2,1,2,3,2,3,
    1,1,2,3,2,3,1,2,1,1,
    2,3,2,3,1,3,1,2,3,2
);

$series = array_flip(array(
    1,4,8,10,2,6,3,9,5,7,
    14,19,12,16,20,11,13,18,15,17,
    21,26,30,25,22,28,23,29,24,27,
    35,31,40,37,32,39,36,33,38,34,
    41,50,46,42,49,43,45,47,44,48,
    57,52,55,51,58,54,59,53,56,60
));

$iGroupe = $groupe - 1;
$iSerie = $series[$serie];

foreach ($verroux as $i => $verrou) {
    $iReponse = $verrou + $iGroupe - $iSerie;
    if ($iReponse < 0) { $iReponse += 60; }
    elseif ($iReponse > 59) { $iReponse -= 60; }

    $reponse = $reponses[$iReponse];
    $sReponses .= sprintf('<li>%s</li>', str_pad('', $reponse, '*')) . PHP_EOL;
}
// ============================================================================
?>

<h1>LexiDATA</h1>
<form action="" method="GET">
    <label>Serie <input type="text" name="serie" value="<?= $serie ?>" title="Entrer la série (1 - 60)" size="2" /></label>
    <label>Groupe <input type="text" name="groupe" value="<?= $groupe ?>" title="Entrer le groupe (1 - 60)" size="2" /></label>
    <input type="submit" name="refresh" value="Voir" />
</form>

<ol>
    <?= $sReponses ?>
</ol>