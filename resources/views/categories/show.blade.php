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
    <title>Product Page</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm bg-light">
        <di class="container-lg">
            <a class="navbar-brand fw-bold">Project</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="btn btn-outline-dark d-none d-lg-block" href="{{ route('dashboard') }}">Admin</a>
            </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero bg-light py-5" id="hero">
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

    <section class="products py-5 bg-light">
        <div class="container-lg">
            <h2 class="text-center mb-4">{{ $category->name }} Products</h2>

            @if ($products->isEmpty())
                <div class="alert alert-info text-center">No products found in this category.</div>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card shadow-sm h-100">
                                @if (isset($product->image) && $product->image != '' && file_exists(public_path($product->image)))

                                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                <img src="{{ asset('images/products/defult.jpeg') }}" class="card-img-top" alt="{{ $product->name }}">

                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                                </div>
                                {{-- <div class="card-footer text-center">
                                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Details</a>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="btn btn-info">Back to Home</a>
            </div>
        </div>
    </section>

</body>

</html>
