<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        .drag-area {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .drag-area.dragover {
            background-color: #f9f9f9;
        }
        .preview {
            margin-top: 20px;
            text-align: center;
        }
        .preview img {
            max-width: 100%;
            max-height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <form action="{{URL::to('/upload')}}" method="get" enctype="multipart/form-data" id="uploadForm">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image" style="display: none;">
            
            <div class="drag-area" id="dragArea">
                <p>Kéo thả ảnh vào đây hoặc bấm để chọn ảnh</p>
            </div>
        </div>
        <div class="preview" id="preview">
            <!-- Image preview will be shown here -->
        </div>
        <button type="submit" class="btn btn-success">Submit Information</button>
    </form>
</div>

<script>
    const dragArea = document.getElementById('dragArea');
    const imageInput = document.getElementById('image');
    const preview = document.getElementById('preview');

    dragArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dragArea.classList.add('dragover');
    });

    dragArea.addEventListener('dragleave', () => {
        dragArea.classList.remove('dragover');
    });

    dragArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dragArea.classList.remove('dragover');
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            showImagePreview(files[0]);
            dragArea.innerHTML = `<p>${files[0].name} đã được chọn</p>`;
        }
    });

    dragArea.addEventListener('click', () => {
        imageInput.click();
    });

    imageInput.addEventListener('change', () => {
        if (imageInput.files.length > 0) {
            showImagePreview(imageInput.files[0]);
            dragArea.innerHTML = `<p>${imageInput.files[0].name} đã được chọn</p>`;
        }
    });

    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview">`;
        };
        reader.readAsDataURL(file);
    }
</script>
</body>
</html>
