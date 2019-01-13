<?php
/** SportsManagement ein Programm zur Verwaltung für alle Sportarten
 * @version   1.0.05
 * @file      default_4.php
 * @author    diddipoeler, stony, svdoldie und donclumsy (diddipoeler@gmx.de)
 * @copyright Copyright: © 2013 Fussball in Europa http://fussballineuropa.de/ All rights reserved.
 * @license   This file is part of SportsManagement.
 * @package   sportsmanagement
 * @subpackage specialextensions
 */
 
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Language\Text;
$templatesToLoad = array('footer', 'listheader');
sportsmanagementHelper::addTemplatePaths($templatesToLoad, $this);
?>
<div class="row">
    <?php if (!empty($this->sidebar)) : ?>
        <div id="j-sidebar-container" class="col-md-2">
            <?php echo $this->sidebar; ?>
        </div>
        <div class="col-md-8">
        <?php else : ?>
            <div class="col-md-10">
            <?php endif; ?>      
            <div id="dashboard-iconss" class="dashboard-icons">
                <?php
                foreach ($this->Extensions as $key => $value) {
                    $logo = "components/com_sportsmanagement/assets/icons/" . Text::_($value) . '.png';
                    if (!file_exists($logo)) {
                        $logo = JURI::root() . 'images/com_sportsmanagement/database/placeholders/placeholder_150.png';
                    }
                    ?>
                    <a class="btn btn-jsm-dash" href="index.php?option=com_sportsmanagement&view=<?php echo Text::_($value) ?>">
                        <img src="<?php echo $logo ?>" width="125" alt="<?php echo Text::_($value) ?>" /><br />
                        <span><?php echo Text::_($value) ?></span>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-2">
            <?php sportsmanagementHelper::jsminfo(); ?>
        </div>
    </div>
</div>                
<?PHP
echo "<div>";
echo $this->loadTemplate('footer');
echo "</div>";
?>   