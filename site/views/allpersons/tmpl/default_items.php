<?php 
/** Joomla Sports Management ein Programm zur Verwaltung f�r alle Sportarten
* @version 1.0.26
* @file components/sportsmanagement/views/allpersons/tmpl/default_items.php
* @author diddipoeler, stony, svdoldie und donclumsy (diddipoeler@arcor.de)
* @copyright Copyright: � 2013 Fussball in Europa http://fussballineuropa.de/ All rights reserved.
* @license This file is part of Joomla Sports Management.
*
* Joomla Sports Management is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Joomla Sports Management is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Joomla Sports Management. If not, see <http://www.gnu.org/licenses/>.
*
* Diese Datei ist Teil von Joomla Sports Management.
*
* Joomla Sports Management ist Freie Software: Sie k�nnen es unter den Bedingungen
* der GNU General Public License, wie von der Free Software Foundation,
* Version 3 der Lizenz oder (nach Ihrer Wahl) jeder sp�teren
* ver�ffentlichten Version, weiterverbreiten und/oder modifizieren.
*
* Joomla Sports Management wird in der Hoffnung, dass es n�tzlich sein wird, aber
* OHNE JEDE GEW�HRLEISTUNG, bereitgestellt; sogar ohne die implizite
* Gew�hrleistung der MARKTF�HIGKEIT oder EIGNUNG F�R EINEN BESTIMMTEN ZWECK.
* Siehe die GNU General Public License f�r weitere Details.
*
* Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
* Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
*
* Note : All ini files need to be saved as UTF-8 without BOM
*/

defined('_JEXEC') or die('Restricted access');

//echo '<pre>'.print_r($this->items,true).'</pre>';

?>
        
<table width="100%">

<thead>
<tr>
<th class="" id="">
<?php  echo JHtml::_('grid.sort', 'COM_SPORTSMANAGEMENT_EDIT_PERSON_LAST_NAME', 'v.lastname', $this->sortDirection, $this->sortColumn) ; ?>
</th>
<th class="" id="">
<?php  echo JHtml::_('grid.sort', 'COM_SPORTSMANAGEMENT_EDIT_PERSON_FIRST_NAME', 'v.firstname', $this->sortDirection, $this->sortColumn) ; ?>
</th>
<th class="" id="">
<?php echo JHtml::_('grid.sort', 'Bild', 'v.picture', $this->sortDirection, $this->sortColumn); ?>
</th>
<th class="" id="">
<?php echo JHtml::_('grid.sort', 'COM_SPORTSMANAGEMENT_EDIT_CLUBINFO_INTERNET', 'v.website', $this->sortDirection, $this->sortColumn); ?>
</th> 
<th class="" id="">
<?php echo JHtml::_('grid.sort', 'COM_SPORTSMANAGEMENT_EDIT_CLUBINFO_ADDRESS', 'v.address', $this->sortDirection, $this->sortColumn); ?>
</th> 
<th class="" id="">
<?php echo JHtml::_('grid.sort', 'COM_SPORTSMANAGEMENT_EDIT_CLUBINFO_POSTAL_CODE', 'v.zipcode', $this->sortDirection, $this->sortColumn); ?>
</th> 
<th class="" id="">
<?php echo JHtml::_('grid.sort', 'COM_SPORTSMANAGEMENT_EDIT_CLUBINFO_TOWN', 'v.location', $this->sortDirection, $this->sortColumn); ?>
</th>                 
<th class="" id="">
<?php echo JHtml::_('grid.sort', 'COM_SPORTSMANAGEMENT_EDIT_CLUBINFO_COUNTRY', 'v.country', $this->sortDirection, $this->sortColumn); ?>
</th>                                 
                
	</tr>
		</thead>




<?php foreach ($this->items as $i => $item) : ?>
<tr class="row<?php echo $i % 2; ?>">
<td>
<?php 
if ( $item->projectslug )
{
$link = sportsmanagementHelperRoute::getPlayerRoute( $item->projectslug, $item->teamslug, $item->slug );
echo JHtml::link( $link, $item->lastname );
}
else
{
echo $item->lastname;    
}
?>
</td>
<td>
<?php echo $item->firstname; ?>
</td>
<td>
<a href="<?php echo $item->picture;?>" title="<?php echo $item->lastname;?>" class="modal">
<img src="<?php echo $item->picture;?>" alt="<?php echo $item->lastname;?>" width="20" />
</a>  

</td>
<td>
<?php echo JHtml::link( $item->website, $item->website, array( 'target' => '_blank' ) ); ?>
</td>
<td>
<?php echo $item->address; ?>
</td>
<td>
<?php echo $item->zipcode; ?>
</td>
<td>
<?php echo $item->location; ?>
</td>
<td>
<?php echo JSMCountries::getCountryFlag($item->country); ?>
</td>
</tr>
<?php endforeach; ?>
</table>


<div class="pagination">
	<p class="counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>