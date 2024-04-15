<form wire:submit.prevent="authLogin">
    <div class="mx-5">
        <div class="mb-3">
            <label for="name" class="form-label mt-2 mb-0">Username</label>
            <input type="text" class="form-control" wire:model="username" placeholder="Username"
                value="{{ old('username') }}">
            @error('username')
                <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label mt-2 mb-0">Password</label>
            <input type="password" class="form-control" wire:model="password" placeholder="Password">
            @error('password')
                <span class="d-block text-danger fs-6 mt-1">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="d-flex mt-4 mb-5 align-items-center justify-content-center">
        <button type="submit" class="btn ">Login</button>
    </div>
</form>
