<x-app-layout>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit About Us</h4>
                    <p class="card-description"> Update the record details below. </p>
                    <form action="{{ route('aboutus.update', $getId->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $getId->title) }}" placeholder="Enter title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Enter description">{{ old('description', $getId->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            <small class="text-muted">Allowed formats: jpeg, png, jpg, gif, svg. Max size: 2MB. Leave blank to keep current image.</small>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="mt-3 d-flex flex-column">
                                <label>Current/New Image:</label>
                                @if($getId->image)
                                    <img id="imagePreview" src="{{ asset('storage/' . $getId->image) }}" alt="Image Preview" style="max-width: 200px; border-radius: 5px; border: 1px solid #ddd; padding: 5px;">
                                @else
                                    <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; border-radius: 5px; border: 1px solid #ddd; padding: 5px;">
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('aboutus.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Preview image before upload
        document.getElementById('image').onchange = function (evt) {
            const [file] = this.files
            if (file) {
                const preview = document.getElementById('imagePreview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
    </script>
    @endpush
</x-app-layout>
