<div>
    @auth
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
            <div class="form-group">
                <label for="body">Comment:</label>
                <textarea id="body" wire:model.defer="body" class="form-control"></textarea>
                @error('body') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="attachment">Upload Attachment:</label>
                <input type="file" id="attachment" wire:model="attachment" class="form-control-file">
                @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-success mt-2">Post Comment</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to add a comment.</p>
    @endauth
</div>
