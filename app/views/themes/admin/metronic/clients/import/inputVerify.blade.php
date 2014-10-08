<div id="container_top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="left"><h4>Client Import - Verify</h4></td>
    <td align="right"></td>
  </tr>
</table>
</div>

<br clear="all" />

<div class="container-fluid">

<div class="row-fluid">
	<div class="span7 well">
	<?php if ($csv['data']) { ?>
		{{Form::open(
			array(
					'action' => array('Clients\ClientsController@postProcessImportClientPerson'),
					'method' => 'POST',
					'role'=>'form',
				)
			)
		}}
	<?php 		
		echo 'Some information here blah blah';

		echo '<table width="100%" class="table">
		 <thead>
			<tr>
			  <th>Select column</th>
			  <th>Example data</th>
			</tr>
		  </thead><tbody>';
		  
		  $row_count = 0;
		  
		  foreach($csv['data'] as $row) {
		  
		  	echo '<tr>
					<td><select name="column['. $row_count .']">
					<option value="">Do not import / Unknown</option>
					<optgroup label="Client Details">
						<option value="title">Title</option>
						<option value="first_name">First name</option>
						<option value="last_name">Surname</option>
						<option value="job_title">Job title</option>
						<option value="dob">Date of birth</option>
						<option value="marital_status">Marital status</option>
					</optgroup>
					<optgroup label="Contact Details">
						<option value="telephone">Home telephone number</option>
						<option value="work_telephone">Work telephone number</option>
						<option value="mobile">Mobile telephone number</option>
						<option value="email">Email address</option>
						<option value="work_email">Work email address</option>					
					</optgroup>
					<optgroup label="Home Address Details">
						<option value="address_line_1">Address line 1</option>
						<option value="town">Town</option>
						<option value="county">County</option>
						<option value="postcode">Postcode</option>
					</optgroup>
					<optgroup label="Work Address Details">
						<option value="work_address_line_1">Address line 1</option>
						<option value="work_town">Town</option>
						<option value="work_county">County</option>
						<option value="work_postcode">Postcode</option>					
					</optgroup>
					<optgroup label="Partners Details">
						<option value="partner_title">Title</option>
						<option value="partner_first_name">First name</option>
						<option value="partner_last_name">Surname</option>
						<option value="partner_job_title">Job title</option>
						<option value="partner_dob">Date of birth</option>					
					</optgroup>
					<optgroup label="Company Client Details">
						<option value="company_name">Company name</option>
						<option value="companyreg">Company reg number</option>
						<option value="companyemployee">Number employees</option>
						<option value="sector">Business sector</option>
					</optgroup>
					<optgroup label="Extra Details">
						<option value="notes">Notes / History</option>
					</optgroup>					
					</select></td>
					<td>'. $row .'</td>
				  </tr>';
				  
			$row_count++;
		  
		  }		
		
		echo '</tbody></table>';
		echo '<input type="hidden" name="file" value="'. $csv['file'] .'" />';
		echo '<input type="hidden" name="columns" value="'. $csv['numcols'] .'" />';
		if ($csv['headers']) {
			echo '<input type="hidden" name="headers" value="1" />';
		} else {
			echo '<input type="hidden" name="headers" value="0" />';
		}
		echo '<p><button type="submit" class="btn">Continue</button></p><form>';	
	?>
	{{Form::close()}}
	<?php 
	} else {

	} 
	?>
    </div>   
    <div class="span5 well helpbox">
    <h5 style="margin-top:0px;">Importing Clients - Step 2</h5>
    <p></p>    
    </div>
</div>