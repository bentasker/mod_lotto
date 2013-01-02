<?php
/**
 * @subpackage	mod_lotto
 * @copyright	Copyright (C) 2012 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');




?>
<div id="dispELDs">
<?php

if (!empty($_POST['modlottoELuckyDips'])){
$luckdips = $_POST['modlottoELuckyDips'];
}else{
$luckdips = 1;
}


// Output LuckyDips
$LuckyDips = $lotto->generateEuroluckydip($luckdips);
?>

<h3>EuroMillions Lucky Dip</h3>

<table class="modlottoELDs">

<?php
// Cycle through each one
foreach ($LuckyDips as $dip){
  if (empty($dip)){ continue; }
echo "<tr class=\"latestresult\">";
  // Cycle through the array
$X = 1;
    foreach ($dip as $ball){
	    

	    if (($X == "6") || ($X == "7")){
	    $class="EuroStar";
	    }else{
	    $class="Euroball";
	    }

	    echo "<td class=\"$class\">$ball</td>";
	    $X++;
	    }
	  
echo "</tr>\n";

	      
  }
unset($LuckyDips);

?>
</table>


<?php if ($params->get('GenELDs')){?>
<form name="modlottoLDs" method="POST">

Generate <select class="LottoSelect" id="LuckyDipsSelect" name="modlottoELuckyDips">
<?php
$X = 1;
while ($X <= 10){

echo "<option value=\"$X\">$X</option>";
$X++;
}

?>
</select> Lucky Dips.
<input type="submit" class="LottoSubmit" value="Generate">

<input type="hidden" name="option" value="<?php echo JRequest::getVar('option');?>">
<input type="hidden" name="task" value="<?php echo JRequest::getVar('task');?>">
<input type="hidden" name="view" value="<?php echo JRequest::getVar('view');?>">
<input type="hidden" name="layout" value="<?php echo JRequest::getVar('layout');?>">


</form>
<?php 
// End Gen Lucky Dip
}
?> 
</div>