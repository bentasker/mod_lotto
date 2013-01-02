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

<div class="modLottoPredictHolder">
<?php
// Should we display the latest Lotto Results?
if ($params->get('DispLatestLottoResults')){
require_once('default_lottolatestres.php');

}


if ($params->get('DispLDs')){

require_once('default_dispLDS.php');
}




if ($params->get('DispLottoResults')){

require_once('default_bulklottoresults.php');

}



if ($params->get('CheckUserLotto')){
require_once('default_checkuserlotto.php');
}

// Should we display the latest ThunderBall results?
if ($params->get('DispLatestTBResults')){

require_once('default_tblatestres.php');

}


// Should we display the latest Euro results?
if ($params->get('DispLatestEuroResults')){

require_once('default_eurolatestres.php');

}


if ($params->get('DispELDs')){

require_once('default_dispELDS.php');
}


if ($params->get('CheckUserEur')){

require_once('default_checkusereuro.php');

}


if ($params->get('DispPurchaseLink')){



?>
<div class="LottoPurchaseLink">
<a href="<?php echo $params->get('PurchaseLink'); ?>" target=_blank title="Buy tickets for the UK National Lottery">Buy Tickets</a>
</div>
<?php


}


?>

</div>