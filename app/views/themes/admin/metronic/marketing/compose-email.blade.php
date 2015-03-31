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
        </script>
    @stop
@stop
