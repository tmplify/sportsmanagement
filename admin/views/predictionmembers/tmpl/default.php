<?php 
/** SportsManagement ein Programm zur Verwaltung für alle Sportarten
* @version         1.0.05
* @file                agegroup.php
* @author                diddipoeler, stony, svdoldie und donclumsy (diddipoeler@arcor.de)
* @copyright        Copyright: © 2013 Fussball in Europa http://fussballineuropa.de/ All rights reserved.
* @license                This file is part of SportsManagement.
*
* SportsManagement is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* SportsManagement is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with SportsManagement.  If not, see <http://www.gnu.org/licenses/>.
*
* Diese Datei ist Teil von SportsManagement.
*
* SportsManagement ist Freie Software: Sie können es unter den Bedingungen
* der GNU General Public License, wie von der Free Software Foundation,
* Version 3 der Lizenz oder (nach Ihrer Wahl) jeder späteren
* veröffentlichten Version, weiterverbreiten und/oder modifizieren.
*
* SportsManagement wird in der Hoffnung, dass es nützlich sein wird, aber
* OHNE JEDE GEWÄHELEISTUNG, bereitgestellt; sogar ohne die implizite
* Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
* Siehe die GNU General Public License für weitere Details.
*
* Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
* Programm erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
*
* Note : All ini files need to be saved as UTF-8 without BOM
*/

defined('_JEXEC') or die('Restricted access');

//Ordering allowed ?
$ordering = ( $this->lists['order'] == 'pre.ordering' );

