<?php

namespace Developatic\Recentarticles\Components;

use BackendAuth;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post as BlogPost;

class RecentArticles extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Recent Articles',
            'description' => 'A list of the recently added articles'
        ];
    }

    public $posts;
    
    public $postPage;

    private $sortOrder = 'published_at desc';

    protected function prepareVars()
    {
        $this->postPage = $this->page['postPage'] = $this->property('postPage');
    }

    public function defineProperties()
    {
        return [
            'postsPerPage' => [
                'title'             => 'posts per page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'default'           => '4',
            ],
            'postPage' => [
                'title'       => 'Post page',
                'description' => 'Name of the link to the post page',
                'type'        => 'dropdown',
                'default'     => 'blog/post',
                'group'       => 'Links',
            ],
        ];
    }

    public function onRun()
    {
         $this->prepareVars();
        $this->posts = $this->page['posts'] = $this->listPosts();
    }


    protected function listPosts()
    {

        /*
         * List all the posts
         */
        $isPublished = !$this->checkEditor();

        $posts = BlogPost::with('categories')->listFrontEnd([
            'perPage'    => $this->property('postsPerPage'),
            'sort'       => $this->property('sortOrder'),
            'published'  => $isPublished,
            'exceptPost' => $this->property('exceptPost'),
        ]);

        /*
         * Add a "url" helper attribute for linking to each post and category
         */
        $posts->each(function($post) {
            $post->setUrl($this->postPage, $this->controller);
        });

        return $posts;
    }

    public function getPostPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    protected function checkEditor()
    {
        $backendUser = BackendAuth::getUser();
        return $backendUser && $backendUser->hasAccess('rainlab.blog.access_posts');
    }
}