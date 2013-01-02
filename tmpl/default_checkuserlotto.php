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

if ($_POST['NoChecker']){
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


$res = $lotto->checkuserResults($game,$draws,$ball1,$ball2,$ball3,$ball4,$ball5,$ball6);

?>

<table id="matchedResults">
<tr class="Usermatchhead"><th>Draw Date</th><th>You Matched</th><th colspan="8">Balls</th></tr>
<?php
$Z=0;
foreach ($res as $result){
if (empty($result)){ continue; }
$Z++;
echo "<tr class=\"latestresult\">" .
"<td class=\"LottoResDrawDate\">{$result->Day} " . date('d m y',strtotime($result->Date)) . "<!-- Draw ID {$result->DrawID} --></td>".
"<td class=\"YouMatched\">{$result->num_matches}</td>";
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
	    "<td class=\"LottoBonusText\">";
	   
	    if ($result->Ball7 == 0){
	    $result->Ball7 = "";
	    $class = 'empty';
	    }else{

	    echo "Bonus: ";
	    $class = rand(1,6);
	    }
	    echo "</td><td class=\"ball$class\">Bonus: {$result->Ball7}</td>";
	    echo "</tr>\n";
}
unset($res);

if ($Z == 0){ echo "<tr><td colspan=\"10\">None Found!<style type=\"text/css\">.Usermatchhead {display: none;}</style></td></tr>\n"; }
?>
</table>


<?php
}




?>

<div id="Usercheckbg" style="width: <?php echo $params->get('divWidth'); ?>px;">

<?php if (!$_POST['NoChecker']){
echo "<h3 class=\"nocheckembedhead\">Check your Numbers</h3>";
}?>

<div style="margin: auto; width: 95%; padding: 5px;">
<form name="modlottoResCheck" method="POST">
<input type="hidden" name="NoChecker" value="1">
<span class="LottoEnter">Enter your Lotto numbers</span> <br />
<input class="lottoNumber" type="text" size="1" maxlength="2" name="Ball1"> <input class="lottoNumber" type="text" size="1" maxlength="2" name="Ball2">
 <input class="lottoNumber" type="text" size="1" maxlength="2" name="Ball3"> <input class="lottoNumber" type="text" size="1" maxlength="2" name="Ball4"> 
<input class="lottoNumber" type="text" size="1" maxlength="2" name="Ball5"> <input class="lottoNumber" type="text" size="1" maxlength="2" name="Ball6">
<br /><br />
<!-- Game: - Thunderball not yet fully supported by API --> <select style="display:none;" class="LottoSelect" id="GameSelect" name="Game">
<option value="1" selected>Lotto</option>
<option value="2">Thunderball</option>
</select>

Draws: <select class="LottoSelect" id="DrawSelect" name="Draws">
<option value="Any">Any</option>
<option value="Mon">Mon</option>
<option value="Tue">Tue</option>
<option value="Wed">Wed</option>
<option value="Thu">Thur</option>
<option value="Fri">Fri</option>
<option value="Sat">Sat</option>
<option value="Sun">Sun</option>
</select>

<input type="submit" class="LottoSubmit" value="Retrieve Lotto Results">

<input type="hidden" name="option" value="<?php echo JRequest::getVar('option');?>">
<input type="hidden" name="task" value="<?php echo JRequest::getVar('task');?>">
<input type="hidden" name="view" value="<?php echo JRequest::getVar('view');?>">
<input type="hidden" name="layout" value="<?php echo JRequest::getVar('layout');?>">


</form>
</div>
</div>
</div>
