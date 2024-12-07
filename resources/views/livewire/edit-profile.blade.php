<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    @auth
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h1>

        <form wire:submit.prevent="updateProfile" class="space-y-6">
            <!-- Username Input -->
            <div>
                <label for="username" class="block text-gray-700 font-medium mb-2">Username:</label>
                <input 
                    type="text" 
                    id="username" 
                    wire:model.defer="username" 
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your username">
                @error('username') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Email:</label>
                <input 
                    type="email" 
                    id="email" 
                    wire:model.defer="email" 
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your email">
                @error('email') 
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Roles (Authorized Users Only) -->
            @if (Auth::user()->hasExistingRole('admin'))
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Roles:</label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($availableRoles as $role)
                            <label class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    wire:model.defer="roles" 
                                    value="{{ $role->id }}" 
                                    class="mr-2">
                                <span class="text-gray-700">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('roles') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <!-- Submit Button -->
            <div class="flex items-center space-x-4">
                <button 
                    type="submit" 
                    class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition duration-200"
                    wire:loading.attr="disabled">
                    Save Changes
                </button>
                <a 
                    href="{{ route('profile.show', ['chatUser' => $user->id]) }}" 
                    class="inline-block bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition duration-200">
                    Cancel
                </a>
                <span class="ml-2 text-blue-500" wire:loading>Saving...</span>
            </div>
        </form>

        <!-- Success or Error Message -->
        @if (session()->has('message'))
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif
    @else
        <p class="text-gray-700">Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> to edit your profile.</p>
    @endauth
</div>
