<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dribbble Clone</title>

    @vite('resources/css/app.css')

</head>

<body>

<div class="dribbble-home">

    <!-- NAVBAR -->
    <nav class="dribbble-navbar">

        <div class="logo">
            dribbble
        </div>

        <div class="nav-links">
            <a href="#">Animation</a>
            <a href="#">Branding</a>
            <a href="#">Discover</a>
            <a href="#">Illustration</a>
            <a href="#">Mobile</a>
        </div>

    </nav>


    <!-- HERO -->
    <section class="dribbble-hero">

        <div class="hero-left">

            <h1>
                Discover the World's Top Designers
            </h1>

            <p>
                Explore work from the most talented and accomplished
                designers ready to take on your next project.
            </p>

            <div class="hero-search">

                <input type="text"
                       placeholder="What type of design are you interested in?">

                <button>🔍</button>

            </div>

        </div>

        <div class="hero-right">

            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1200&auto=format&fit=crop">

        </div>

    </section>


    <!-- SHOTS -->
    <section class="shots-grid">

        @foreach($shots as $shot)

        <div class="shot-card">

            <img src="{{ $shot->image ?? 'https://picsum.photos/500/400' }}">

            <div class="shot-info">

                <h3>{{ $shot->title }}</h3>

                <p>
                    {{ $shot->user->username ?? 'Unknown' }}
                </p>

            </div>

        </div>

        @endforeach

    </section>

</div>

</body>
</html>