<?php

$candidatAb1 = $_POST['candidatAb1'];
$candidatBb1 = $_POST['candidatBb1'];
$candidatCb1 = $_POST['candidatCb1'];
$candidatDb1 = $_POST['candidatDb1'];
$candidatAb2 = $_POST['candidatAb2'];
$candidatBb2 = $_POST['candidatBb2'];
$candidatCb2 = $_POST['candidatCb2'];
$candidatDb2 = $_POST['candidatDb2'];
if(isset($_POST['btn'])){



$total = $candidatAb1+$candidatAb2+$candidatBb1+$candidatBb2+$candidatCb1+$candidatCb2+$candidatDb1+$candidatDb2;
$scoreA = $candidatAb1+$candidatAb2; 
$scoreB = $candidatBb1+$candidatBb2; 
$scoreC = $candidatCb1+$candidatCb2;
$scoreD = $candidatDb1+$candidatDb2;
$scores = [];
foreach ($scores as $score) {
  $scoreA += $score[1]; 
  $scoreB += $score[2]; 
  $scoreC += $score[3]; 
  $scoreD += $score[4]; 
}

$pourcentageA = round($scoreA / $total * 100, 2); 
$pourcentageB = round($scoreB / $total * 100, 2); 
$pourcentageC = round($scoreC / $total * 100, 2); 
$pourcentageD = round($scoreD / $total * 100, 2);


$elu = ""; 
$secondTour = []; 
$ballottageFavorable = "";
$ballottageDefavorable = ""; 
$battus = []; 
if ($pourcentageA > 50) { 
  $elu = "Candidat A"; 
} else if ($pourcentageB > 50) { 
  $elu = "Candidat B"; 
} else if ($pourcentageC > 50) { 
  $elu = "Candidat C"; 
} else if ($pourcentageD > 50) { 
  $elu = "Candidat D"; 
} else { 

  $max1 = max($pourcentageA, $pourcentageB, $pourcentageC, $pourcentageD); 
  $max2 = 0;
  foreach (array($pourcentageA, $pourcentageB, $pourcentageC, $pourcentageD) as $p) {
    if ($p < $max1 && $p > $max2) {
      $max2 = $p; 
    }
  }

  if ($pourcentageA == $max1 || $pourcentageA == $max2) {
    $secondTour[] = "Candidat A";
  }
  if ($pourcentageB == $max1 || $pourcentageB == $max2) {
    $secondTour[] = "Candidat B";
  }
  if ($pourcentageC == $max1 || $pourcentageC == $max2) {
    $secondTour[] = "Candidat C";
  }
  if ($pourcentageD == $max1 || $pourcentageD == $max2) {
    $secondTour[] = "Candidat D";
  }
  
  if ($pourcentageA == $max1) {
    $ballottageFavorable = "Candidat A";
  } else if ($pourcentageB == $max1) {
    $ballottageFavorable = "Candidat B";
  } else if ($pourcentageC == $max1) {
    $ballottageFavorable = "Candidat C";
  } else if ($pourcentageD == $max1) {
    $ballottageFavorable = "Candidat D";
  }
  
  if ($pourcentageA == $max2) {
    $ballottageDefavorable = "Candidat A";
  } else if ($pourcentageB == $max2) {
    $ballottageDefavorable = "Candidat B";
  } else if ($pourcentageC == $max2) {
    $ballottageDefavorable = "Candidat C";
  } else if ($pourcentageD == $max2) {
    $ballottageDefavorable = "Candidat D";
  }
 
  if ($pourcentageA < $max2) {
    $battus[] = "Candidat A";
  }
  if ($pourcentageB < $max2) {
    $battus[] = "Candidat B";
  }
  if ($pourcentageC < $max2) {
    $battus[] = "Candidat C";
  }
  if ($pourcentageD < $max2) {
    $battus[] = "Candidat D";
  }
}





function afficherGraphique($nom, $pourcentage, $couleur) {

  echo "<style>
    .barre {
      height: 25px;
      margin: 7px;
      background-color: $couleur;
      text-align: right;
      padding-right: 15px;
      line-height: 25px;
      color: yellow;
    }
  </style>";
  
  echo "<div class='barre' style='width: $pourcentage%;'>$nom : $pourcentage%</div>";
}


echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title >Résultats de l'élection</title>";
echo "</head>";
echo "<body>";
echo "<h1>Résultats de l'élection</h1>";


if ($elu != "") {
  echo "<p>Le candidat élu dès le premier tour est : <strong>$elu</strong></p>";
  echo "<p>Voici le détail des scores :</p>";
 
  afficherGraphique("Candidat A", $pourcentageA, "red");
  afficherGraphique("Candidat B", $pourcentageB, "orange");
  afficherGraphique("Candidat C", $pourcentageC, "green");
  afficherGraphique("Candidat D", $pourcentageD, "blue");
} else { 
  echo "<p>Aucun candidat n'a obtenu plus de 50% des voix. Il faut donc un second tour entre les deux candidats suivants :</p>";
 
  echo "<ul>";
  foreach ($secondTour as $candidat) {
    echo "<li><strong>$candidat</strong></li>";
  }
  echo "</ul>";
  echo "<p>Voici le détail des scores et des statuts :</p>";
 
  afficherGraphique("Candidat A", $pourcentageA, "red");
  echo "<p>Statut : ";
  if ($ballottageFavorable == "Candidat A") {
    echo "Ballottage favorable";
  } else if ($ballottageDefavorable == "Candidat A") {
    echo "Ballottage défavorable";
  } else {
    echo "Battu";
  }
  echo "</p>";
  afficherGraphique("Candidat B", $pourcentageB, "orange");
  echo "<p>Statut : ";
  if ($ballottageFavorable == "Candidat B") {
    echo "Ballottage favorable";
  } else if ($ballottageDefavorable == "Candidat B") {
    echo "Ballottage défavorable";
  } else {
    echo "Battu";
  }
  echo "</p>";
  afficherGraphique("Candidat C", $pourcentageC, "green");
  echo "<p>Statut : ";
  if ($ballottageFavorable == "Candidat C") {
    echo "Ballottage favorable";
  } else if ($ballottageDefavorable == "Candidat C") {
    echo "Ballottage défavorable";
  } else {
    echo "Battu";
  }
  echo "</p>";
  afficherGraphique("Candidat D", $pourcentageD, "blue");
  echo "<p>Statut : ";
  if ($ballottageFavorable == "Candidat D") {
    echo "Ballottage favorable";
  } else if ($ballottageDefavorable == "Candidat D") {
    echo "Ballottage défavorable";
  } else {
    echo "Battu";
  }
  echo "</p>";
}


echo "</body>";
echo "</html>";


}
?>