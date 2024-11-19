<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Categories') }}
        </h2>
    </x-slot>

    <div class="container">

        <form class="dark:text-gray-200" action="{{ route('categories.update', $category) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="dark:text-gray-200">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ $category->name }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Status</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input @error('status') is-invalid @enderror"
                        id="status_active" name="status" value="active"
                        {{ $category->status == 'active' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input @error('status') is-invalid @enderror"
                        id="status_inactive" name="status" value="inactive"
                        {{ $category->status == 'inactive' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status_inactive">Inactive</label>
                </div>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning mt-3">Update</button>
        </form>
    </div>
</x-app-layout>
