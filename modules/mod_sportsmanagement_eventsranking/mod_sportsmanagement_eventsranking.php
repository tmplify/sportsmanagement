<?php
/** SportsManagement ein Programm zur Verwaltung f�r alle Sportarten
 * @version   1.0.05
 * @file      mod_sportsmanagement_eventsranking.php
 * @author    diddipoeler, stony, svdoldie und donclumsy (diddipoeler@gmx.de)
 * @copyright Copyright: � 2013 Fussball in Europa http://fussballineuropa.de/ All rights reserved.
 * @license   This file is part of SportsManagement.
 * @package   sportsmanagement
 * @subpackage mod_sportsmanagement_eventsranking
 */

// No direct access
defined('_JEXEC') or die;

if (! defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}

if ( !defined('JSM_PATH') )
{
DEFINE( 'JSM_PATH','components/com_sportsmanagement' );
}

if ( !class_exists('sportsmanagementHelper') ) 
{
//add the classes for handling
$classpath = JPATH_ADMINISTRATOR.DS.JSM_PATH.DS.'helpers'.DS.'sportsmanagement.php';
JLoader::register('sportsmanagementHelper', $classpath);
JModelLegacy::getInstance("sportsmanagementHelper", "sportsmanagementModel");
}

if (! defined('COM_SPORTSMANAGEMENT_SHOW_DEBUG_INFO'))
{
DEFINE( 'COM_SPORTSMANAGEMENT_SHOW_DEBUG_INFO',JComponentHelper::getParams('com_sportsmanagement')->get( 'show_debug_info' ) );
}
if (! defined('COM_SPORTSMANAGEMENT_SHOW_QUERY_DEBUG_INFO'))
{
DEFINE( 'COM_SPORTSMANAGEMENT_SHOW_QUERY_DEBUG_INFO',JComponentHelper::getParams('com_sportsmanagement')->get( 'show_query_debug_info' ) );
}

require_once(JPATH_ADMINISTRATOR.DS.JSM_PATH.DS.'libraries'.DS.'sportsmanagement'.DS.'model.php');

/**
 * die �bersetzungen laden
 */
$language = JFactory::getLanguage();
$language->load('com_sportsmanagement', JPATH_ADMINISTRATOR, null, true);

// Reference global application object
$app = JFactory::getApplication();

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$list = modSMEventsrankingHelper::getData($params);

$document = JFactory::getDocument();
//add css file
$document->addStyleSheet(JURI::base().'modules'.DS.$module->module.DS.'css'.DS.$module->module.'.css');

//Layout
require JModuleHelper::getLayoutPath('mod_sportsmanagement_eventsranking');

