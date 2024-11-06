<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Recipe App')</title>
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
            transition: transform 0.3s, box-shadow 0.3s;
            background: white;
        }
        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
            <i class="fas fa-utensils me-2"></i>Recipe Hub
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recipes.index') }}">Recipes</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fas fa-utensils me-2"></i>Recipe Hub</h5>
                <p>Share your favorite recipes with the world!</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p>© 2024 Recipe Hub. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
