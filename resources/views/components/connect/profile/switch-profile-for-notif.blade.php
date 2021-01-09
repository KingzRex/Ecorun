@props(['profile','unreadCount','active'])
<div x-data="{ active: '{{$active}}' }" :class="(active) ? 'text-blue-700 bg-white' : ''"
    class="px-3 py-2 cursor-pointer hover:bg-white hover:text-blue-700"
    wire:click="switchProfile('{{ $profile->id }}')">
    <span>
        {{ $profile->full_tag() }}
    </span>
    @if($unreadCount > 0)
    <span class="ml-2 font-extrabold text-red-600">
        {{ $unreadCount }} <sup>new</sup>
    </span>
    @endif
</div>
