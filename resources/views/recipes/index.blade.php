<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Retseptlar Ilovasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #ff6b6b;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }

        .recipe-card {
            border: none;
            border-radius: 15px;
            background: white;
        }
        .recipe-card img {
            border-radius: 15px 15px 0 0;
            object-fit: cover;
            height: 200px;
        }
        .recipe-title {
            color: #2d3436;
            font-weight: 600;
        }
        .btn-custom {
            background-color: #ff6b6b;
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #fa5252;
            color: white;
        }
        .page-hero {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }
        .auth-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-utensils me-2"></i>Retseptlar Markazi
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recipes.index') }}">Retseptlar</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent">Chiqish</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Kirish</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Ro'yxatdan o'tish</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="page-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold">Ajoyib Retseptlarni Keshf eting</h1>
                <p class="lead">Dunyo bo'ylab mazali retseptlarni baham ko'ring va o'rganing</p>
            </div>
            <div class="col-md-6 text-md-end">
                @auth
                    <button type="button" class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#createRecipeModal">
                        <i class="fas fa-plus-circle me-2"></i>Retseptingizni Baham Ko'ring
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Retseptlar Baham Ko'rish uchun Kirish
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row g-4">
        @foreach($recipes as $recipe)
            <div class="col-md-4">
                <div class="card recipe-card">
                    @if($recipe->photo)
                        <img src="{{ asset('storage/' . $recipe->photo) }}" alt="{{ $recipe->title }}">
                    @else
                        <div class="bg-light text-center py-5">
                            <i class="fas fa-utensils fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="recipe-title">{{ $recipe->title }}</h5>
                        <p class="text-muted">{{ Str::limit($recipe->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Muallif: {{ $recipe->user->name }}</small>
                            <div class="btn-group">
                                <button onclick="copyToClipboard('{{ route('recipes.show', $recipe) }}')"
                                        class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                @auth
                                    @if(auth()->id() === $recipe->user_id)
                                        <!-- Edit Button -->
                                        <button data-bs-toggle="modal"
                                                data-bs-target="#editRecipeModalzzzz{{ $recipe->id }}"
                                                class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Delete Form -->
                                        <form action="{{ route('recipes.destroy', $recipe) }}"
                                              method="POST"
                                              onsubmit="return confirm('Ishonchingiz komilmi?')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                        <!-- Edit Recipe Modal -->
                                        <div class="modal fade" id="editRecipeModalzzzz{{ $recipe->id }}" tabindex="-1" aria-labelledby="editRecipeModalLabel{{ $recipe->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editRecipeModalLabel{{ $recipe->id }}">Retseptni Tahrirlash</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Sarlavha</label>
                                                                <input type="text" class="form-control" name="title" value="{{ $recipe->title }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Tavsif</label>
                                                                <textarea class="form-control" name="description" rows="3" required>{{ $recipe->description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Yangi Rasm (ixtiyoriy)</label>
                                                                <input type="file" class="form-control" name="photo" accept="image/*">
                                                            </div>
                                                            @if($recipe->photo)
                                                                <div class="mb-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="remove_photo" id="removePhoto{{ $recipe->id }}">
                                                                        <label class="form-check-label" for="removePhoto{{ $recipe->id }}">
                                                                            Hozirgi rasmdan voz kechish
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                                                            <button type="submit" class="btn btn-primary">Retseptni Yangilash</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $recipes->links() }}
    </div>
    @auth
        <!-- Retsept Yaratish Modal -->
        <div class="modal fade" id="createRecipeModal" tabindex="-1" aria-labelledby="createRecipeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRecipeModalLabel">Retseptingizni baham ko'ring</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                    </div>
                    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Retsept nomi</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tavsif</label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rasm</label>
                                <input type="file" name="photo" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                            <button type="submit" class="btn btn-custom">Retseptni baham ko'rish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth

</div>
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fas fa-utensils me-2"></i>Recipe Hub</h5>
                <p>Sevimli retseptlaringizni dunyo bilan baham ko'ring!</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p>© 2024 Recipe Hub. Barcha huquqlar himoyalangan.</p>
            </div>
        </div>
    </div>
</footer>
<script>
    function copyToClipboard(url) {
        navigator.clipboard.writeText(url).then(() => {
            alert("Havola nusxalandi!");
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
