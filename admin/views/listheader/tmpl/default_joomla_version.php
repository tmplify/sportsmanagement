<?php
/**
 * SportsManagement ein Programm zur Verwaltung für alle Sportarten
 * @version    1.0.05
 * @package    Sportsmanagement
 * @subpackage listheader
 * @file       default_joomla_version.php
 * @author     diddipoeler, stony, svdoldie und donclumsy (diddipoeler@gmx.de)
 * @copyright  Copyright: © 2013 Fussball in Europa http://fussballineuropa.de/ All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Language\Text;

if (version_compare(JSM_JVERSION, '4', 'eq'))
{
	echo $this->loadTemplate('joomla4');
	$no_items = 'alert alert-warning alert-no-items';
}
elseif (version_compare(JSM_JVERSION, '3', 'eq'))
{
	echo $this->loadTemplate('joomla3');
	$no_items = 'alert alert-no-items';
}

if ($this->items)
{
    switch ($this->view)
    {
    case 'projectteams':
    //case 'projectreferees':
    case 'templates':
    case 'treetos':
    break;
    default:    
	echo $this->loadTemplate('data');
    break;
    }
}
else
{
    switch ($this->view)
    {
        case 'updates':
        case 'databasetools':
        echo $this->loadTemplate('data');
        break;
        default:
        echo '<div class="' . $no_items . '">';
	    echo Text::_('JGLOBAL_NO_MATCHING_RESULTS');
	    echo '</div>';
        break;
    }
	
}

