<div class="portlet light">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-globe"></i>
			<span class="caption-subject bold uppercase">
			Activity </span>
			<span class="caption-helper">more samples...</span>
		</div>
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#notes" data-toggle="tab">
				Notes </a>
			</li>
			<li class="">
				<a href="#messages" data-toggle="tab">
				Messages </a>
			</li>
			<li class="">
				<a href="#invoices" data-toggle="tab">
				Invoices </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body tabbable-line">
		<div class="tab-content">
			<div class="tab-pane active" id="notes">
				<div class="scroller" style="height: 200px;">
					{{\Notes\NotesController::get_instance()->getIndex($customerId,'')}}
				</div>
			</div>
			<div class="tab-pane" id="messages">
				<div class="scroller" style="height: 200px;">
					<h4>Tab 2 Content</h4>
					<p>
						 Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo.
					</p>
					<p>
						 Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.ut laoreet dolore magna ut laoreet dolore magna. ut laoreet dolore magna. ut laoreet dolore magna.
					</p>
				</div>
			</div>
			<div class="tab-pane" id="invoices">
				<div class="scroller" style="height: 200px;">
					<h4>Tab 3 Content</h4>
					<p>
						 Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.ut laoreet dolore magna ut laoreet dolore magna. ut laoreet dolore magna. ut laoreet dolore magna.
					</p>
					<p>
						 Ut wisi enim ad m veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
