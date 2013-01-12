<?php
/**
 * @subpackage	mod_lotto
 * @copyright	Copyright (C) 2012 Ben Tasker . All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die;

class modLottoHelper
{
	
function setparams($params){
$this->params = $params;
}

function getAPIKey(){


return $this->params->get('APIKEY', '9c59922ab287d59d06011a4c91a21fcf');


}

      function checkuserResults($game,$draws,$ball1,$ball2,$ball3,$ball4,$ball5,$ball6,$ball7 = null){
      return $this->place_request('UserCheck',$game,"ball1=$ball1&ball2=$ball2&ball3=$ball3&ball4=$ball4&ball5=$ball5&ball6=$ball6&ball7=$ball7&draws=$draws");

      }




       function generateEuroluckydip($number){
      // Are we using the API or generating on site?
      if ($this->params->get('useLDAPI')){

      return $this->place_request('ELD','3',"no=$number");
	  }else{

	// This is not as random as the method used by the API, but someone could still win!


	// Generate the numbers

	  $x = 1;

	// Enforce the 10 limit to avoid accidental DoS
	if ($number > 10){ $number = 10; }
	 while ($x <= $number){
	      
	      $a = 1;
	      $str = ".";
		      // Generate 6 numbers
			while ($a <= 5){
			    $no = rand(1,49);
			    if (strpos($str,".". $no . ".") == false){
			    $str .= $no;
			    if ($a != 5){ $str .= "."; }
			    $a++;
			    }
			    }

	      // Numbers generated, now add them to an object

	      $str = substr($str,1,strlen($str) - 1);
	      $balls = explode(".",$str);
	      sort($balls);
	      

	      $star1 = rand(1,11);
	      $star2 = rand(1,11);

	      while ($star1 == $star2){
	      $star2 = rand(1,11);
	      }

	      if ($star1 < $star2){

	    $balls[5] = "$star1";
	    $balls[6] = "$star2";
	    }else{
	    $balls[5] = "$star2";
	    $balls[6] = "$star1";
	    }


	      $LDs["dip$x"] = $balls;

	      $x++;
	      }
	return $LDs;

	}
      }





      function generateLottoluckydip($number){
      // Are we using the API or generating on site?
      if ($this->params->get('useLDAPI')){

      return $this->place_request('LD','1',"no=$number");
	  }else{

	// This is not as random as the method use by the API, but someone could still win!


	// Generate the numbers

	  $x = 1;

	// Enforce the 10 limit to avoid accidental DoS
	if ($number > 10){ $number = 10; }
	 while ($x <= $number){
	      
	      $a = 1;
	      $str = ".";
		      // Generate 6 numbers
			while ($a <= 6){
			    $no = rand(1,49);
			    if (strpos($str,".". $no . ".") == false){
			    $str .= $no;
			    if ($a != 6){ $str .= "."; }
			    $a++;
			    }
			    }

	      // Numbers generated, now add them to an object

	      $str = substr($str,1,strlen($str) - 1);
	      $balls = explode(".",$str);
	      sort($balls);

	      $LDs["dip$x"] = $balls;

	      $x++;
	      }
	return $LDs;

	}
      }


      function checklottoresults($month){

      $shortcache = $this->params->get('shortcache') * 60;
      $shortcache = $this->params->get('longcache') * 60;
       // Get the config object from factory
        $conf =& JFactory::getConfig();
        // Get the current cachetime value
        $cachetime = $conf->getValue('config.cachetime');
        
	$datecheck = strtotime($month."-01");
	$now = strtotime(date('Y-m')."-01");
	if ($datecheck < $now){
	// Looking at historic results, we can cache for much longer
        $conf->setValue('config.cachetime', $longcache);

	}else{
	// Set the cache time to 8 hours i.e. 8 * 60 mins
        $conf->setValue('config.cachetime', $shortcache);
	}



        // Get the Cache object
        $cache =& JFactory::getCache('mod_lotto_latest_results'.$month, 'output');
        // Enable caching (if disabled in global configuration)
        $cache->setCaching( 1 );
        // Try to get the results from cache


    if (!($json = $cache->get('mod_lotto_latest_results_json'.$month))) {
            $uri =& JFactory::getURI();
            
           
            if ($json = $this->place_request('retrieve','1',"month=$month")) {
                // Store the data in cache
                if (!$cache->store($json, 'mod_lotto_latest_results_json'.$month)) {
                    // If storing in cache failed then we will return the error
                    $error = 'cache';
                }
            } else {
                $error = 'Could not retrieve';
            }
        }

return $json;








      //return $this->place_request('retrieve','1',"month=$month");

      }


function getlatestLottoResults(){



$shortcache = $this->params->get('shortcache') * 60;
$str = "draws=" . $this->params->get('LottoResultsDrawDays');

    
        // Get the config object from factory
        $conf =& JFactory::getConfig();
        // Get the current cachetime value
        $cachetime = $conf->getValue('config.cachetime');
        // Set the cache time 
        $conf->setValue('config.cachetime', $shortcache);
        // Get the Cache object
        $cache =& JFactory::getCache('mod_lotto_latest_results', 'output');
        // Enable caching (if disabled in global configuration)
        $cache->setCaching( 1 );
        // Try to get the results from cache


    if (!($json = $cache->get('mod_lotto_latest_results_json'))) {
            $uri =& JFactory::getURI();
            
           
            if ($json = $this->place_request('LatestResults','1',$str)) {
                // Store the data in cache
                if (!$cache->store($json, 'mod_lotto_latest_results_json')) {
                    // If storing in cache failed then we will return the error
                    $error = 'cache';
                }
            } else {
                $error = 'Could not retrieve';
            }
        }
$conf->setValue('config.cachetime', $origcachetime);
return $json;

}



function getlatestEuroResults(){



$shortcache = $this->params->get('shortcache') * 60;
$str = "draws=" . $this->params->get('EuroResultsDrawDays');

    
        // Get the config object from factory
        $conf =& JFactory::getConfig();
        // Get the current cachetime value
        $cachetime = $conf->getValue('config.cachetime');
        // Set the cache time 
        $conf->setValue('config.cachetime', $shortcache);
        // Get the Cache object
        $cache =& JFactory::getCache('mod_lotto_latest_results', 'output');
        // Enable caching (if disabled in global configuration)
        $cache->setCaching( 1 );
        // Try to get the results from cache


    if (!($json = $cache->get('mod_lotto_latest_results_euro_json'))) {
            $uri =& JFactory::getURI();
            
           
            if ($json = $this->place_request('LatestResults','3',$str)) {
                // Store the data in cache
                if (!$cache->store($json, 'mod_lotto_latest_results_euro_json')) {
                    // If storing in cache failed then we will return the error
                    $error = 'cache';
                }
            } else {
                $error = 'Could not retrieve';
            }
        }
$conf->setValue('config.cachetime', $origcachetime);
return $json;

}






function getlatestTBResults(){

$str = "draws=" . $this->params->get('TBResultsDrawDays');

    $shortcache = $this->params->get('shortcache') * 60;
        // Get the config object from factory
        $conf =& JFactory::getConfig();
        // Get the current cachetime value
        $origcachetime = $conf->getValue('config.cachetime');
        // Set the cache time to 8 hours i.e. 6 * 60 mins
        $conf->setValue('config.cachetime', $shortcache);
        // Get the Cache object
        $cache =& JFactory::getCache('mod_lotto_latest_results', 'output');
        // Enable caching (if disabled in global configuration)
        $cache->setCaching( 1 );
        // Try to get the results from cache


    if (!($json = $cache->get('mod_lotto_latest_results_tb_json'))) {
            $uri =& JFactory::getURI();
            
           
            if ($json = $this->place_request('LatestResults','2',$str)) {
                // Store the data in cache
                if (!$cache->store($json, 'mod_lotto_latest_results_tb_json')) {
                    // If storing in cache failed then we will return the error
                    $error = 'cache';
                }
            } else {
                $error = 'Could not retrieve';
            }
        }
$conf->setValue('config.cachetime', $origcachetime);

return $json;

}


function place_request($action,$game,$additional = null){

// Cache time is sent so that abuse can be detected and prevented.
// Site admin will be notified in first instance if they've left cache set at 0

 $shortcache = $this->params->get('shortcache');
 $longcache = $this->params->get('shortcache');

unset($this->result);
// Check whether we can use File or if we need to resort to Curl
if (ini_get('allow_url_fopen')){
$results = $this->placefilerequest($action,$game,$additional."&shortcache=$shortcache&longcache=$longcache");
}else{
$results = $this->placecurlrequest($action,$game,$additional."&shortcache=$shortcache&longcache=$longcache");

}


// Process the response
$X=0;
foreach ($results as $result){

$result = json_decode($result);

$key = "row$X";
$this->result->$key = $result;
$X++;
}




return $this->result;
}








function placefilerequest($action,$game,$additional = null){
$key = $this->getAPIKey();
$results = file("http://api.bentasker.co.uk/lottopredict/?game=$game&action=$action&key=$key&$additional");

return $results;
}


function placecurlrequest($action,$game,$additional){
$key = $this->getAPIKey();
 $ch = curl_init("http://api.bentasker.co.uk/lottopredict/?game=$game&action=$action&key=$key&$additional");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    $data = curl_exec($ch);
 
    curl_close($ch);
$data = explode("\n",$data);

return $data;
}


}