JHtml::_( 'behavior.tooltip' );
?>
<form action="<?php echo $this->request_url; ?>" method="post" id="adminForm" name="adminForm">
	<table>
		<tr>
			<td align="left" width="100%">
				<?php
				echo JText::_( 'JSEARCH_FILTER_LABEL' ); ?>: <input   type="text" name="search" id="search"
														value="<?php echo $this->lists['search'];?>" class="text_area"
														onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();">
					<?php
					echo JText::_( 'JSEARCH_FILTER_SUBMIT' );
					?>
				</button>
				<button onclick="document.getElementById('search').value='';this.form.submit();">
					<?php
					echo JText::_( 'JSEARCH_FILTER_CLEAR' );
					?>
				</button>
			</td>
			<td nowrap='nowrap' align='right'>
				<?php
				echo $this->lists['predictions'] . '&nbsp;&nbsp;';
				?>
			</td>
			<td nowrap='nowrap'>
				<?php
				echo $this->lists['state'];
				?>
			</td>
		</tr>
	</table>
	<div id="editcell">
		<table class="adminlist">
			<thead>
				<tr>
					<th width="5">
						<?php
						echo JText::_( 'COM_SPORTSMANAGEMENT_GLOBAL_NUM' );
						?>
					</th>
					<th width="20">
						<input  type="checkbox" name="toggle" value=""
								onclick="checkAll(<?php echo count( $this->items ); ?>);" />
					</th>
					<th class="title" nowrap="nowrap">
						<?php
						echo JHtml::_( 'grid.sort',  JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_USERNAME' ), 'u.username', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
					<th class="title" nowrap="nowrap">
						<?php
						echo JHtml::_( 'grid.sort',  JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_REAL_NAME' ), 'u.name', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
					<th class="title" nowrap="nowrap">
						<?php
						echo JHtml::_( 'grid.sort', JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_PRED_NAME' ), 'p.name', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
					<th class="title" nowrap="nowrap">
						<?php
						echo JHtml::_( 'grid.sort', JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_DATE_LAST_TIP' ), 'tmb.last_tipp', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
					<th class="title">
						<?php
						echo JHtml::_( 'grid.sort', JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_SEND_REMINDER' ), 'tmb.reminder', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
					<th class="title">
						<?php
						echo JHtml::_( 'grid.sort', JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_RECEIPT' ), 'tmb.receipt', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
					<th class="title">
						<?php
						echo JHtml::_( 'grid.sort', JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_PROFILE' ), 'tmb.show_profile', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
					<th class="title">
						<?php
						echo JHtml::_( 'grid.sort', JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_ADMIN_TIP' ), 'tmb.admintipp', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
					<th width="1%">
						<?php
						echo JHtml::_( 'grid.sort', JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_APPROVED' ), 'tmb.approved', $this->lists['order_Dir'], $this->lists['order'] );
						?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan='11'>
						<?php
						echo $this->pagination->getListFooter();
						?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php
      if ( isset($this->items) )
      {
			$k = 0;
			for ( $i = 0, $n = count( $this->items ); $i < $n; $i++ )
			{
				$row =& $this->items[$i];

				$link	= JRoute::_( 'index.php?option=com_joomleague&task=prediction.edit&cid[]=' . $row->id );
				//$link2	= JRoute::_( 'index.php?option=com_users&view=user&layout=edit&cid[]=' . $row->user_id );
                $link2	= JRoute::_( 'index.php?option=com_sportsmanagement&task=predictionmember.edit&cid[]=' . $row->id );

				$checked = JHtml::_( 'grid.checkedout', $row, $i );
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td>
						<?php
						echo $this->pagination->getRowOffset( $i );
						?>
					</td>
					<td>
						<?php
						echo $checked;
						?>
					</td>
					<td>
						<?php
						#if ( JTable::isCheckedOut($this->user->get( 'id' ), $row->checked_out ) )
						#{
						#	echo $row->username;
						#}
						#else
						{
						?>
							<a  href="<?php echo $link2; ?>"
								title="<?php echo JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_EDIT_USER' ); ?>" >
								<?php
								echo $row->username;
								?>
							</a>
							<?php
						}
						?>
					</td>
					<td>
						<?php
						#if ( JTable::isCheckedOut($this->user->get( 'id' ), $row->checked_out ) )
						#{
						#	echo $row->realname;
						#}
						#else
						{
						?>
							<?php /* ?>
							<a  href="<?php echo $link; ?>"
								title="<?php echo JText::_( 'Edit JoomLeague-Prediction User' ); ?>">
							<?php */ ?>
								<?php
								echo $row->realname;
								?>
							<?php /* ?>
							</a>
							<?php */ ?>
							<?php
						}
						?>
					</td>
					<td nowrap='nowrap'>
						<?php
						echo $row->predictionname;
						?>
					</td>
					<td style='text-align: center; '>
						<?php
						if ( isset( $row->last_tipp ) )
						{
							list( $date, $time ) = explode( " ", $row->last_tipp );
							$time = strftime( "%H:%M", strtotime( $time ) );
							echo JoomleagueHelper::convertDate( $date );
							echo ' / ';
							echo $time;
						}
						else
						{
							echo JText::_( 'COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_NEVER_TIPPED' );
						}
						?>
					</td>
					<td style='text-align: center; '>
						<?php
						if ($row->reminder){$imgfile='ok.png';$imgtitle=JText::_('Active');}else{$imgfile='delete.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_INACTIVE');}
						echo JHtml::_(	'image', 'administrator/components/com_joomleague/assets/images/' . $imgfile,
										$imgtitle, 'title= "' . $imgtitle . '"' );
						?>
					</td>
					<td style='text-align: center; '>
						<?php
						if ($row->receipt){$imgfile='ok.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_ACTIVE');}else{$imgfile='delete.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_INACTIVE');}
						echo JHtml::_(	'image', 'administrator/components/com_joomleague/assets/images/' . $imgfile,
										$imgtitle, 'title= "' . $imgtitle . '"' );
						?>
					</td>
					<td style='text-align: center; '>
						<?php
						if ($row->show_profile){$imgfile='ok.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_ALLOWED');}else{$imgfile='delete.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_NOT_ALLOWED');}
						echo JHtml::image(	'administrator/components/com_joomleague/assets/images/' . $imgfile,
											$imgtitle, 'title= "' . $imgtitle . '"' );
						?>
					</td>
					<td style='text-align: center; '>
						<?php
						if ($row->admintipp){$imgfile='ok.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_ACTIVE');}else{$imgfile='delete.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_INACTIVE');}
						echo JHtml::_(	'image', 'administrator/components/com_joomleague/assets/images/' . $imgfile,
										$imgtitle, 'title= "' . $imgtitle . '"' );
						?>
					</td>
					<td style='text-align: center; '>
						<?php
						if ($row->approved){$imgfile='ok.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_APPROVED');}else{$imgfile='delete.png';$imgtitle=JText::_('COM_SPORTSMANAGEMENT_ADMIN_PMEMBERS_NOT_APPROVED');}
						echo JHtml::_(	'image', 'administrator/components/com_joomleague/assets/images/' . $imgfile,
										$imgtitle, 'title= "' . $imgtitle . '"' );
						?>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
      }
			?>
			</tbody>
		</table>
	</div>

	
	
  
	<input type="hidden" name="boxchecked"			value="0" />
	<input type="hidden" name="filter_order"		value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir"	value="" />
	<?php echo JHtml::_( 'form.token' ); ?>
</form>
