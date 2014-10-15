<?php
View::composer(\Config::get('crm.themes.admin.path') . '.dashboard.partials.headerClientList', function($view)
{
	$clients = \Clients\Clients::customerBelongsTo(\Auth::id())->take(10)->orderBy('created_at', 'desc');
    $view->with('clientTopList', $clients);
});
