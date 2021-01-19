<?php namespace AM77\Recentarticles;

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
            'description' => 'A list of the recently added articles',
            'author'      => 'AM77',
            'icon'        => 'icon-clock-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register() { }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot() { }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'AM77\Recentarticles\Components\RecentArticles' => 'recentArticles',
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
            'am77.recentarticles.some_permission' => [
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
        return [
            'recentarticles' => [
                'label'       => 'recentarticles',
                'url'         => Backend::url('am77/recentarticles/mycontroller'),
                'icon'        => 'icon-clock-o',
                'permissions' => ['am77.recentarticles.*'],
                'order'       => 500,
            ],
        ];
    }
}
