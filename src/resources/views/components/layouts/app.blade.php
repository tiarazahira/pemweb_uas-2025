<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloraIndah - Toko Bunga Online</title>
    <link rel="stylesheet" href="/front/assets/css/style.css">
</head>
<body>

@include('components.partial.header')

<main>
    <h2>Produk Kami</h2>
    <div id="product-list" class="product-container"></div>
</main>

@php
    use App\Models\Bunga;
    $products = Bunga::all();
@endphp

@include('components.partial.script')
@include('components.partial.footer')

</body>
</html>
