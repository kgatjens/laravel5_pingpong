<?php

namespace HepC\Presenters;

use Pingpong\Menus\Presenters\Presenter;
use Auth;

class HepCOnlyAdminPresenter extends Presenter
{
    /**
     * {@inheritdoc }
     */
    public function getOpenTagWrapper()
    {
        return  PHP_EOL.'<ul class="sidebar-menu">'.PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getCloseTagWrapper()
    {
        return PHP_EOL.'</ul>'.PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        $hideRoutes = config('admin.onlyAdminMenu');
        $hideItem = in_array($item->route[0], $hideRoutes);
        if( (! Auth::user()->is('admin') ) && $hideItem ){
            return '';
        }else{
            return '<li class="lala" '.$this->getActiveState($item).'><a href="'.$item->getUrl().'" '.$item->getAttributes().'>'.$item->getIcon().' '.$item->title.'</a></li>'.PHP_EOL;
        }
    }

    /**
     * {@inheritdoc }.
     */
    public function getActiveState($item, $state = ' class="active"')
    {
        return $item->isActive() ? $state : null;
    }

    /**
     * Get active state on child items.
     *
     * @param $item
     * @param string $state
     *
     * @return null|string
     */
    public function getActiveStateOnChild($item, $state = 'active')
    {
        return $item->hasActiveOnChild() ? $state : null;
    }

    /**
     * {@inheritdoc }.
     */
    public function getDividerWrapper()
    {
        return '<li class="divider"></li>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getHeaderWrapper($item)
    {
        return '<li class="dropdown-header">'.$item->title.'</li>';
    }

    /**
     * {@inheritdoc }
     */
    public function getMenuWithDropDownWrapper($item)
    {
        if ( isset($item->attributes['onlyAdmin']) ) {
            $hideAdmin = (boolean) $item->attributes['onlyAdmin'];
        }else{
            $hideAdmin = false;
        }

        if( (! Auth::user()->is('admin') ) && $hideAdmin ){
            return '';
        }else{
            return '
                <li class="treeview'.$this->getActiveStateOnChild($item, ' active').'">
                    <a href="#">
                        '.$item->getIcon().'
                        <span>'.$item->title.'</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        '.$this->getChildMenuItems($item).'
                    </ul>
                </li>';
        }
    }

    /**
     * Get multilevel menu wrapper.
     *
     * @param \Pingpong\Menus\MenuItem $item
     *
     * @return string`
     */
    public function getMultiLevelDropdownWrapper($item)
    {
        return '<li class="dropdown'.$this->getActiveStateOnChild($item, ' active').'">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    '.$item->getIcon().' '.$item->title.'
                    <b class="caret pull-right caret-right"></b>
                  </a>
                  <ul class="dropdown-menu">
                    '.$this->getChildMenuItems($item).'
                  </ul>
                </li>'
        .PHP_EOL;
    }
}
