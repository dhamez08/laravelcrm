<div class="page-bar" style="margin: 0px -20px 0px -20px;background-color: #364150;">
	<ul class="page-breadcrumb tags">
		<li class="client-name">
			STEVE WARDEN
		</li>
		<li>
			Tags:
		</li>
		<li class="tag-item">
			SEO Client
		</li>
		<li class="tag-item">
			Web Design Client
		</li>
		<li class="tag-item">
			August Renewal
		</li>
		<li class="tag-item">
			Google PPC Lead
		</li>
	</ul>
</div>

<div class="page-bar" style="margin: 0px -20px 0px -20px;background-color: #364150;">
	<ul class="page-breadcrumb tags">
		<li class="client-name">
			<a href="{{ url('clients/client-summary/'.\Request::segment(3)) }}">Summary</a>
		</li>

		@if(count(Auth::user()->tabs)==0 || Auth::user()->tabs->files_tab==1)
		<li class="client-name">
			<a href="{{ url('clients/files/'.\Request::segment(3)) }}">Files</a>
		</li>
		@endif
		@if(count(Auth::user()->tabs)==0 || Auth::user()->tabs->messages_tab==1)
		<li class="client-name">
			<a href="{{ url('clients/messages/'.\Request::segment(3)) }}">Messages(0)</a>
		</li>
		@endif
		@if(count(Auth::user()->tabs)==0 || Auth::user()->tabs->opportunities_tab==1)
		<li class="client-name">
			<a href="{{ url('clients/opportunities/'.\Request::segment(3)) }}">Opportunities({{ count(\Clients\Clients::find(\Request::segment(3))->opportunities) }})</a>
		</li>
		@endif
		@if(count(Auth::user()->tabs)==0 || Auth::user()->tabs->live_tab==1)
		<li class="client-name">
			<a href="{{ url('clients/live-documents/'.\Request::segment(3)) }}">Live Documents</a>
		</li>
		@endif
	</ul>
</div>