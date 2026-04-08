<x-app-layout>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Catalogue</h4>
                    <p class="card-description"> Update the record details below. </p>
                    <form action="{{ route('mcatalogue.update', $getId->id) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $getId->name) }}" placeholder="Enter name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="author">Author of Painting</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $getId->author) }}" placeholder="Enter Author of Painting" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="author">Price</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $getId->author) }}" placeholder="Enter Author of Painting" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $getId->category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status_id">Status</label>
                            <select name="status_id" id="status_id" class="form-control @error('status_id') is-invalid @enderror" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" @selected(old('status_id', $getId->status_id) == $status->id)>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter description" required>{{ old('description', $getId->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Image Upload</label>
                            <input type="file" name="img" class="file-upload-default @error('img') is-invalid @enderror">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                            <small class="text-muted">Leave empty to keep current image.</small>
                            @error('img')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            @if($getId->img)
                                <div class="mt-3">
                                    <p>Current Image:</p>
                                    <img src="{{ asset('storage/' . $getId->img) }}" alt="{{ $getId->name }}" style="width: 150px; height: auto; border-radius: 10px;">
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="date_release">Date Release</label>
                            <input type="date" class="form-control @error('date_release') is-invalid @enderror" id="date_release" name="date_release" value="{{ old('date_release', $getId->date_release) }}" placeholder="Enter Date Release" required>
                            @error('date_release')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="size_painting">Size of Painting</label>
                            <input type="text" class="form-control @error('size_painting') is-invalid @enderror" id="size_painting" name="size_painting" value="{{ old('size_painting', $getId->size_painting) }}" placeholder="Enter Size Of Painting" required>
                            @error('size_painting')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('mcatalogue.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    @endpush
</x-app-layout>
