<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SiteTest extends TestCase
{

    public function testPageHome()
    {
        $this->visit('/')->see('homepage');
    }


    public function testPageAbout()
    {
        $this->visit('/about')->see('about');
    }


    public function testPageContact()
    {
        $this->visit('/contact')->see('contact form');
    }


    public function testCategoryView()
    {
        $this->visit('/category/general')->see('general');
    }


    public function testTagIndex()
    {
        $this->visit('/tags')->see('Tag list');
    }

    public function testTagView()
    {
        $this->visit('/tag/demo')->see('demo');
    }


    public function testUserView()
    {
        $this->visit('/user/1')->see('admin');
    }


    public function testPostIndex()
    {
        $this->visit('/blog')->see('latest posts');
    }


    public function testPostView()
    {
        $this->visit('/blog/hello-world')->see('Hello World!');
    }

    public function testSitemap()
    {
        $this->visit('/sitemap')->see('</urlset>');
    }


    public function testFeed()
    {
        $this->visit('/feed')->see('</feed>');
    }


}