<?php

/**
 * Formatage noms et autres formes
 *
 * @return string
 */
function formatAuthorNames ($nbrefs, $nom_bdfi, $prenom, $nom, $pseu, $legal, $formes)
{
   $tip = ($nbrefs == 1 ? '' : '&nbsp;&rarr;&nbsp;'); 

   $pattern = "";

  // Les autres données ne doivent pas être remplies -> A FAIRE, outils de vérif

   // A FAIRE : si nbrefs > 2 : format avec lien sur l'URL de la page auteur ici
   $bdfi = "$nom $prenom";
   $normal = str_replace("' ", "'", "$prenom $nom");
   $normal = str_replace(" $", "", $normal);
   if (($nbrefs > 2) && (($link = check_page($nom_bdfi)) != false))
   {
      $pattern .= "<em>$tip ";
      $pattern .= '<a href="' . $link . '">' . $normal . '</a>';
      $pattern .= "</em>";
   }
   else
   {
      $pattern .= "<em><strong>$tip $normal</strong></em>";
   }  
   $pattern .= ($nbrefs > 2 ? ' - ' : "<br />\n"); 

   // #------------------------------------------------------------
   // # Pseudonyme, indiquer le vrai nom
   // #------------------------------------------------------------
   if ($pseu == 1)
   {
      $pattern .= "Pseudonyme";
      // TBD : mettre les 'et' en non gras
      // Indiquer les liens si ils existent
      if (($legal != '') && ($legal != '?'))
      {
         $pattern .= " de <b>$legal</b>";
      }
      $pattern .= ($nbrefs > 2 ? ' - ' : "<br><br />\n"); 
   }
   else
   {
      if (($legal != '') && ($legal != $normal))
      {
         $pattern .= "Nom légal : $legal";
         $pattern .= ($nbrefs > 2 ? ' - ' : "<br />\n"); 
      }
   }

   // #------------------------------------------------------------
   // # Ici, on pourrait mettre le lien sur le vrai nom, si la page existe
   // #------------------------------------------------------------
   if (($formes != '') && ($nbrefs < 3))
   {
      $pattern .= "Autre(s) forme(s) : $formes<br />";
   }

   return $pattern;
}

/**
 * Formatage des dates et lieux de naissance et décès
 *
 * @return string
 */
function formatAuthorDates ($gender, $birth_date, $date_death, $birthplace)
{
   $pattern = "";

   if ($birth_date === NULL) { $birth_date = "0000-00-00"; }
   if ($date_death === NULL) { $date_death = "0000-00-00"; }

   if (($birth_date != "0000-00-00") && ($date_death != "0000-00-00"))
   {
      $pattern = " (" . (($birthplace != "") ? $birthplace . ", " : ""); 
      $pattern .= formatBdfiDate($gender, $birth_date, 0) . " - " . formatBdfiDate($gender, $date_death, 0) . ")\n";
   }
   else if ($birth_date != "0000-00-00")
   {
      $pattern = " (" . formatBdfiDate($gender, $birth_date, 1, $birthplace) . ")\n";
   }
   else if ($date_death != "0000-00-00")
   {
      $pattern = " (" . formatBdfiDate($gender, $date_death, 2, $birthplace) . ")\n";
   }
   return $pattern;
}

/**
 * Formatage d'une date simple
 *
 * @return string
 */
function formatBdfiDate ($gender, $str, $mode, $place="")
{
   $ne = ($gender == 'F' ? "née" : "né");
   $decede = ($gender == 'F' ? "décédée" : "décédé");
   $place = ($place != '?') ? $place : '';
   
   $tabmois = array (
      '01' => 'janvier',
      '02' => 'février',
      '03' => 'mars',
      '04' => 'avril',
      '05' => 'mai',
      '06' => 'juin',
      '07' => 'juillet',
      '08' => 'août',
      '09' => 'septembre',
      '10' => 'octobre',
      '11' => 'novembre',
      '12' => 'décembre',
   );
   $avjc="";
   if ($str[0] == "-") 
   {
      $avjc = " av. J.-C.";
      $str = substr($str, 1);
   }
   $amj = explode("-", $str);
   $an  = number_format((float)$amj[0], 0, ".", "");
   $mois = $amj[1];
   $jour = ($mois == "circa" ? "00" : $amj[2]);

   if ($mode == 0) 
   {
      // Extraction format date dans un mode ou les deux dates sont connues
      if ($mois == 'circa')
      {
         return "vers $an" . $avjc;
      }
      else if (($jour != '00') && ($mois != '00'))
      {
         return "$jour/$mois/$an";
      }
      else if ($mois != '00')
      {
         return $tabmois[$mois] . " $an";
      }
      else
      {
         return "$an";
      }
   }
   else if ($mode == 1)
   {
      // Extraction date de naissance (si date décés inconnue)
      if ($mois == 'circa')
      {
         return "$ne vers $an " . $avjc . ($place != '' ? " à $place": '');
      }
      else if (($jour != '00') && ($mois != '00'))
      {
         return "$ne le $jour/$mois/$an" . ($place != '' ? " à $place": '');
      }
      else if ($mois != '00')
      {
         return "$ne en " . $tabmois[$mois] . " $an" . ($place != '' ? " à $place" : '');
      }
      else
      {
         return "$ne en $an" . ($place != '' ? " à $place" : '');
      }
   }
   else if ($mode == 2)
   {
      // Extraction date de décès (si date naissance inconnue)
      if ($mois == 'circa')
      {
         return ($place != '' ? "$ne à $place, ": "") . "$decede vers $an" . $avjc;
      }
      else if (($jour != '00') && ($mois != '00'))
      {
         return ($place != '' ? "$ne à $place, ": "") . "$decede le $jour/$mois/$an";
      }
      else if ($mois != '00')
      {
         return ($place != '' ? "$ne à $place, ": "") . "$decede en " . $tabmois[$mois] . " $an";
      }
      else
      {
         return ($place != '' ? "$ne à $place, ": "") . "$decede en $an";
      }
   }
}