<div class="tab-pane{{(\Session::has('profile') && \Session::get('profile') == 'account-help-settings') ? ' active': ''}}" id="tab_help_settings">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<ul class="ver-inline-menu tabbable margin-bottom-10">
					<li class="active">
						<a data-toggle="tab" href="#tab_1">
						<i class="fa fa-briefcase"></i> General Questions </a>
						<span class="after">
						</span>
					</li>
                    <li>
                        <a data-toggle="tab" href="#email-marketing">
                        <i class="fa fa-envelope-o"></i> Email Marketing </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#document-library">
                            <i class="fa fa-folder-o"></i> Document Library </a>
                    </li>
					<li>
						<a data-toggle="tab" href="#tab_2">
						<i class="fa fa-group"></i> Membership </a>
					</li>
					<li>
						<a data-toggle="tab" href="#clients-hlp">
						<i class="fa fa-group"></i> Clients </a>
					</li>
					<li>
						<a data-toggle="tab" href="#tab_3">
						<i class="fa fa-leaf"></i> Terms Of Service </a>
					</li>
					<li>
						<a data-toggle="tab" href="#tab_1">
						<i class="fa fa-info-circle"></i> License Terms </a>
					</li>
					<li>
						<a data-toggle="tab" href="#tab_2">
						<i class="fa fa-tint"></i> Payment Rules </a>
					</li>
					<li>
						<a data-toggle="tab" href="#tab_3">
						<i class="fa fa-plus"></i> Other Questions </a>
					</li>
				</ul>
			</div>
			<div class="col-md-9">
				<div class="tab-content">
					{{ $email_marketing_tab }}
                    {{ $document_library_tab }}
					{{ $clients_tab }}
				</div>
			</div>
		</div>
	</div>
</div>
