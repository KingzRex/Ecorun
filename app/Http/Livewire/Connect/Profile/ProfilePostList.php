<?php

namespace App\Http\Livewire\Connect\Profile;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;
use App\Models\Profile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ProfilePostList extends Component
{
    public Profile $profile;
    public $activePost;
    public $view;
    public $displayOptions;
    public $readyToLoad = false;

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }

    public function triggerOptions(Post $post)
    {
        $this->activePost = $post;
        return $this->displayOptions = true;
    }

    public function render()
    {
        return view('livewire.connect.profile.profile-post-list', [
            'posts' => $this->readyToLoad ?
                /* Cache::remember(
                    'posts.' . $this->profile->id,
                    now()->addSeconds(2),
                    function () {
                        return Post::without('profile.followers')->whereIn('profile_id', $this->profile->profileable->following->pluck('id'))->latest()->get();
                    }
                ) */ Post::without('profile.followers')->whereIn('profile_id', ($this->view === 'landing-page') ? $this->profile->following->pluck('id') : [$this->profile->id])->latest()->get() : []
        ]);
    }
}