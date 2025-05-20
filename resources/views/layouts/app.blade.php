<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boda Lucía y David</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fuente elegante -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #fffafc;
        }

        header {
            background-color: #f8e1ec;
            padding: 1.5rem 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        header h1 {
            font-family: 'Great Vibes', cursive;
            font-size: 2.8rem;
            color: #b44c6c;
            margin: 0;
        }

        main {
            padding: 2rem;
        }

        a {
            text-decoration: none;
        }

        .btn-primary {
            background-color: #b44c6c;
            border-color: #b44c6c;
        }

        .btn-primary:hover {
            background-color: #993a58;
            border-color: #993a58;
        }
    </style>
</head>
<body>

<header>
    <h1>Boda Lucía y David 💍</h1>
</header>

<main class="container">
    @yield('content')
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
