<?php
/**
 * @copyright	Copyright (C) 2013 fussballineuropa.de. All rights reserved.
 * @license		GNU/GPL,see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License,and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
jimport('joomla.html.parameter.element.timezones');

require_once(JPATH_COMPONENT.DS.'models'.DS.'sportstypes.php');
require_once(JPATH_COMPONENT.DS.'models'.DS.'leagues.php');

/**
 * HTML View class for the Sportsmanagement Component
 *
 * @static
 * @package	Sportsmanagement
 * @since	0.1
 */
class sportsmanagementViewProject extends JView
{
	function display($tpl=null)
	{
		$option = JRequest::getCmd('option');
		$mainframe = JFactory::getApplication();
		$uri = JFactory::getURI();
		$user = JFactory::getUser();
        
        if ($this->getLayout() == 'panel')
		{
			$this->_displayPanel($tpl);
			return;
		}
        

		// get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');
		$script = $this->get('Script');
 
		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->form = $form;
		$this->item = $item;
		$this->script = $script;
        $extended = sportsmanagementHelper::getExtended($project->extended, 'project');		
		$this->assignRef( 'extended', $extended );
        $this->assign('cfg_which_media_tool', JComponentHelper::getParams($option)->get('cfg_which_media_tool',0) );
 
		// Set the toolbar
		$this->addToolBar();
 
		// Display the template
		parent::display($tpl);
 
		// Set the document
		$this->setDocument();
	}
	
	
    // display control panel
	function _displayPanel($tpl)
	{
	$option = JRequest::getCmd('option');
	$mainframe = JFactory::getApplication();
	$uri = JFactory::getURI();
	$user = JFactory::getUser();
           
	$this->project = $this->get('Item');
       
	$iProjectDivisionsCount = 0;
	$mdlProjectDivisions = JModel::getInstance("divisions", "sportsmanagementModel");
	$iProjectDivisionsCount = $mdlProjectDivisions->getProjectDivisionsCount($this->project->id);
		
	$iProjectPositionsCount = 0;
	$mdlProjectPositions = JModel::getInstance("Projectpositions", "sportsmanagementModel");
	$iProjectPositionsCount = $mdlProjectPositions->getProjectPositionsCount($this->project->id);
		
	$iProjectRefereesCount = 0;
	$mdlProjectReferees = JModel::getInstance("Projectreferees", "sportsmanagementModel");
	$iProjectRefereesCount = $mdlProjectReferees->getProjectRefereesCount($this->project->id);
		
	$iProjectTeamsCount = 0;
	$mdlProjecteams = JModel::getInstance("Projectteams", "sportsmanagementModel");
	$iProjectTeamsCount = $mdlProjecteams->getProjectTeamsCount($this->project->id);
		
	$iMatchDaysCount = 0;
	$mdlRounds = JModel::getInstance("Rounds", "sportsmanagementModel");
	$iMatchDaysCount = $mdlRounds->getRoundsCount($this->project->id);
		
	$this->assignRef('project',$this->project);
	$this->assignRef('count_projectdivisions',$iProjectDivisionsCount);
	$this->assignRef('count_projectpositions',$iProjectPositionsCount);
	$this->assignRef('count_projectreferees', $iProjectRefereesCount);
	$this->assignRef('count_projectteams', $iProjectTeamsCount );
	$this->assignRef('count_matchdays', $iMatchDaysCount);  
    
    // store the variable that we would like to keep for next time
    // function syntax is setUserState( $key, $value );
    $mainframe->setUserState( "$option.pid", $this->project->id); 
       
    parent::display($tpl);   
    }
       
    /**
	* Add the page title and toolbar.
	*
	* @since	1.7
	*/
	protected function addToolbar()
	{
	   $option = JRequest::getCmd('option');
		$mainframe = JFactory::getApplication();
    // store the variable that we would like to keep for next time
    // function syntax is setUserState( $key, $value );
    $mainframe->setUserState( "$option.pid", $this->project->id);
		// Set toolbar items for the page
		if ($this->copy)
		{
			$toolbarTitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PROJECT_COPY_PROJECT');
		}
		else
		{
			$toolbarTitle=(!$this->edit) ? JText::_('COM_SPORTSMANAGEMENT_ADMIN_PROJECT_ADD_NEW') : JText::_('COM_SPORTSMANAGEMENT_ADMIN_PROJECT_EDIT');
			JToolBarHelper::divider();
		}
		JToolBarHelper::title($toolbarTitle,'ProjectSettings');
		
		if (!$this->copy)
		{
			JToolBarHelper::apply('project.apply');
			JToolBarHelper::save('project.save');
		}
		else
		{
			JToolBarHelper::save('project.copysave');
		}
		JToolBarHelper::divider();
		if ((!$this->edit) || ($this->copy))
		{
			JToolBarHelper::cancel('project.cancel');
		}
		else
		{
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel('project.cancel',JText::_('COM_SPORTSMANAGEMENT_GLOBAL_CLOSE'));
		}
		sportsmanagementHelper::ToolbarButtonOnlineHelp();
	}
    
    /**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_SPORTSMANAGEMENT_ADMINISTRATION'));
	}
    
}
?>
