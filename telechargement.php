<?php

$a = getcwd().'\sauvegarde\"'. "\n";
$b = substr($a,0,-2);
$c = str_replace("\\","/",$b);
$chemin = $c.'suppression.csv';

header('Content-Transfer-Encoding: binary');
header('Content-Disposition: attachment; filename="liste-etudiant-désinscrit.csv"');
header("Pragma: public");
readfile($chemin);