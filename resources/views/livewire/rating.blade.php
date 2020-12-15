<span class="flex">
  <svg
    class="{{ $upvoted ? 'scale-150' : '' }} w-5 h-5 transform rotate-90 mr-4 cursor-pointer transition duration-200 ease-in-out"
    fill="{{ $upvoted ? 'green' : 'gray' }}" viewBox="0 0 20 20" wire:click="upvote">
    <path fill-rule="evenodd"
      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
      clip-rule="evenodd"></path>
  </svg>
  <span>{{ $rating }}</span>
  <svg
    class="{{ $downvoted ? 'scale-150' : '' }} w-5 h-5 transform -rotate-90 ml-4 cursor-pointer transition duration-200 ease-in-out"
    fill="{{ $downvoted ? 'red' : 'gray' }}" viewBox="0 0 20 20" wire:click="downvote">
    <path fill-rule="evenodd"
      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
      clip-rule="evenodd"></path>
  </svg>
</span>
