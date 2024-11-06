<!-- resources/views/recipes/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Recipes</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRecipeModal">
            Create Recipe
        </button>
    </div>

    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($recipe->photo)
                        <img src="{{ asset('storage/' . $recipe->photo) }}" class="card-img-top" alt="{{ $recipe->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->title }}</h5>
                        <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $recipes->links() }}
    </div>
</div>

<!-- Create Recipe Modal -->
<div class="modal fade" id="createRecipeModal" tabindex="-1" aria-labelledby="createRecipeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRecipeModalLabel">Create New Recipe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Recipe</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
