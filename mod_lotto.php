<?php
/**
 * @subpackage	mod_lotto
 * @copyright	Copyright (C) 2012 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

//$params->def('greeting', 1);


$lotto = new modLottoHelper;
$lotto->setparams($params);


$size = $params->get('Size');
$style = $params->get('Ballstyle');
$document =& JFactory::getDocument();
$document->addStyleSheet("modules/mod_lotto/assets/mod_lotto-$size-$style.css");
$document->addStyleSheet("modules/mod_lotto/assets/mod_lotto.css");

require JModuleHelper::getLayoutPath('mod_lotto', $params->get('layout', 'default'));