<?php
/**
 * TestLink Open Source Project - http://testlink.sourceforge.net/
 * This script is distributed under the GNU General Public License 2 or later.
 *
 */

require_once(TL_ABS_PATH . '/lib/functions/tlPlugin.class.php');

/**
 * Testlink Plugin class that registers itself with the system and provides 
 * UI hooks for NavBar to display a text or png banner
 * 
 * $tlCfg->navbar_height should be defined in custom_config_inc.php 
 * to define the navbar height needed to display the banner.
 *
 * Class TestLinkBannerPlugin
 */
class TestLinkBannerPlugin extends TestlinkPlugin
{
  function _construct()
  {

  }

  function register()
  {
    $this->name = 'TestLinkBanner';
    $this->description = 'TestLink Banner' ;
    //$this->description = plugin_lang_get( 'description' ) ; 

    $this->version = '1.0';

    $this->author = 'Bob Le Bricodeur';
    $this->url = 'https://github.com/MrBricodage';
  }

  function config()
  {
	return array( //accessible via plugin_config_get( 'nom_variable' );
			'use_image' => true,
	);
  }

  function hooks()
  {
    $hooks = array(
	  'EVENT_TITLE_BAR' => 'displayBanner'
    );
    return $hooks;
  }

	function displayBanner() {
		if( plugin_config_get( 'use_image' ) === true ){
			$t_banner_path = 'plugins' . DIRECTORY_SEPARATOR . plugin_get_current() . DIRECTORY_SEPARATOR . 'pages/banner.png' ;
			return ("<img src=". $t_banner_path . " >");
		}
		else{
			return ( "<div class='messages_rounded blocked' style='width: 60%;'>".plugin_lang_get( 'banner_text' ) . "</div>");
		}
	}

}
