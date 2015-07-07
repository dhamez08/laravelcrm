@extends( $dashboard_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<!-- CUSTOM FILES -->
				<div class="portlet light bordered" style="min-height: 425px">
					<div class="portlet-title tabbable-line">
						<div class="caption">
							<span class="caption-subject font-green-sharp ">My Uploaded Documents</span>
						</div>
					</div>
					<div class="portlet-body tabbable-line">
						<!--BEGIN TABS-->
						<div class="tab-content">
							<div class="tab-pane active">
								<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 310px;"><div class="scroller" style="overflow: hidden; width: auto; height: 337px;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
									<ul class="feeds">
                                        <li>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <input id="select-all-file" type="checkbox"/>
                                                    </div>
                                                    <div class="col-md-11" style="color: #ACACAC">
                                                            Select All
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </li>
										@foreach($documents as $document)
										<li>
											<div class="col-md-7">
												<div class="row">
                                                    <div class="col-md-1">
                                                        <input class="file-checkbox" type="checkbox" data-file-id="{{$document->id}}" />
                                                    </div>
													<div class="col-md-1">
														<div class="label label-sm label-danger">
															<i class="fa {{ $icons[$document->file_ext] or 'fa-file-o' }}"></i>
														</div>
													</div>
													<div class="col-md-10">
														<div class="desc">
															<a href="{{ $path.'/'.$document->filename }}" target="_blank">{{ $document->name }}</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<a href="{{ url('document-library/delete/'.$document->id) }}" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i> Remove</a>
											</div>
										</li>
										@endforeach
									</ul>
								</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 187.717355371901px; display: block; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
							</div>
						</div>
						<!--END TABS-->
						<button class="btn green-haze btn-circle btn-sm pull-right" data-toggle="modal" data-target="#add-document-library-modal">New</button>
                        <button class="btn green-haze btn-circle btn-sm pull-right" id="delete-all" disabled="true">Delete All</button>
					</div>
				</div>	
				<!-- END CUSTOM FILES -->
			</div>
		</div>
	</div>

	@include( \DashboardEntity::get_instance()->getView() . '.document-libraries.partials.modals.add-document-library-modal' )

	@stop
@stop
@section('script-footer')
	@parent
	@section('footer-custom-js')
        @parent
            <script>
                $(function(){
                    var file_ids = new Array();

                    $('.file-checkbox').on('click', function(){
                        $('#select-all-file').prop('checked',false);
                        $('#select-all-file').uniform({checkedClass: ''})

                        var cbx = $(this);
                        var file_id = cbx.data('file-id');

                        if(cbx.is(':checked')){
                            file_ids.push(file_id);
                        } else {
                            var index = file_ids.indexOf(file_id);
                            if (index >= 0)
                                file_ids.splice(index, 1);
                        }

                        if(file_ids.length){
                            $('#delete-all').prop('disabled',false);
                        } else {
                            $('#delete-all').prop('disabled',true);
                        }
                    });

                    $('#delete-all').on('click',function(){

                        var bootbox_open = true;
                        var box = bootbox.confirm({
                            message: 'Are you sure you want to delete selected documents?',
                            callback: function(result){
                                if(result){
                                    var query = $.param({ file_ids: file_ids });
                                    window.location.href = baseURL+'/document-library/bulk-delete?'+query;
                                }

                                if(bootbox_open){
                                    bootbox_open = false;
                                    box.find('.close').click();
                                }
                            },
                            show: true
                        });
                    });

                    $('#select-all-file').on('click',function(){
                        var is_checked = $(this).is(":checked")

                        var checkedClass = is_checked ? 'checked' : '';
                        $('.file-checkbox').prop('checked',is_checked);
                        $('.file-checkbox').uniform({checkedClass: checkedClass})


                        if(is_checked){
                            file_ids = new Array();
                            $.each($('.file-checkbox'),function(){
                                file_ids.push($(this).data('file-id'));
                            })

                            $('#delete-all').prop('disabled',false);
                        } else {
                            file_ids = new Array();
                            $('#delete-all').prop('disabled',true);
                        }

                    })
                });
            </script>
        @stop
@stop
