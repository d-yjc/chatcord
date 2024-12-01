<!-- resources/views/livewire/add-comment.blade.php -->

<div class="w-full">
    @auth
        <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
            <!-- Comment Textarea -->
            <div>
                <label for="body" class="block text-gray-700 font-medium mb-2">Comment:</label>
                <textarea 
                    id="body" 
                    wire:model.defer="body" 
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" 
                    rows="4" 
                    placeholder="Write your comment here..."></textarea>
                @error('body') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <div>
                <livewire:emoji-picker/>
            </div>

            <!-- Attachment Input -->
            <div>
                <label for="attachment" class="block text-gray-700 font-medium mb-2">Upload Attachment:</label>
                <input 
                    type="file" 
                    id="attachment" 
                    wire:model="attachment" 
                    class="w-full text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('attachment') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center">
                <button 
                    type="submit" 
                    class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition duration-200"
                    wire:loading.attr="disabled">
                    Post Comment
                </button>
                <span class="ml-2 text-green-500" wire:loading>Posting...</span>
            </div>
        </form>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="mt-3 text-green-600">
                {{ session('message') }}
            </div>
        @endif
    @else
        <p class="text-gray-700">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> to add a comment.</p>
    @endauth
</div>
