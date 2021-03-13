<?php namespace Developatic\Recentarticles;

use Backend;
use System\Classes\PluginBase;

/**
 * recentarticles Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'recentarticles',
            'description' => 'A list of the recent articles',
            'author'      => 'Developatic',
            'icon'        => 'icon-clock-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Developatic\Recentarticles\Components\RecentArticles' => 'recentArticles',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'developatic.recentarticles.some_permission' => [
                'tab' => 'recentarticles',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'recentarticles' => [
                'label'       => 'recentarticles',
                'url'         => Backend::url('developatic/recentarticles/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['developatic.recentarticles.*'],
                'order'       => 500,
            ],
        ];
    }
}
