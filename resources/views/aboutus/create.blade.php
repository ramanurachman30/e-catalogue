<x-app-layout>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add New About Us</h4>
                    <p class="card-description"> Fill in the form below to add a new record. </p>
                    <form action="{{ route('aboutus.store') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sub_title">Sub Title</label>
                            <input type="text" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" name="sub_title" value="{{ old('sub_title') }}" placeholder="Enter sub title">
                            @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Hero Description (Sub-title)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Enter hero description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="content_left">Content Left (Dropcap Section)</label>
                                    <textarea class="form-control @error('content_left') is-invalid @enderror" id="content_left" name="content_left" rows="5">{{ old('content_left') }}</textarea>
                                    @error('content_left')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="content_right">Content Right (Beside Image)</label>
                                    <textarea class="form-control @error('content_right') is-invalid @enderror" id="content_right" name="content_right" rows="5">{{ old('content_right') }}</textarea>
                                    @error('content_right')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                            <small class="text-muted">Allowed formats: jpeg, png, jpg, gif, svg. Max size: 2MB.</small>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="mt-3">
                                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; border-radius: 5px; border: 1px solid #ddd; padding: 5px;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('aboutus.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .note-editor.note-frame {
            border: 1px solid #dee2e6;
        }
        .note-editor.note-frame .note-editing-area .note-editable {
            background-color: #fff;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description, #content_left, #content_right').summernote({
                placeholder: 'Enter content...',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

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
