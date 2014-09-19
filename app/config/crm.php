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
					'default_value'	=>	'Custom Form Files',
					'form_name'		=>	'section1',
					'placeholder'	=>	'Enter a name for section 1',
					'readonly'		=>	1
				),
				array(
					'label_name'	=>	'Section 2 Name:',
					'default_value'	=>	'',
					'form_name'		=>	'section2',
					'placeholder'	=>	'Enter a name for section 2',
					'readonly'		=>	0
				),
				array(
					'label_name'	=>	'Section 3 Name:',
					'default_value'	=>	'',
					'form_name'		=>	'section3',
					'placeholder'	=>	'Enter a name for section 3',
					'readonly'		=>	0
				),
				array(
					'label_name'	=>	'Section 4 Name:',
					'default_value'	=>	'',
					'form_name'		=>	'section4',
					'placeholder'	=>	'Enter a name for section 4',
					'readonly'		=>	0
				),
				array(
					'label_name'	=>	'Section 5 Name:',
					'default_value'	=>	'',
					'form_name'		=>	'section5',
					'placeholder'	=>	'Enter a name for section 5',
					'readonly'		=>	0
				),
				array(
					'label_name'	=>	'Section 5 Name:',
					'default_value'	=>	'',
					'form_name'		=>	'section5',
					'placeholder'	=>	'Enter a name for section 5',
					'readonly'		=>	0
				),
			)
		)
	)
);
