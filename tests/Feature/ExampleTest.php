<?php

namespace Tests\Feature;

use App\Chat;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_see_edit_on_my_profile()
    {
        DB::table('Users')->where('id', 999)->delete();
        $this->actingAs(factory(User::class)->create(['id'=>999,'name'=>'Boy']));
        $response = $this->get('/profile/999')->assertSee('Edit');
    }
    public function test_cant_see_edit_on_others_profile()
    {
        DB::table('Users')->where('id', 999)->delete();
        DB::table('Profiles')->where('user_id', 999)->delete();
        $this->actingAs(factory(User::class)->create(['id'=>999,'name'=>'BoyWonder']));
        $response = $this->get('/profile/11')->assertDontSee('Edit');
    }
    public function test_can_edit_my_profile()
    {
        DB::table('Users')->where('id', 999)->delete();
        DB::table('Profiles')->where('user_id', 999)->delete();
        $user = factory(User::class)->create(['id'=>999,'name'=>'BoyWonder']);
        $this->actingAs($user);
        $response = $this->get('/profile/'.$user->id.'/edit')->assertOk();
    }
    public function test_can_join_chat_if_in_list(){
        DB::table('chat_user')->where('user_id', 999)->delete();
        DB::table('chats')->latest()->delete();
        DB::table('Users')->where('id', 999)->delete();
        DB::table('Profiles')->where('user_id', 999)->delete();
        $user = factory(User::class)->create(['id'=>999,'name'=>'BoyWonder']);
        $user->chats()->create([
            'name'=>'Admin BoyWonder',
            'group'=>False,
        ]);
        $user_chat = $user->chats()->first();
        $this->actingAs($user);
        $response = $this->get('/chat/'.$user_chat->id)->assertOk();
    }
}
