<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Home Page</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm bg-light">
        <div class="container-lg">
            <a class="navbar-brand fw-bold">Project</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="btn btn-outline-dark d-none d-lg-block"
                href="{{ Auth::check() ? route('dashboard') : route('login') }}">
                Admin
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero bg-light py-5">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-3 fw-bold">Hello Guys!</h1>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum laoreet
                        finibus. Sed porta lobortis metus sed commodo. Fusce convallis vestibulum velit, id imperdiet
                        metus faucibus nec.</p>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://codingyaar.com/wp-content/uploads/barista.png" class="img-fluid rounded"
                        alt="Hero Image">
                </div>
            </div>
        </div>
    </section>

    <!-- Category Section -->
    <section class="categories py-5 bg-light">
        <div class="container-lg">
            <h2 class="text-center mb-4">Categories</h2>
            <div class="row">
                @forelse ($categories as $category)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                                </h5>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">No products found in this category.</div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="text-center p-3 bg-body-tertiary mt-auto">
        <div>&copy; 2024. All Rights Reserved.</div>
    </footer>

</body>

</html>
