<style type="text/css">
.status .panel-title {
    font-family: 'Oswald', sans-serif;
    font-size: 30px;
    font-weight: bold;
    color: #fff;
    line-height: 45px;
    padding-top: 10px;
    letter-spacing: -0.8px;
}
</style>

<div class="row">
    @include(\DashboardEntity::get_instance()->getView() . '.dashboard.partials.stats-view-horizontal', 
        array(
            'stats' => isset($stats) ? $stats : array(),
            'conversion_30days' => isset($conversion_30days) ? $conversion_30days : 0,
            'sales_30days' => isset($sales_30days) ? $sales_30days : 0
        )
    )
</div>

<div class="row">
    <!-- LEFT -->
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
                {{-- @include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.tasks' ) --}}
                {{ \Task\TaskController::get_instance()->getWidgetDisplay(null,null, array('portletClass' => 'box green-haze', 'portletCaptionClass' => '')) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.clientsBirthday', array('clientBirthdays' => (isset($clientBirthdays)) ? $clientBirthdays : array()) )
            </div>
        </div>
    </div>
    <!-- LEFT -->
    <!-- RIGHT -->
    <div class="col-md-9">
        @include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.recentActivities' )
    </div>
    <!-- RIGHT -->
</div>

<div class="row">
    <div class="col-md-3">
        <div class="row">
            <?php $social = \SocialMediaAccount\ProfileEntity::get_instance()->getMediaAccount(); ?>
            @if(count($social) > 0)
                @foreach($social as $account)
                    <div class="col-md-12">

                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box green-meadow">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-{{strtolower($account->provider)}}"></i>
                                        <span class="caption-subject bold uppercase">
                                            {{$account->provider}}
                                        </span>
                                    </div>
                                    <div class="tools">
                                        <a href="" class="collapse"></a>
                                        <a href="{{url('profile')}}" title="Used as Profile photo" data-profile-id="{{$account->id}}" class="config social-profile-config"></a>
                                        <!--
                                        <a href="" class="reload"></a>
                                        <a href="" class="remove"></a>
                                        -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="social-img col-xs-2 col-sm-12 col-md-3">
                                            <a href="{{$account->profileURL}}" target="_blank">
                                                <img src="{{$account->photoURL}}" style="width:60px;" />
                                            </a>
                                        </div>
                                        <div class="social-detail col-xs-10 col-sm-12 col-md-9">
                                            <div class="row">
                                                <ul>
                                                    <li class="profile-name">{{$account->displayName}}</li>
                                                    <li class="profile-email">{{$account->email}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- END GRID PORTLET-->

                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-9">
        <div class="portlet box blue-madison calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-calendar"></i>Calendar
                </div>
            </div>
            <div class="portlet-body light-grey">
                <div id="taskcalendar">
                </div>
            </div>
        </div>        
    </div>
</div>

@if(\Request::segment(1) == 'dashboard')
    @section('script-footer')
        @parent
        @section('footer-custom-js')
            <script type="text/javascript" src="{{$asset_path}}/pages/scripts/calendar.js"></script>
            <script>
            jQuery(document).ready(function() {
                TaskCalendar.init(baseURL, '{{ $google_calendar }}');
            });
            </script>
        @stop
    @stop
@endif