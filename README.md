FOR PRIVACY AND CODE PROTECTING REASONS THIS IS A SIMPLIFIED VERSION OF CHANGES AND NEW FEATURES

TASK DATE: 13.03.2018 - FINISHED: 14.03.2017

TASK LEVEL: Medium (up)

TASK SHORT DESCRIPTION: 1424 [
								Option to hide the heart, and/or donate button, and/or donors list 
								from the campaign boxes on the Support Us page
							]
				
GITHUB REPOSITORY CODE: feature/task-1392-options-to-hide-on-support-us-page

CHANGES

ADDED NEW FILES

	common_fns.js
	support_us_lang.php
	support_us_buttons.php
	campaign_no_buttons.php
	campaign_no_donors.php
	campaign_no_hearts.php
	campaign_no_donors_no_buttons.php
	campaign_no_hearts_no_buttons.php
	campaign_no_hearts_no_donors.php
	campaign_no_hearts_no_donors_no_buttons.php
	campaign_no_values.php
	campaign_no_values_no_buttons.php
	campaign_no_values_no_donors.php
	campaign_no_values_no_hearts.php
	campaign_no_values_no_donors_no_buttons.php
	campaign_no_values_no_hearts_no_buttons.php
	campaign_no_values_no_hearts_no_donors.php
	campaign_no_values_no_hearts_no_donors_no_buttons.php	
	campaign_single.php
	campaign_single_no_buttons.php
	campaign_single_no_donors.php
	campaign_single_no_hearts.php
	campaign_single_no_donors_no_buttons.php
	campaign_single_no_hearts_no_buttons.php
	campaign_single_no_hearts_no_donors.php
	campaign_single_no_hearts_no_donors_no_buttons.php

