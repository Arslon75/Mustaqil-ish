<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} | Recipe Hub</title>
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
        .recipe-header {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .recipe-image {
            border-radius: 15px;
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }
        .recipe-details {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-utensils me-2"></i>Recipe Hub
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

<!-- Recipe Header Section -->
<div class="recipe-header">
    <h1 class="display-4">{{ $recipe->title }}</h1>
</div>

<!-- Recipe Details Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="recipe-details">
                <img src="{{ asset('storage/' . $recipe->photo) }}" alt="{{ $recipe->title }}" class="recipe-image mb-4">

                <h3 class="mt-4">Ko'rsatmalar</h3>
                <p class="lead">{{ $recipe->description }}</p>

                <a href="{{ route('recipes.index') }}" class="btn btn-custom mt-3">Retseptlarga qaytish</a>
            </div>
        </div>
    </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
