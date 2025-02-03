<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="shortcut icon" href={{ asset('images/logo.png') }}>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitTrack</title>

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            scroll-behavior: smooth;
        }

        .navbar {
            display: flex;
            justify-content: space-between;


            align-items: center;
            background-color: #222;
            color: #fff;
            padding: 15px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;


            font-size: 1rem;
        }

        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: url('{{ asset("images/gym.jpg") }}') no-repeat center center/cover;
            min-height: 100vh;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .hero-text {
            width: 100%;
            max-width: 90vw;
        }

        .hero-text h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .section {
            padding: 40px 10px;
            text-align: center;
            background-color: white;
            position: relative;
            z-index: 1;
        }

        .wave {
            position: absolute;
            width: 100%;
            height: 100px;
            left: 0;
        }

        .wave-top {
            top: -100px;
            background: url('{{ asset("images/wave-top.svg") }}') no-repeat;
            background-size: cover;
        }

        .wave-bottom {
            bottom: -100px;
            background: url('{{ asset("images/wave-bottom.svg") }}') no-repeat;
            background-size: cover;
        }

        .video-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .video-container iframe {
            width: 50%;
            max-width: 90vw;
            height: auto;
            aspect-ratio: 16/9;
            border-radius: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            font-size: 1rem;
            margin: 10px 0;
        }

        footer {
            text-align: center;
            padding: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="navbar-logo">
    </div>
    <div>
        <a href="#about">O stránce</a>
        <a href="#features">Funkce</a>
        <a href="{{ url('/register') }}">Registrace</a>
        <a href="{{ route('login') }}">Login</a>
    </div>
</div>

<div id="home" class="hero">
    <div class="hero-text">
    </div>
</div>

<div class="wave wave-bottom"></div>

<div id="about" class="section">
    <h2>O stránce</h2>
    <div class="video-container">
        <iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<div class="wave wave-top"></div>

<div id="features" class="section">
    <h2>Funkce</h2>
    <ul>
        <li>Plánování tréninků</li>
        <li>Sledování pokroku</li>
        <li>Statistiky a reporty</li>
    </ul>
</div>

<footer class="footer">
    <p>&copy; 2025 Mikuláš Raisigl. Všechna práva vyhrazena.</p>
</footer>
</body>
</html>