CHANGES
 
	IN FILES: 
	
		supportus.css
		
			ADDED CODE: 
			
				.target-total {
				  margin-top: 10px;
				  font-weight: 700;
				   margin-bottom: 10px;
				}
		
		
		

		fundraising.php
	
			ADDED CODE inside function supportus
			
				//Determine which campaign partial view will be used
				$extraViewFileName = "";
				if ( Settings::get('support_us_target_values') == '0' ) $extraViewFileName .= "_no_values";
				if ( Settings::get('support_us_hearts') == '0' ) $extraViewFileName = "_no_hearts";
				if ( Settings::get('support_us_donors_list') == '0' ) $extraViewFileName .= "_no_donors";
				if ( Settings::get('support_us_donate_buttons') == '0' ) $extraViewFileName .= "_no_buttons";
				
				.....
				
				->set('extraViewFileName', $extraViewFileName)
				
				.....
				
				
	
		supportus.php
	
			CHANGED CODE: 
			
				I.  (in two places) 
				
					FROM: <?php $this->load->view('partials/campaign', array('campaign1'=>$campaign1))?>
					TO:  <?php $this->load->view('partials/campaign' . $extraViewFileName, array('campaign1'=>$campaign1))?>
					
				II.  
					FROM: <?php if ( ! empty($campaign->subscribers) ) { ?>
					TO: <?php if ( ! empty($campaign->subscribers) and (string)Settings::get('support_us_donors_list') == '1' ) { ?>

						
				III.  
					ADDED CODE: 
					
						<?php if ( (string)Settings::get('support_us_hearts') == '1' ) : ?>
						....
						<?php endif; ?> 
				
				IV.  
					ADDED CODE: 
					
						<?php if ( (string)Settings::get('support_us_donate_buttons') == '1' ) : ?>
						....
						<?php endif; ?> 
					
				V. CHANGED CODE: 
				
					FROM:  
						
						<?php  foreach ($campaigns as $campaign) : ?>
							 ..... THERE WAS A LOTS OF STUFFS HERE ... that content in file: campaign_single.orig
						<?php endforeach; ?>
					
					TO: 
					
						<?php  foreach ($campaigns as $campaign) : ?>
							 <?php $this->load->view('partials/campaign_single' . $extraViewFileName, array('campaign' => $campaign))?>
						<?php endforeach; ?>
				
	
	
	
		supportus_editor.js
		
			ADDED CODE:
			
				//Easy control for buttons to toggle "Hearts", "Donate Buttons" and "Donors list"
				if ($('.toggle-display-on-support-us-page')[0]) {
					$('.toggle-display-on-support-us-page').live('click', function(event) 
					{
						//avoiding multiple firing
						event.preventDefault();

						//set necessary stuffs
						var $this = $(this);
						var thisId = $this.prop('id');
						var btnSelector = '#' + thisId;
						var value = $this.prop('value');
						var slug = thisId.replace('btn_', '');

						//disable button
						COMMON.disableButton(btnSelector);
						
						//Set value in DB with AJAX
						AJAX.call('..........ajax_support_us_toggle', {'slug' : slug, 'value' : value}, function(response) {
							var res = $.parseJSON(response);
							if (res['result'] == true) {
								$this.html(res['btnLabel']);
								$this.parent().find('span.status-label').html(res['btnStatus']);
								if (res['value'] == '1') {
									COMMON.enableButton(btnSelector, 'btn-warning');
								} else {
									COMMON.enableButton(btnSelector, 'btn-success');
								}
								$this.val(res['value']);
							}

							//displaying result of updating
							$('#modal_block_header').html(res['header']);
							$('#modal_block_message').html(res['msg']);
							$('#myModal').modal('toggle');
						}) 
					})
				}


	
	supportus.php
		
			ADDED CODE:
			
			
				Inside section 'div class="section supportUs-section'
				
				....
					<div style="clear: both;"></div>
					<?=$buttons['hearts']?>
					<?=$buttons['donateButtons']?>
					<?=$buttons['donorsList']?>
					<?=$buttons['targetValues']?>
				.... 
				
				other ... to show modal
			
					<!-- BEGINNING MODAL -->
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title" id="modal_block_header"></h4>
								</div>
								<div class="modal-body">
									<p id="modal_block_message"></p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div><!-- END MODAL -->
				
				........
				
				
	
		content.php
		
			ADDED CODE 
			
				A new function 
				
					//Toggling buttons - set value of "Hearts", "Donors list" and "Donate buttons" value in default_settings table
					public function ajax_support_us_toggle() 
					{
						if ( ! $this->input->is_ajax_request() ) exit;
						
						$this->lang->load('network_settings/support_us');
						
						$slug = trim($this->input->post('slug'), " \r\n");
						
						$value = ( (string)$this->input->post('value') == '1' ) ? '0' : '1';
						
						$result = $this->db->set('value', $value)->where('slug', $slug)->update('settings');

						$switchEnabled = ($value == '1') ? lang('support_us:label:enabled') : lang('support_us:label:disabled');
						$section = str_replace('_', ' ', str_replace('support_us_', '', $slug));
						
						echo json_encode(array(
							'result' => $result,
							'value' => $value,
							'btnLabel' => ($value == '1') ? lang('support_us:label:disable') : lang('support_us:label:enable'),
							'btnStatus' => $switchEnabled,
							'header' => sprintf(lang('support_us:title:update_result'), $section),
							'msg' => sprintf(lang('support_us:msg:update_result'), ucfirst($section), $switchEnabled),
						));
					} //END function ajax_support_us_toggle
		
				Inside function supportus
				
					//Create html snippets for buttons which toggling "hearts", "donors list" and "donate buttons" on public support us page
					# NOTE : JS control for this buttons can be found here: network_settings/js/supportus_editor.js
					$buttons = array();
					$this->lang->load('network_settings/support_us');
					$enabled = lang('support_us:label:enabled'); 
					$disabled = lang('support_us:label:disabled'); 
					$enable = lang('support_us:label:enable'); 
					$disable = lang('support_us:label:disable'); 
					#Get button for "Hearts" toggling on (public) support us page 
					$buttonParams = ( (bool)Settings::get('support_us_hearts') ) 
											? array('value' => '1', 'btnStyle' => 'btn-warning', 'btnLabel' => $disable, 'typeId' => 'hearts', 'type' => 'hearts', 'btnStatus' => $enabled)
											: array('value' => '0', 'btnStyle' => 'btn-success', 'btnLabel' => $enable, 'typeId' => 'hearts', 'type' => 'hearts', 'btnStatus' => $disabled);
					$buttons['hearts'] = $this->load->view('content/partials/support_us_buttons', $buttonParams, true);
					#Get button for "Donate buttons" toggling on (public) support us page 
					$buttonParams = ( (bool)Settings::get('support_us_donate_buttons') ) 
											? array('value' => '1', 'btnStyle' => 'btn-warning', 'btnLabel' => $disable, 'typeId' => 'donate_buttons', 'type' => 'donate buttons', 'btnStatus' => $enabled)
											: array('value' => '0', 'btnStyle' => 'btn-success', 'btnLabel' => $enable, 'typeId' => 'donate_buttons', 'type' => 'donate buttons', 'btnStatus' => $disabled);
					$buttons['donateButtons'] = $this->load->view('content/partials/support_us_buttons', $buttonParams, true);
					#Get button for "Donate buttons" toggling on (public) support us page 
					$buttonParams = ( (bool)Settings::get('support_us_donors_list') ) 
											? array('value' => '1', 'btnStyle' => 'btn-warning', 'btnLabel' => $disable, 'typeId' => 'donors_list', 'type' => 'donors list', 'btnStatus' => $enabled)
											: array('value' => '0', 'btnStyle' => 'btn-success', 'btnLabel' => $enable, 'typeId' => 'donors_list', 'type' => 'donors list', 'btnStatus' => $disabled);
					$buttons['donorsList'] = $this->load->view('content/partials/support_us_buttons', $buttonParams, true);
					#Get button for "Target values" toggling on (public) support us page 
					$buttonParams = ( (bool)Settings::get('support_us_target_values') ) 
											? array('value' => '1', 'btnStyle' => 'btn-warning', 'btnLabel' => $disable, 'typeId' => 'target_values', 'type' => 'target values', 'btnStatus' => $enabled)
											: array('value' => '0', 'btnStyle' => 'btn-success', 'btnLabel' => $enable, 'typeId' => 'target_values', 'type' => 'target values', 'btnStatus' => $disabled);
					$buttons['targetValues'] = $this->load->view('content/partials/support_us_buttons', $buttonParams, true);
					..... 
					
					->set('buttons', $buttons)
					
					.....
					
				
	
		details.php
		
			ADDED CODE: 
			
				INSIDE FUNCTION upgrade
				
					 //add some records to default_settings table
					if (version_compare($old_version, '2.0.84', 'lt'))
					{
						$table = $this->db->dbprefix('settings');
						
						if ( ! $this->db->value_exists('support_us_hearts', 'slug', $table )) {
							$this->db->insert($table, array(
								'slug' => 'support_us_hearts',
								'title' => 'Display hearts',
								'description' => 'Display hearts on support us page',
								'`default`' => 1,
								'`value`' => '1',
								'type' => 'radio',
								'`options`' => '1=Enabled|0=Disabled',
								'is_required' => 0,
								'is_gui' => 1,
								'module' => 'network_settings',
							));
						}
						if ( ! $this->db->value_exists('support_us_donate_buttons', 'slug', $table )) {
							$this->db->insert($table, array(
								'slug' => 'support_us_donate_buttons',
								'title' => 'Display donate buttons',
								'description' => 'Display donate buttons on support us page',
								'`default`' => 1,
								'`value`' => '1',
								'type' => 'radio',
								'`options`' => '1=Enabled|0=Disabled',
								'is_required' => 0,
								'is_gui' => 1,
								'module' => 'network_settings',
							));
						}
						if ( ! $this->db->value_exists('support_us_donors_list', 'slug', $table )) {
							$this->db->insert($table, array(
								'slug' => 'support_us_donors_list',
								'title' => 'Display donors list',
								'description' => 'Display donors list on support us page',
								'`default`' => 1,
								'`value`' => '1',
								'type' => 'radio',
								'`options`' => '1=Enabled|0=Disabled',
								'is_required' => 0,
								'is_gui' => 1,
								'module' => 'network_settings',
							));
						}
						if ( ! $this->db->value_exists('support_us_target_values', 'slug', $table )) {
							$this->db->insert($table, array(
								'slug' => 'support_us_target_values',
								'title' => 'Display target values',
								'description' => 'Display target values on support us page',
								'`default`' => 1,
								'`value`' => '1',
								'type' => 'radio',
								'`options`' => '1=Enabled|0=Disabled',
								'is_required' => 0,
								'is_gui' => 1,
								'module' => 'network_settings',
							));
						}								
					}
				
				INSIDE Function install 
				
					array(
						'slug' => 'support_us_hearts',
						'title' => 'Display hearts',
						'description' => 'Display hearts on support us page',
						'`default`' => 1,
						'`value`' => '1',
						'type' => 'radio',
						'`options`' => '1=Enabled|0=Disabled',
						'is_required' => 0,
						'is_gui' => 1,
						'module' => 'network_settings',
					),
					array(
						'slug' => 'support_us_donate_buttons',
						'title' => 'Display donate buttons',
						'description' => 'Display donate buttons on support us page',
						'`default`' => 1,
						'`value`' => '1',
						'type' => 'radio',
						'`options`' => '1=Enabled|0=Disabled',
						'is_required' => 0,
						'is_gui' => 1,
						'module' => 'network_settings',
					),
					array(
						'slug' => 'support_us_donors_list',
						'title' => 'Display donors list',
						'description' => 'Display donors list on support us page',
						'`default`' => 1,
						'`value`' => '1',
						'type' => 'radio',
						'`options`' => '1=Enabled|0=Disabled',
						'is_required' => 0,
						'is_gui' => 1,
						'module' => 'network_settings',
					),
					array(
						'slug' => 'support_us_target_values',
						'title' => 'Display target values',
						'description' => 'Display target values on support us page',
						'`default`' => 1,
						'`value`' => '1',
						'type' => 'radio',
						'`options`' => '1=Enabled|0=Disabled',
						'is_required' => 0,
						'is_gui' => 1,
						'module' => 'network_settings',
					),
				
				
				
	
		asset.php
		
			ADDED CODE: 
			
				$add_library(array(
					'js' => array('_commons/common_fns.js')
				));
