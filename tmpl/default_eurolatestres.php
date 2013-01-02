<?php
/**
 * @subpackage	mod_lotto
 * @copyright	Copyright (C) 2012 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');


$res = $lotto->getlatestEuroResults();

?>
<div id="EuroLatestRes">


<?php

// Should only be one, but assume there are more (so we can handle errors)

foreach ($res as $result){

if (empty($result->Date)){ continue; }



echo "<h3 style=\"EuroLatestHead\">EuroMillions - {$result->Day} " . date('d M y',strtotime($result->Date)) .  "<!-- Draw ID {$result->DrawID} --></h3>".
"<table class=\"EuroLatest\">".
"<tr class=\"latestresult\">";

	    
	    echo "<td class=\"Euroball\">{$result->Ball1}</td>" .
	    "<td class=\"Euroball\">{$result->Ball2}</td>" .
	    "<td class=\"Euroball\">{$result->Ball3}</td>" .
	    "<td class=\"Euroball\">{$result->Ball4}</td>" .
	    "<td class=\"Euroball\">{$result->Ball5}</td>" .
	    "<td class=\"EuroStar\">{$result->Ball6}</td>" .
	    "<td class=\"EuroStar\">{$result->Ball7}</td>" .
	    "</tr>\n</table>";


}
unset($res);
unset($result);


?> 
</div>