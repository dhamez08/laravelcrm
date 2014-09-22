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
	)
);
