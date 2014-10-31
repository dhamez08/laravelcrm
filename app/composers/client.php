<?php
View::composer(\Config::get('crm.themes.admin.path') . '.dashboard.partials.headerClientList', function($view)
{
	$group_id = \Session::get('group_id');
	$clients = \Clients\Clients::customerBelongsTo($group_id)->take(10)->orderBy('created_at', 'desc');
    $view->with('clientTopList', $clients);
});
