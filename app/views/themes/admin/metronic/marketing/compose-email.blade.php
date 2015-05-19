@extends( $dashboard_index )
@section('begin-head')
@parent
@section('head-page-level-css')
    @parent
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{$asset_path}}/pages//css/portfolio.css" rel="stylesheet"/>
    <link href="{{$asset_path}}/pages//css/email-marketing.css" rel="stylesheet"/>
    <!-- END PAGE LEVEL SCRIPTS -->
@stop
@stop

@section('body-content')
@parent
@section('innerpage-content')
<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable">
    <div class="portlet-title">
        <div class="caption">
            @section('portlet-captions')
            {{{$portlet_title or 'Portlet Title'}}}
            @show
        </div>
    </div>
    <div class="portlet-body {{{$portlet_body_class or ''}}}">
        <div class="portlet-tabs">
            <div class="tab-content">
                {{Form::open(
                    array(
                        'action' => array('Marketing\MarketingController@getSendClientEmail'),
                        'method' => 'GET',
                        'class' => 'form-horizontal',
                        'role'=>'form',
                    )
                )}}
                @if( $tags )
                <div class="row">
                    <div class="col-md-12">
                        <label>Tags: </label>
                        {{
                        Form::select(
                            'tags[]',
                            $tags->lists('tag','id'),
                            isset($tag_id) ? $tag_id:null,
                            array('multiple')
                        );
                        }}
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">

                        <div class="portlet box blue" style="margin-top:10px; margin-bottom:10px">
                            <div class="portlet-title">
                                <div class="caption caption-mini">
                                    <i class="fa fa-cogs"></i>Advanced Filters
                                </div>
                                <div class="tools" style="float:left">
                                    <a href="javascript:;" class="expand">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body" style="display:none">
                                <div class="row">
                                    <div class="col-md-12" style="margin: 10px 10px;">
                                        <label>Age: </label>
                                        {{ Form::number('age_min', \Input::get('age_min'), array('placeholder' => 'Minimum Age')) }} - {{ Form::number('age_max', \Input::get('age_max'), array('placeholder' => 'Maximum Age')) }}
                                        &nbsp;&nbsp;
                                        <label>Marital Status: </label>
                                        {{ Form::select('marital_status', Config::get('crm.marital_status'), \Input::get('marital_status')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{Form::submit('Apply Filters',array('class'=>"btn blue"))}}
                {{Form::close()}}
                <p></p>
                {{ Form::open(
                array(
                'action' => array('Marketing\MarketingController@getCreateEmail'),
                'method' => 'GET',
                'class' => 'form-horizontal',
                'role'=>'form',
                )
                )
                }}
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="check_all_customers">
                            Person's Name and Email
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($customer_list->get() as $customer)
                            @if( $customer->emails->count() > 0)
                                @foreach($customer->emails as $email)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="email[]" value="{{$email->id}}" />
                                            {{$customer->title}} {{$customer->first_name}} {{$customer->last_name}} -
                                            <span class="label label-info"><i class="fa fa-envelope-o"></i> {{$email->email}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{Form::submit('Next Step',array('class'=>"btn blue"))}}
                {{ Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop
@stop
@section('script-footer')
    @parent
    @section('footer-custom-js')
        @parent
        <script type="text/javascript">
            $('#check_all_customers').change(function() {
                var table_body = $(this).closest('table').find('tbody');
                var checkedClass = $(this).is(":checked") ? 'checked' : '';
                table_body.find('input[type="checkbox"]').prop('checked', $(this).is(":checked"));
                table_body.find('input[type="checkbox"]').uniform({checkedClass: checkedClass});
            });
            $('select[name="tags[]"]').select2({
                width: '100%'
            });
        </script>
    @stop
@stop
