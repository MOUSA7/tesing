<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function testNotHavingPosts()
    {
        $response = $this->get('/posts');
        $response->assertSeeText('No Blog Posts yet ?');
    }

    public function testPostCreated()
    {
        //Arrange
       $post = $this->CreateDummyPost();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('New title');

        $response->assertSeeText('No Comments Yet !');

        $this->assertDatabaseHas('posts', [
            'title' => 'New title'
        ]);
    }

    public function testPostsContainComments(){
        $user = $this->user();
        $post = $this->CreateDummyPost();
        factory(Comment::class,4)->create([
            'commentable_id'=>$post->id,
            'commentable_type'=>'App\Post',
            'user_id'=>$user->id,
        ]);

        $response = $this->get('/posts');
        $response->assertSeeText('4 Comments');
    }

    public function testStoreSuccess()
    {
        $user = $this->user();
        $params = [
            'title' => 'The valid',
            'content' => 'The is validated',
        ];
        $this->actingAs($user)->post('posts/create', $params)->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post was Created');

    }

    public function testFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];
        $this->actingAs($this->user())->post('/posts/create', $params)->assertStatus(302)->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title must be at least 4 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 7 characters.');
//        dd($messages->getMessages());
    }

    public function testUpdateSuccess()
    {

        $user = $this->user();
        $post = $this->CreateDummyPost($user->id);
        $this->assertDatabaseHas('posts', $post->getAttributes());

        $params = [
            'title' => 'Welcome Post',
            'content' => 'Welcome To My Content',
        ];
        $this->actingAs($user)->patch("posts/edit/{$post->id}", $params)->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post was Updated');
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    public function testDelete()
    {
        $user = $this->user();
        $post = $this->CreateDummyPost($user->id);
        $this->assertDatabaseHas('posts', $post->getAttributes());

        $this->actingAs($user)->get("posts/delete/{$post->id}")->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post was Deleted');
//        $this->assertDatabaseMissing('posts', $post->toArray());


    }

    private function CreateDummyPost($UserId = null): Post
    {
//        $post = new Post();
//        $post->title = 'New title';
//        $post->content = 'New Content';
//        $post->save();
//        return $post;
       return factory(Post::class)->states('new-title')->create([
            'user_id'=>$UserId ?? $this->user()->id,
        ]);
    }
}
