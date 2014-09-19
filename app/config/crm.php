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
			)
		)
	)
);
