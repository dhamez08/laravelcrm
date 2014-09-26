<?php
return array(
	'themes' => array(
		'admin' => array(
			'name' 		=> 'Metronic',
			'folder' 	=> 'metronic',
			'path' 		=> 'themes.admin.metronic',
		),
	),
	'permissions' => array(
		'Client - Edit Details' => 'client_edit',
		'Client - Delete' => 'client_delete',
		'Client - Notes' => 'client_notes',
		'Client - Files' => 'client_files',
		'Client - Opportunities' => 'client_opportunities',
	),
	'settings' => array(
		'customFields' => array(
			'clientTabs' => array(
				'files_tab'			=>	'Files Tab',
				'messages_tab'		=>	'Messages Tab',
				'people_tab'		=>	'People Tab(shown on company only',
				'opportunities_tab'	=>	'Opportunities Tab',
				'live_tab'			=>	'Live Documents Tab'
			),
			'clientFiles' => array(
				array(
					'label_name'	=>	'Section 1 Name:',
					'form_name'		=>	'section1',
					'field_name'	=>	'files_1',
					'placeholder'	=>	'Enter a name for section 1',
					'readonly'		=>	1
				),
				array(
					'label_name'	=>	'Section 2 Name:',
					'form_name'		=>	'section2',
					'field_name'	=>	'files_2',
					'placeholder'	=>	'Enter a name for section 2',
					'readonly'		=>	0
				),
				array(
					'label_name'	=>	'Section 3 Name:',
					'form_name'		=>	'section3',
					'field_name'	=>	'files_3',
					'placeholder'	=>	'Enter a name for section 3',
					'readonly'		=>	0
				),
				array(
					'label_name'	=>	'Section 4 Name:',
					'form_name'		=>	'section4',
					'field_name'	=>	'files_4',
					'placeholder'	=>	'Enter a name for section 4',
					'readonly'		=>	0
				),
				array(
					'label_name'	=>	'Section 5 Name:',
					'form_name'		=>	'section5',
					'field_name'	=>	'files_5',
					'placeholder'	=>	'Enter a name for section 5',
					'readonly'		=>	0
				),
				array(
					'label_name'	=>	'Section 6 Name:',
					'form_name'		=>	'section6',
					'field_name'	=>	'files_6',
					'placeholder'	=>	'Enter a name for section 6',
					'readonly'		=>	0
				),
			)
		)
	),
	'person_title' => array(
		'Mr'=>'Mr',
		'Mrs'=>'Mrs',
		'Miss'=>'Miss',
		'Ms'=>'Ms',
		'Dr'=>'Dr',
	),
	'marital_status' => array(
		''=>'Select',
		'Married'=>'Married',
		'Single'=>'Single',
		'Widowed'=>'Widowed',
		'Seperated'=>'Seperated',
		'Divorced'=>'Divorced',
		'Co-habiting'=>'Co-habiting',
		'Living together'=>'Living together',
	),
	'living_status' => array(
		'Owner - Outright'=>'Owner - Outright',
		'Owner - Mortgage'=>'Owner - Mortgage',
		'Rented'=>'Rented',
		'Living With Parents'=>'Living With Parents',
	),
	'employment_status' => array(
		'Employed - Full Time'=>'Employed - Full Time',
		'Employed - Part Time'=>'Employed - Part Time',
		'Self-Employed'=>'Self-Employed',
		'Retired'=>'Retired',
		'Unemployed'=>'Unemployed',
		'House Person'=>'House Person',
	),
	'phone_for' => array(
		'Home'=>'Home',
		'Work'=>'Work',
		'Direct'=>'Direct',
		'Mobile'=>'Mobile',
		'Fax'=>'Fax',
	),
	'email_for' => array(
		'Home'=>'Home',
		'Work'=>'Work',
	),
	'website_for' => array(
		'Website'=>'Website',
		'Twitter'=>'Twitter',
		'Skype'=>'Skype',
		'Xing'=>'Xing',
		'Google+'=>'Google+',
		'Facebook'=>'Facebook',
		'YouTube'=>'YouTube',
		'GitHub'=>'GitHub',
		'LinkedIn'=>'LinkedIn',
		'Blog'=>'Blog',
	),
	'website_is' => array(
		'Personal'=>'Personal',
		'Work'=>'Work',
	),
	'relationship_to_client' => array(
		'0' => 'Please Select',
		'Son' => 'Son',
		'Daughter' => 'Daughter',
	),
	'address_type' => array(
		'Home'=>'Home',
		'Work'=>'Work'
	),
	'opportunity_milestone' => array(
		'Suspect' => 'Suspect',
		'Prospect' => 'Prospect',
		'Champion' => 'Champion',
		'Opportunity' => 'Opportunity',
		'Proposal' => 'Proposal',
		'Verbal' => 'Verbal',
		'Lost' => 'Lost',
		'Won' => 'Won'
	),
	'opportunity_probability' => array(
		'10' => '10%',
		'20' => '20%',
		'25' => '25%',
		'30' => '30%',
		'50' => '50%',
		'75' => '75%',
		'90' => '90%',
		'100' => '100%'
	),
	'document_file_type_class' => array(
		'pdf'=>'fa-file-pdf-o',
		'doc'=>'fa-file-word-o',
		'docx'=>'fa-file-word-o',
		'xls'=>'fa-file-excel-o',
		'xlsx'=>'fa-file-excel-o',
		'ppt'=>'fa-file-powerpoint-o',
		'pptx'=>'fa-file-powerpoint-o',
		'zip'=>'fa-file-zip-o',
		'jpg'=>'fa-file-image-o',
		'jpeg'=>'fa-file-image-o',
		'rar'=>'fa-file-zip-o',
		'bmp'=>'fa-file-image-o',
		'gif'=>'fa-file-image-o',
		'tif'=>'fa-file-image-o',
		'txt'=>'fa-file-text-o',
		'xml'=>'fa-file-code-o',
		'csv'=>'fa-file-excel-o',
		'png'=>'fa-file-image-o',
	),
);
