<?php
/**
 * @subpackage	mod_lotto
 * @copyright	Copyright (C) 2012 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');


$res = $lotto->getlatestTBResults();

?>
<div id="TBLatestRes">


<?php

// Should only be one, but assume there are more (so we can handle errors)

foreach ($res as $result){

if (empty($result->Date)){ continue; }



echo "<h3 style=\"TBLatestHead\">ThunderBall - {$result->Day} " . date('d M y',strtotime($result->Date)) .  "<!-- Draw ID {$result->DrawID} --></h3>".
"<table class=\"TBLatest\">".
"<tr class=\"latestresult\">";

	    $class = rand(1,6);
	    echo "<td class=\"TBball$class\">{$result->Ball1}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"TBball$class\">{$result->Ball2}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"TBball$class\">{$result->Ball3}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"TBball$class\">{$result->Ball4}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"TBball$class\">{$result->Ball5}</td>";
	    $class = rand(1,6);
	    echo "<td class=\"TBball$class\">{$result->Ball6}</td>";
	    echo "</tr>\n</table>";


}
unset($res);
unset($result);


?> 
</div>