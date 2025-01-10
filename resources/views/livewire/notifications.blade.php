<div class="p-4">
    <x-button class="mb-3" wire:click="delete">Clear Notifications</x-button>
    @foreach (auth()->user()->Notifications as $notification)
    <div class="@if(!$notification->read_at) bg-blue-700 @endif mb-2 rounded-lg border p-2">
    <x-dropdown-link class="flex justify-between" href="{{$notification->data['link']}}">
       <span> {{ $notification->data['message'] }}</span>
       <span> {{ $notification->created_at->diffForHumans() }}</span>
    </x-dropdown-link>
    </div>
    @endforeach
</div>
