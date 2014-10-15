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
		@foreach(Auth::user()->customtabs as $tab)
			<li class="client-name">
				<a href="{{ url('clients/custom/'.\Request::segment(3).'?custom='.$tab->id) }}">{{ $tab->name }}</a>
			</li>
		@endforeach
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
		@if(count(Auth::user()->tabs)==0 || (Auth::user()->tabs->people_tab==1 && $customer->type==2))
		<li class="client-name">
			<a href="{{ url('clients/people/'.\Request::segment(3)) }}">People</a>
		</li>
		@endif
		@if(count(Auth::user()->tabs)==0 || Auth::user()->tabs->opportunities_tab==1)
		<li class="client-name">
			<a href="{{ url('clients/opportunities/'.\Request::segment(3)) }}">Opportunities({{ count($customer->opportunities) }})</a>
		</li>
		@endif
		@if(count(Auth::user()->tabs)==0 || Auth::user()->tabs->live_tab==1)
		<li class="client-name">
			<a href="{{ url('clients/live-documents/'.\Request::segment(3)) }}">Live Documents</a>
		</li>
		@endif
	</ul>
</div>