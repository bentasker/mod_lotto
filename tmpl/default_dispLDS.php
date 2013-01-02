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
<div id="dispLDs">
<?php

if (!empty($_POST['modlottoLuckyDips'])){
$luckdips = $_POST['modlottoLuckyDips'];
}else{
$luckdips = 1;
}


// Output LuckyDips
$LuckyDips = $lotto->generateLottoluckydip($luckdips);
?>

<h3>Lotto Lucky Dip</h3>

<table class="modlottoLDs">

<?php
// Cycle through each one
foreach ($LuckyDips as $dip){
  if (empty($dip)){ continue; }
echo "<tr class=\"latestresult\">";
  // Cycle through the array

    foreach ($dip as $ball){
	    $class = rand(1,6);
	    echo "<td class=\"ball$class\">$ball</td>";
	    }
	  
echo "</tr>\n";

	      
  }
unset($LuckyDips);

?>
</table>


<?php if ($params->get('GenLDs')){?>
<form name="modlottoLDs" method="POST">

Generate <select class="LottoSelect" id="LuckyDipsSelect" name="modlottoLuckyDips">
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