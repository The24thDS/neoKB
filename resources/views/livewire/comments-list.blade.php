<div wire:poll.5000ms>
  @if ($comments->count() > 0)
    <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4 mt-8">Comments</h1>
    @foreach ($comments as $index => $comment)
      <div wire:key="comment-{{ $comment->id }}"
        class="bg-white overflow-hidden shadow-md sm:rounded-lg p-4 grid grid-cols-5 mb-2 relative">
        <div class="flex items-center justify-around border-r pr-2">
          <img src="{{ $comment->author->profile_photo_url }}" class="rounded-full w-20" />
          <div class="flex flex-col items-center justify-center">
            <a href="" class="font-semibold">{{ $comment->author->name }}</a>
            <p class="text-sm">{{ $comment->created_at->format('j F Y') }}</p>
            <p class="text-sm">{{ $comment->created_at->format('h:m A') }}</p>
          </div>
        </div>
        <p class="col-span-4 pl-2">{{ $comment->content }}</p>
        @if ($comment->author->is(auth()->user()))
          @if (session()->has('deleted_comment_' . $comment->id))
            <div class="text-red-600 absolute right-4 top-1 font-semibold">
              {{ session("deleted_comment_$comment->id") }}
            </div>
          @else
            <button class="text-red-600 absolute right-4 top-1" wire:click="delete({{ $comment->id }})">Delete</button>
          @endif
        @endif
      </div>
    @endforeach
  @endif
</div>
