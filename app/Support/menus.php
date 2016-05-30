<?php 
//

$leftMenu = Menu::instance('admin-menu');
$leftMenu ->destroy(); // Reset PingPong Menu

$rightMenu = Menu::instance('admin-menu-right');

/**
 * @see https://github.com/pingpong-labs/menus
 *
 * @example adding additional menu.
 *
 * $leftMenu->url('your-url', 'The Title');
 *
 * $leftMenu->route('your-route', 'The Title');
 */

// -- Added by Hangar
Menu::create('admin-menu', function ($menu) {
    //$menu->enableOrdering();
    $menu->setPresenter('Pingpong\Admin\Presenters\SidebarMenuPresenter');
    $menu->route('admin.home', trans('admin.menus.dashboard'), [], 0, ['icon' => 'fa fa-dashboard']);

    $menu->dropdown(trans('admin.menus.posts.title'), function ($sub) {
        $sub->route('admin.posts.index', trans('admin.menus.posts.all'), [], 1);
    }, 3, ['icon' => 'fa fa-thumb-tack']);


    $menu->dropdown(trans('admin.menus.tips.title'), function ($sub) {
    	$sub->route('admin.tips.index', trans('admin.menus.tips.all'), [], 1);
        $sub->route('admin.categoriestips.index', trans('admin.menus.tips.categories.all'), [], 1);
    }, 3, ['icon' => 'fa fa-list']);

    $menu->dropdown(trans('admin.menus.challenges.title'), function ($sub) {
        $sub->route('admin.challenges.index', trans('admin.menus.challenges.all'), [], 1);
    }, 3, ['icon' => 'fa fa-trophy']);

    $menu->setPresenter('HepC\Presenters\HepCOnlyAdminPresenter');
    $menu->dropdown(trans('admin.menus.comments.title'), function ($sub) {
        $sub->route('admin.comments.index', trans('admin.menus.comments.all'), [], 1);
    }, 3, ['icon' => 'fa fa-comments', 'onlyAdmin' => true]);

    // $menu->dropdown(trans('admin.menus.push_notification.types.title'), function ($sub) {
    //     $sub->route('admin.push_type.index', trans('admin.menus.push_notification.types.all'), [], 1);
    // }, 3, ['icon' => 'fa fa-bell']);

    $menu->setPresenter('HepC\Presenters\HepCOnlyAdminPresenter');
    $menu->dropdown(trans('admin.menus.devices.title'), function ($sub) {
        $sub->route('admin.devices.index', trans('admin.menus.devices.all'), [], 1);
    }, 3, ['icon' => 'fa fa-mobile', 'onlyAdmin' => true]);

    // $menu->dropdown(trans('admin.menus.users.title'), function ($sub) {
    //     $sub->route('admin.admin-users.index', trans('admin.menus.users.all'), [], 1);
    //     $sub->route('admin.admin-users.create', trans('admin.menus.users.create'), [], 2);
        
    // }, 3, ['icon' => 'fa fa-users']);
    // $menu->dropdown(trans('admin.menus.settings.title'), function ($sub) {
    //     $sub->route('admin.settings', trans('admin.menus.settings.index'), [], 1);
        
    // }, 3, ['icon' => 'fa fa-cog']);

    $menu->setPresenter('HepC\Presenters\HepCOnlyAdminPresenter');
    $menu->dropdown(trans('admin.menus.users.title'), function ($sub) {
        $sub->route('admin.users.index', trans('admin.menus.users.all'), [], 1);
        $sub->route('admin.users.create', trans('admin.menus.users.create'), [], 2);
        $sub->divider(3);
        $sub->route('admin.roles.index', trans('admin.menus.roles'), [], 4);
        $sub->route('admin.permissions.index', trans('admin.menus.permissions'), [], 5);
    }, 3, ['icon' => 'fa fa-users', 'onlyAdmin' => true]);
    
    
    
});
