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
<div id="checkuserlotto">
<?php

if ($_POST['EurNoChecker']){
// Form was submitted, submit an API request
echo "<h3>Check your Numbers</h3>";
$game = $_POST['Game'];
$draws = $_POST['Draws'];
$ball1 = $_POST['Ball1'];
$ball2 = $_POST['Ball2'];
$ball3 = $_POST['Ball3'];
$ball4 = $_POST['Ball4'];
$ball5 = $_POST['Ball5'];
$ball6 = $_POST['Ball6'];
$ball7 = $_POST['Ball7'];

$res = $lotto->checkuserResults($game,$draws,$ball1,$ball2,$ball3,$ball4,$ball5,$ball6,$ball7);

?>

<table id="EurmatchedResults">
<tr class="EurUsermatchhead"><th>Draw Date</th><th>You Matched</th><th colspan="8">Balls</th></tr>
<?php
$Z=0;
foreach ($res as $result){
if (empty($result)){ continue; }
$Z++;
echo "<tr class=\"latestresult\">" .
"<td class=\"LottoResDrawDate\">{$result->Day} " . date('d m y',strtotime($result->Date)) . "<!-- Draw ID {$result->DrawID} --></td>".
"<td class=\"YouMatched\">{$result->num_matches}</td>";
	    
	    echo "<td class=\"Euroball\">{$result->Ball1}</td>".
	     "<td class=\"Euroball\">{$result->Ball2}</td>".    
	     "<td class=\"Euroball\">{$result->Ball3}</td>".   
	     "<td class=\"Euroball\">{$result->Ball4}</td>".
	     "<td class=\"Euroball\">{$result->Ball5}</td>".
	   "<td class=\"EuroStar\">{$result->Ball6}</td>". 
	     "<td class=\"EuroStar\">{$result->Ball7}</td>".
	    "</tr>\n";
}
unset($res);

if ($Z == 0){ echo "<tr><td colspan=\"10\">None Found!<style type=\"text/css\">.EurUsermatchhead {display: none;}</style></td></tr>\n"; }
?>
</table>


<?php
}




?>

<div id="EurUsercheckbg" style="width: <?php echo $params->get('EurdivWidth'); ?>px;">

<?php if (!$_POST['NoChecker']){
echo "<h3 class=\"eurnocheckembedhead\">Check your Numbers</h3>";
}?>

<div style="margin: auto; width: 95%; padding: 5px;">
<form name="modlottoEurResCheck" method="POST">
<input type="hidden" name="EurNoChecker" value="1">
<span class="EurEnter">Enter your EuroMillions numbers</span> <br />
<input class="EurNumber" type="text" size="1" maxlength="2" name="Ball1"> <input class="EurNumber" type="text" size="1" maxlength="2" name="Ball2">
 <input class="EurNumber" type="text" size="1" maxlength="2" name="Ball3"> <input class="EurNumber" type="text" size="1" maxlength="2" name="Ball4"> 
<input class="EurNumber" type="text" size="1" maxlength="2" name="Ball5"> <input class="EurNumber" type="text" size="1" maxlength="2" name="Ball6">
<input class="EurNumber" type="text" size="1" maxlength="2" name="Ball7">
<br /><br />
<input type="hidden" id="GameSelect" name="Game" value="3">


Draws: <select class="EurSelect" id="DrawSelect" name="Draws">
<option value="Any">Any</option>
<option value="Mon">Mon</option>
<option value="Tue">Tue</option>
<option value="Wed">Wed</option>
<option value="Thu">Thur</option>
<option value="Fri">Fri</option>
<option value="Sat">Sat</option>
<option value="Sun">Sun</option>
</select>

<input type="submit" class="EurSubmit" value="Check Results">

<input type="hidden" name="option" value="<?php echo JRequest::getVar('option');?>">
<input type="hidden" name="task" value="<?php echo JRequest::getVar('task');?>">
<input type="hidden" name="view" value="<?php echo JRequest::getVar('view');?>">
<input type="hidden" name="layout" value="<?php echo JRequest::getVar('layout');?>">


</form>
</div>
</div>
</div>
