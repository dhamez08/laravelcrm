<div class="col-md-12">
<?php if (!$vmd) {

       echo '<div class="row-fluid">
          <div class="span12">
            <div class="alert alert-error">No View My Documents provider account has been setup. Please contact our support department.</div>
			</div>
			</div>';

} else {

if ($account['vmd']=="") {

       echo '<div class="row-fluid">
          <div class="span12">
            <div class="alert alert-error">';
			
			if ($customer_details['postcode']!="") {
				echo 'No \'View my Documents\' account setup for this client. To enable this service, simply <a href="'.url('clients/view-my-documents-activate?id='.$clientId.'&enable=yes').'">click here to activate</a>.';
			} else {
				echo 'No \'View my Documents\' account setup for this client. Before you can enable this service, please ensure you have entered the full address including postcode.';
			}
						
			echo '</div>
		</div>
        </div>';			
		} else { //print_r($account);?>
        <div class="row-fluid">
          <div class="span6 well"><h5 style="margin-top:0px;">Client Account Settings</h5>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td width="20%">Status:</td>
                <td>Active <small>(<a href="<?php echo url(); ?>/clients/view-my-documents-unlink?id=<?php echo $clientId; ?>&enable=no">unlink client</a>)</small></td>
              </tr>
              <tr>
                <td width="20%">PIN:</td>
                <td><?php echo $account['vmd_pin']; /* ?> <small>(<a href="<?php echo base_url(); ?>">request new pin</a>)</small><?php */ ?></td>
              </tr>
            </table>
          </div>
        </div>         
            
        <div class="row-fluid">
          <div class="span12 well"><h5 style="margin-top:0px;">Documents Shared with Client</h5>
          <?php if ($shared) {
		  	
			echo '<table class="table">';
		  
		  		foreach($shared as $shared_file) {
				
					echo '<tr>
					<td width="70%"><a href="'.$shared_file['url'] .'" target="_blank">'. $shared_file['name'] .'</a>';
					
					if ($shared_file['notes']!="") {
						echo '<em> - '. $shared_file['notes'] .'</em>';				
					}
					
					echo '</td>
					<td width="15%" style="text-align:center;">'. date("d/m/y H:i", strtotime($shared_file['time'])) .'</td>
					<td align="center" style="text-align:center;"><a href="'.$shared_file['url'] .'" target="_blank">View Document</a>';
					
					//&nbsp;|&nbsp;<a href="#" target="_self" onClick="return confirm(\'Are you sure you wish to unshare this document with the client?\')">Unshare</a>
					
					echo '</td>
					</tr>';
				
				}
		  
		  	echo '</table>';
		  
		  } else {		  	
			echo 'No files/documents have been shared with the client.';
		  } ?>
          </div>
        </div>      
        <div class="row-fluid">
          <div class="span12 well"><h5 style="margin-top:0px;">Documents Uploaded by Client</h5>
          <?php if ($uploaded) { 
		  
			echo '<table class="table">';
		  
		  		foreach($uploaded as $uploaded_file) {
				
					echo '<tr>
					<td width="70%"><a href="'.$uploaded_file['url'] .'" target="_blank">'. $uploaded_file['name'] .'</a>';
					
					if ($uploaded_file['notes']!="") {
						echo '<em> - '. $uploaded_file['notes'] .'</em>';				
					}
					
					echo '</td>
					<td width="15%" style="text-align:center;">'. date("d/m/y H:i", strtotime($uploaded_file['time'])) .'</td>
					<td align="center" style="text-align:center;"><a href="'. $uploaded_file['url'] .'" target="_blank">View Document</a>';
					/*&nbsp;|&nbsp;<a href="'.base_url().'clients/view_my_documents_unshare?id='.$this->input->get('id').'&file='.$uploaded_file['id'].'&user='.$account['id'].'&type=uploaded" target="_self" onClick="return confirm(\'Are you sure you wish to delete this document uploaded by the client?\')">Unshare</a>
					*/
					echo '</td>
					</tr>';
				
				}
		  
		  	echo '</table>';
		  
		  } else {		  	
			echo 'The client has not uploaded any files/documents.';
		  } ?>
          </div>
        </div>
		<?php } 
		} ?>
</div>

@section('script-footer')
	@parent
		@section('footer-custom-js')
			@parent
		@stop
@stop
