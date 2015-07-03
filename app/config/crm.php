<?php
return array(
	'timezone' => 'Europe/London',
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
					'readonly'		=>	1
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
				/*
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
				*/
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
	'people_relationship' => array(
		'0'=>'Select',
		'Spouse/Partner'=>'Spouse/Partner',
		'Son'=>'Son',
		'Daughter'=>'Daughter',
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
	'task_remind' => array(
		'0' => 'Do Not Remind',
		'5' => 'Remind me 5 minutes before',
		'15' => 'Remind me 15 minutes before',
		'30' => 'Remind me 30 minutes before',
		'60' => 'Remind me 60 minutes before',
	),
	'task_hour' => array(
		'00' => '00',
		'01' => '01',
		'02' => '02',
		'03' => '03',
		'04' => '04',
		'05' => '05',
		'06' => '06',
		'07' => '07',
		'08' => '08',
		'09' => '09',
		'10' => '10',
		'11' => '11',
		'12' => '12',
		'13' => '13',
		'14' => '14',
		'15' => '15',
		'16' => '16',
		'17' => '17',
		'18' => '18',
		'19' => '19',
		'20' => '20',
		'21' => '21',
		'22' => '22',
		'23' => '23',
	),
	'task_min' => array(
		'00' => '00',
		'15' => '15',
		'30' => '30',
		'45' => '45',
	),
	'task_icons' => array(
		'fa-glass' => '\f000', 'fa-music' => '\f001', 'fa-search' => '\f002', 'fa-envelope-o' => '\f003', 'fa-heart' => '\f004', 'fa-star' => '\f005', 'fa-star-o' => '\f006', 'fa-user' => '\f007', 'fa-film' => '\f008', 'fa-th-large' => '\f009', 'fa-th' => '\f00a', 'fa-th-list' => '\f00b', 'fa-check' => '\f00c', 'fa-times' => '\f00d', 'fa-search-plus' => '\f00e', 'fa-search-minus' => '\f010', 'fa-power-off' => '\f011', 'fa-signal' => '\f012', 'fa-cog' => '\f013', 'fa-trash-o' => '\f014', 'fa-home' => '\f015', 'fa-file-o' => '\f016', 'fa-clock-o' => '\f017', 'fa-road' => '\f018', 'fa-download' => '\f019', 'fa-arrow-circle-o-down' => '\f01a', 'fa-arrow-circle-o-up' => '\f01b', 'fa-inbox' => '\f01c', 'fa-play-circle-o' => '\f01d', 'fa-repeat' => '\f01e', 'fa-refresh' => '\f021', 'fa-list-alt' => '\f022', 'fa-lock' => '\f023', 'fa-flag' => '\f024', 'fa-headphones' => '\f025', 'fa-volume-off' => '\f026', 'fa-volume-down' => '\f027', 'fa-volume-up' => '\f028', 'fa-qrcode' => '\f029', 'fa-barcode' => '\f02a', 'fa-tag' => '\f02b', 'fa-tags' => '\f02c', 'fa-book' => '\f02d', 'fa-bookmark' => '\f02e', 'fa-print' => '\f02f', 'fa-camera' => '\f030', 'fa-font' => '\f031', 'fa-bold' => '\f032', 'fa-italic' => '\f033', 'fa-text-height' => '\f034', 'fa-text-width' => '\f035', 'fa-align-left' => '\f036', 'fa-align-center' => '\f037', 'fa-align-right' => '\f038', 'fa-align-justify' => '\f039', 'fa-list' => '\f03a', 'fa-outdent' => '\f03b', 'fa-indent' => '\f03c', 'fa-video-camera' => '\f03d', 'fa-picture-o' => '\f03e', 'fa-pencil' => '\f040', 'fa-map-marker' => '\f041', 'fa-adjust' => '\f042', 'fa-tint' => '\f043', 'fa-pencil-square-o' => '\f044', 'fa-share-square-o' => '\f045', 'fa-check-square-o' => '\f046', 'fa-arrows' => '\f047', 'fa-step-backward' => '\f048', 'fa-fast-backward' => '\f049', 'fa-backward' => '\f04a', 'fa-play' => '\f04b', 'fa-pause' => '\f04c', 'fa-stop' => '\f04d', 'fa-forward' => '\f04e', 'fa-fast-forward' => '\f050', 'fa-step-forward' => '\f051', 'fa-eject' => '\f052', 'fa-chevron-left' => '\f053', 'fa-chevron-right' => '\f054', 'fa-plus-circle' => '\f055', 'fa-minus-circle' => '\f056', 'fa-times-circle' => '\f057', 'fa-check-circle' => '\f058', 'fa-question-circle' => '\f059', 'fa-info-circle' => '\f05a', 'fa-crosshairs' => '\f05b', 'fa-times-circle-o' => '\f05c', 'fa-check-circle-o' => '\f05d', 'fa-ban' => '\f05e', 'fa-arrow-left' => '\f060', 'fa-arrow-right' => '\f061', 'fa-arrow-up' => '\f062', 'fa-arrow-down' => '\f063', 'fa-share' => '\f064', 'fa-expand' => '\f065', 'fa-compress' => '\f066', 'fa-plus' => '\f067', 'fa-minus' => '\f068', 'fa-asterisk' => '\f069', 'fa-exclamation-circle' => '\f06a', 'fa-gift' => '\f06b', 'fa-leaf' => '\f06c', 'fa-fire' => '\f06d', 'fa-eye' => '\f06e', 'fa-eye-slash' => '\f070', 'fa-exclamation-triangle' => '\f071', 'fa-plane' => '\f072', 'fa-calendar' => '\f073', 'fa-random' => '\f074', 'fa-comment' => '\f075', 'fa-magnet' => '\f076', 'fa-chevron-up' => '\f077', 'fa-chevron-down' => '\f078', 'fa-retweet' => '\f079', 'fa-shopping-cart' => '\f07a', 'fa-folder' => '\f07b', 'fa-folder-open' => '\f07c', 'fa-arrows-v' => '\f07d', 'fa-arrows-h' => '\f07e', 'fa-bar-chart-o' => '\f080', 'fa-twitter-square' => '\f081', 'fa-facebook-square' => '\f082', 'fa-camera-retro' => '\f083', 'fa-key' => '\f084', 'fa-cogs' => '\f085', 'fa-comments' => '\f086', 'fa-thumbs-o-up' => '\f087', 'fa-thumbs-o-down' => '\f088', 'fa-star-half' => '\f089', 'fa-heart-o' => '\f08a', 'fa-sign-out' => '\f08b', 'fa-linkedin-square' => '\f08c', 'fa-thumb-tack' => '\f08d', 'fa-external-link' => '\f08e', 'fa-sign-in' => '\f090', 'fa-trophy' => '\f091', 'fa-github-square' => '\f092', 'fa-upload' => '\f093', 'fa-lemon-o' => '\f094', 'fa-phone' => '\f095', 'fa-square-o' => '\f096', 'fa-bookmark-o' => '\f097', 'fa-phone-square' => '\f098', 'fa-twitter' => '\f099', 'fa-facebook' => '\f09a', 'fa-github' => '\f09b', 'fa-unlock' => '\f09c', 'fa-credit-card' => '\f09d', 'fa-rss' => '\f09e', 'fa-hdd-o' => '\f0a0', 'fa-bullhorn' => '\f0a1', 'fa-bell' => '\f0f3', 'fa-certificate' => '\f0a3', 'fa-hand-o-right' => '\f0a4', 'fa-hand-o-left' => '\f0a5', 'fa-hand-o-up' => '\f0a6', 'fa-hand-o-down' => '\f0a7', 'fa-arrow-circle-left' => '\f0a8', 'fa-arrow-circle-right' => '\f0a9', 'fa-arrow-circle-up' => '\f0aa', 'fa-arrow-circle-down' => '\f0ab', 'fa-globe' => '\f0ac', 'fa-wrench' => '\f0ad', 'fa-tasks' => '\f0ae', 'fa-filter' => '\f0b0', 'fa-briefcase' => '\f0b1', 'fa-arrows-alt' => '\f0b2', 'fa-users' => '\f0c0', 'fa-link' => '\f0c1', 'fa-cloud' => '\f0c2', 'fa-flask' => '\f0c3', 'fa-scissors' => '\f0c4', 'fa-files-o' => '\f0c5', 'fa-paperclip' => '\f0c6', 'fa-floppy-o' => '\f0c7', 'fa-square' => '\f0c8', 'fa-bars' => '\f0c9', 'fa-list-ul' => '\f0ca', 'fa-list-ol' => '\f0cb', 'fa-strikethrough' => '\f0cc', 'fa-underline' => '\f0cd', 'fa-table' => '\f0ce', 'fa-magic' => '\f0d0', 'fa-truck' => '\f0d1', 'fa-pinterest' => '\f0d2', 'fa-pinterest-square' => '\f0d3', 'fa-google-plus-square' => '\f0d4', 'fa-google-plus' => '\f0d5', 'fa-money' => '\f0d6', 'fa-caret-down' => '\f0d7', 'fa-caret-up' => '\f0d8', 'fa-caret-left' => '\f0d9', 'fa-caret-right' => '\f0da', 'fa-columns' => '\f0db', 'fa-sort' => '\f0dc', 'fa-sort-desc' => '\f0dd', 'fa-sort-asc' => '\f0de', 'fa-envelope' => '\f0e0', 'fa-linkedin' => '\f0e1', 'fa-undo' => '\f0e2', 'fa-gavel' => '\f0e3', 'fa-tachometer' => '\f0e4', 'fa-comment-o' => '\f0e5', 'fa-comments-o' => '\f0e6', 'fa-bolt' => '\f0e7', 'fa-sitemap' => '\f0e8', 'fa-umbrella' => '\f0e9', 'fa-clipboard' => '\f0ea', 'fa-lightbulb-o' => '\f0eb', 'fa-exchange' => '\f0ec', 'fa-cloud-download' => '\f0ed', 'fa-cloud-upload' => '\f0ee', 'fa-user-md' => '\f0f0', 'fa-stethoscope' => '\f0f1', 'fa-suitcase' => '\f0f2', 'fa-bell-o' => '\f0a2', 'fa-coffee' => '\f0f4', 'fa-cutlery' => '\f0f5', 'fa-file-text-o' => '\f0f6', 'fa-building-o' => '\f0f7', 'fa-hospital-o' => '\f0f8', 'fa-ambulance' => '\f0f9', 'fa-medkit' => '\f0fa', 'fa-fighter-jet' => '\f0fb', 'fa-beer' => '\f0fc', 'fa-h-square' => '\f0fd', 'fa-plus-square' => '\f0fe', 'fa-angle-double-left' => '\f100', 'fa-angle-double-right' => '\f101', 'fa-angle-double-up' => '\f102', 'fa-angle-double-down' => '\f103', 'fa-angle-left' => '\f104', 'fa-angle-right' => '\f105', 'fa-angle-up' => '\f106', 'fa-angle-down' => '\f107', 'fa-desktop' => '\f108', 'fa-laptop' => '\f109', 'fa-tablet' => '\f10a', 'fa-mobile' => '\f10b', 'fa-circle-o' => '\f10c', 'fa-quote-left' => '\f10d', 'fa-quote-right' => '\f10e', 'fa-spinner' => '\f110', 'fa-circle' => '\f111', 'fa-reply' => '\f112', 'fa-github-alt' => '\f113', 'fa-folder-o' => '\f114', 'fa-folder-open-o' => '\f115', 'fa-smile-o' => '\f118', 'fa-frown-o' => '\f119', 'fa-meh-o' => '\f11a', 'fa-gamepad' => '\f11b', 'fa-keyboard-o' => '\f11c', 'fa-flag-o' => '\f11d', 'fa-flag-checkered' => '\f11e', 'fa-terminal' => '\f120', 'fa-code' => '\f121', 'fa-reply-all' => '\f122', 'fa-star-half-o' => '\f123', 'fa-location-arrow' => '\f124', 'fa-crop' => '\f125', 'fa-code-fork' => '\f126', 'fa-chain-broken' => '\f127', 'fa-question' => '\f128', 'fa-info' => '\f129', 'fa-exclamation' => '\f12a', 'fa-superscript' => '\f12b', 'fa-subscript' => '\f12c', 'fa-eraser' => '\f12d', 'fa-puzzle-piece' => '\f12e', 'fa-microphone' => '\f130', 'fa-microphone-slash' => '\f131', 'fa-shield' => '\f132', 'fa-calendar-o' => '\f133', 'fa-fire-extinguisher' => '\f134', 'fa-rocket' => '\f135', 'fa-maxcdn' => '\f136', 'fa-chevron-circle-left' => '\f137', 'fa-chevron-circle-right' => '\f138', 'fa-chevron-circle-up' => '\f139', 'fa-chevron-circle-down' => '\f13a', 'fa-html5' => '\f13b', 'fa-css3' => '\f13c', 'fa-anchor' => '\f13d', 'fa-unlock-alt' => '\f13e', 'fa-bullseye' => '\f140', 'fa-ellipsis-h' => '\f141', 'fa-ellipsis-v' => '\f142', 'fa-rss-square' => '\f143', 'fa-play-circle' => '\f144', 'fa-ticket' => '\f145', 'fa-minus-square' => '\f146', 'fa-minus-square-o' => '\f147', 'fa-level-up' => '\f148', 'fa-level-down' => '\f149', 'fa-check-square' => '\f14a', 'fa-pencil-square' => '\f14b', 'fa-external-link-square' => '\f14c', 'fa-share-square' => '\f14d', 'fa-compass' => '\f14e', 'fa-caret-square-o-down' => '\f150', 'fa-caret-square-o-up' => '\f151', 'fa-caret-square-o-right' => '\f152', 'fa-eur' => '\f153', 'fa-gbp' => '\f154', 'fa-usd' => '\f155', 'fa-inr' => '\f156', 'fa-jpy' => '\f157', 'fa-rub' => '\f158', 'fa-krw' => '\f159', 'fa-btc' => '\f15a', 'fa-file' => '\f15b', 'fa-file-text' => '\f15c', 'fa-sort-alpha-asc' => '\f15d', 'fa-sort-alpha-desc' => '\f15e', 'fa-sort-amount-asc' => '\f160', 'fa-sort-amount-desc' => '\f161', 'fa-sort-numeric-asc' => '\f162', 'fa-sort-numeric-desc' => '\f163', 'fa-thumbs-up' => '\f164', 'fa-thumbs-down' => '\f165', 'fa-youtube-square' => '\f166', 'fa-youtube' => '\f167', 'fa-xing' => '\f168', 'fa-xing-square' => '\f169', 'fa-youtube-play' => '\f16a', 'fa-dropbox' => '\f16b', 'fa-stack-overflow' => '\f16c', 'fa-instagram' => '\f16d', 'fa-flickr' => '\f16e', 'fa-adn' => '\f170', 'fa-bitbucket' => '\f171', 'fa-bitbucket-square' => '\f172', 'fa-tumblr' => '\f173', 'fa-tumblr-square' => '\f174', 'fa-long-arrow-down' => '\f175', 'fa-long-arrow-up' => '\f176', 'fa-long-arrow-left' => '\f177', 'fa-long-arrow-right' => '\f178', 'fa-apple' => '\f179', 'fa-windows' => '\f17a', 'fa-android' => '\f17b', 'fa-linux' => '\f17c', 'fa-dribbble' => '\f17d', 'fa-skype' => '\f17e', 'fa-foursquare' => '\f180', 'fa-trello' => '\f181', 'fa-female' => '\f182', 'fa-male' => '\f183', 'fa-gittip' => '\f184', 'fa-sun-o' => '\f185', 'fa-moon-o' => '\f186', 'fa-archive' => '\f187', 'fa-bug' => '\f188', 'fa-vk' => '\f189', 'fa-weibo' => '\f18a', 'fa-renren' => '\f18b', 'fa-pagelines' => '\f18c', 'fa-stack-exchange' => '\f18d', 'fa-arrow-circle-o-right' => '\f18e', 'fa-arrow-circle-o-left' => '\f190', 'fa-caret-square-o-left' => '\f191', 'fa-dot-circle-o' => '\f192', 'fa-wheelchair' => '\f193', 'fa-vimeo-square' => '\f194', 'fa-try' => '\f195'
	),
	'task_color' => array(
		'#e8cdde',
		'#b0322b',
		'#d05d17',
		'#d0dad1',
		'#c1dde4',
		'#d0d4e9',
		'#d7d1e9',
		'#775352',
		'#666666',
		'#f2bfd9',
		'#e6adae',
		'#f3c098',
		'#c1d897',
		'#9ec6e2',
		'#a8b4d0',
		'#d1bde2',
		'#ffea94',
		'#d7cdcd',
	),
	'date'=>array(
		'bootstrap_date_picker' => array(
			'format' => 'dd/mm/yyyy'
		),
	),
	'textlocal'=>array(
		'api' => array(
			'hashcode'=>'ea940442105f12c00f8c1172ee78f8352ebdc27d',
			'login'=>'steve.warden1@btopenworld.com',
			'test' => false,
		),
	),
	'currency'=>array(
		'symbol'=>'&pound;',
	),
	'sms'=>array(
		'purchase' => array(
			'20' => '3.00',
			'50' => '6.00',
			'100' => '10.00',
			'200' => '16.00'
		),
	),
	'paypal'=>array(
		'api'=>array(
			'classic'=>array(
				'USER' => 'steve.warden_api1.123-insureme.co.uk',
				'PWD' => '9H8LC2GW97LB8MD6',
				'SIGNATURE' => 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-AtTZdUQHqgcSI1dFjsSryxxe38Nj',
				'VERSION' => '98.0',
				'CARTBORDERCOLOR' => 'DE4681',
				'BRANDNAME' => 'One23 CRM',
				'URL' => "https://api-3t.paypal.com/nvp"
			),
			'rest'=>array(
			),
		),
	),
	'client' => array(
		'relationship' => array(
			'exclude' => array(0,'Son', 'Daughter')
		)
	)
);
