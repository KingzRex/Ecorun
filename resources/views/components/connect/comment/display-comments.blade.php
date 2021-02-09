@props(['comments'])
<div x-data x-init=" () => {
    Livewire.on('newFeedback', () => {
    Livewire.hook('message.processed', function(mess, comp) {
    window.scrollTo(0, document.body.scrollHeight);
    })
    });
    @if(request()->input('active_comment'))
    history.scrollRestoration = 'manual';
    var reference = 'comment_{{request()->input('active_comment')}}';
    var comment_content = $refs[reference];
    window.addEventListener('DOMContentLoaded', () => {
    comment_content.classList.add('border-2');
    document.getElementById(reference).scrollIntoView();
    setTimeout(() => {
    comment_content.classList.remove('border-2');
    }, 2000);
    })
    @endif
    }
    ">
    @forelse($comments as $key => $comment)
    @php
    $profile = $comment->profile;
    $profile_visit_url = $profile->url->visit;
    @endphp
    <div id="comment_{{$comment->id}}" class="@if(!$loop->last) mb-2 md:mb-4 @endif">
        <div class="flex">
            <div class="mr-2 sm:mr-4">
                <a hrf="{{ $profile_visit_url }}">
                    <div style="background-image: url('{{ $profile->profile_photo_url }}'); background-size: cover; background-position: center center;"
                        class="w-10 h-10 border-t-2 border-b-2 border-blue-700 rounded-full">
                    </div>
                </a>
            </div>

            <div class="flex-shrink">
                <div x-ref="comment_{{$comment->id}}" style="border-radius: 1rem;" class="bg-gray-200 border-green-500 p-3">
                    <div class="flex self-stretch items-baseline">
                        <a href="{{ $profile_visit_url }}" class="text-xs flex-shrink flex-1 text-blue-700 font-bold">
                            {{ $profile->name }} &nbsp;<span class="text-gray-600">{{ $profile->full_tag() }}</span>
                        </a>
                    </div>
                    <x-display-text-content :content="$comment->safe_html" />
                </div>
                <div class="flex items-center mt-1">
                    <p class="mr-2">
                        {{ $comment->created_at->diffForHumans(null, null, true) }}
                    </p>
                    @can('update', [$comment, auth()->user()->currentProfile])
                    <a class="mr-2" href="{{ $comment->url->edit }}">
                        <i class="fas fa-edit text-gray-600"></i>
                    </a>

                    <a href="{{ $comment->url->delete }}">
                        <i class="fas fa-trash text-gray-600"></i>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-blue-700">
        <div class="flex justify-center">
            <i style="font-size: 3rem;" class="fas fa-comments"></i>
        </div>
        <div class="text-center">
            be the first to comment.
        </div>
    </div>
    @endforelse
</div>