<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PagesTest extends TestCase
{

    public function testPostsPage()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('Display Posts');
    }
//    public function testCreatePosts()
//    {
//        $response = $this->get('/posts');
//
//        $response->assertSeeText('Create Posts');
//    }
}
