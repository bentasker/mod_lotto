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
<div id="bulklottoresults">
<?php


if (!isset($_POST['LottoResMonth'])){

$month = date('Y-m');
}else{
$month = $_POST['LottoResYear'] . "-" . $_POST['LottoResMonth'];
}

$res = $lotto->checklottoresults($month);

// Cycle through each of the results

?>
<h3>Previous Lotto Results</h3>
<table class="modlottoResults">
<tr class="modlottoResultsHead"><th>Draw Date</th><th colspan="8">Balls</th></tr>
<?php
$Z = 0;
foreach ($res as $result){

if (empty($result)){ continue; }
$Z++;
	    echo "<tr class=\"latestresult\">" .
	    "<td class=\"LottoResDrawDate\">{$result->Day} " . date('d M y',strtotime($result->Date)) . "<!-- Draw ID {$result->DrawID} --></td>";
	    $class = rand(1,6);
	    echo "<td class=\"ball$class\">{$result->Ball1}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"ball$class\">{$result->Ball2}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"ball$class\">{$result->Ball3}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"ball$class\">{$result->Ball4}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"ball$class\">{$result->Ball5}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"ball$class\">{$result->Ball6}</td>".
	    "<td class=\"LottoBonusText\">Bonus:</td>";

	    $class = rand(1,6);
	    echo "<td class=\"ball$class\">{$result->Ball7}</td>";
	    echo "</tr>\n";
}
unset($res);

if ($Z == 0){echo "<tr><td colspan=\"9\">No Results Found!</td></tr>\n";}

echo "</table>";

if ($params->get('SelLottoResults')){
?>

<form name="modlottoRess" method="POST">

Display results for: 
<select class="LottoSelect" id="ResCheckSelect" name="LottoResMonth">
<?php
$X = 1;
while ($X <= 12){

echo "<option value=\"" . date('m',strtotime("2012-$X-01")) . "\">" . date('M',strtotime("2012-$X-01")) . "</option>\n";
$X++;
}
?>
</select>


<select class="LottoSelect" id="ResCheckSelectYear" name="LottoResYear">
<?php
$X = 2011;

while ($X < date('Y')){

echo "<option value=\"$X\">$X</option>\n";
$X++;
}

echo "<option value=\"". date('Y') . "\" selected>" . date('Y') . "</option>\n";


?>
</select>

<input type="submit" class="LottoSubmit" value="Retrieve Lotto Results">

<input type="hidden" name="option" value="<?php echo JRequest::getVar('option');?>">
<input type="hidden" name="task" value="<?php echo JRequest::getVar('task');?>">
<input type="hidden" name="view" value="<?php echo JRequest::getVar('view');?>">
<input type="hidden" name="layout" value="<?php echo JRequest::getVar('layout');?>">


</form>
<?php
}


?> 
</div>
