<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>


</head>
<body>

<div  class="bg-white">
    <header>
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="hidden w-full text-gray-600 md:flex md:items-center">
                    <a href="{{ route('home') }}" class="text-black hover:text-blue-500 focus:outline-none focus:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"><path d="M 12 2.0996094 L 1 12 L 4 12 L 4 21 L 11 21 L 11 15 L 13 15 L 13 21 L 20 21 L 20 12 L 23 12 L 12 2.0996094 z M 12 4.7910156 L 18 10.191406 L 18 11 L 18 19 L 15 19 L 15 13 L 9 13 L 9 19 L 6 19 L 6 10.191406 L 12 4.7910156 z"/></svg>
                    </a>
                </div>
                <div class="w-full text-gray-700 md:text-center text-2xl font-semibold">
                    Brand
                </div>
                <div class="flex items-center justify-end w-full">
                    <button onclick="window.location.href='{{ route('productForm') }}'" class="p-2 rounded-full border-2 border-white mx-5 -mb-4 hover:border-black focus:outline-none focus:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </button>



                    <div class="flex sm:hidden">
                        <button  type="button" class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500" aria-label="toggle menu">
                            <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="sm:flex sm:justify-center sm:items-center mt-4">
                <div class="flex flex-col sm:flex-row">
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Home</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Shop</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Categories</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Contact</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a>
                </div>
            </nav>
            <div class="relative mt-6 max-w-lg mx-auto">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>

                <input class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline" type="text" placeholder="Search">
            </div>
        </div>
    </header>
{{--Products list --}}
    <main class="my-8">
        <div class="container mx-auto px-6">

                            <div class="block">
                                <h3 class="text-gray-700 text-2xl font-medium">Product List</h3>
                                <span class="mt-3 text-sm text-gray-500">{{ $productCount }} Products</span>
                            </div>
            <div class="flex justify-end">

                {{--            Select start --}}
                <div class=" ">
                    <form action="{{ route('home') }}" method="get">
                        @csrf
                        <label for="select" class="font-semibold block py-2">Filter Products by:</label>
                        <div class="relative">
                            <select name="sort" class="text-sm sm:text-base text-gray-800 outline-none border-2 px-4 sm:px-4 py-1 rounded-lg">
                                <option value="alphabetically" >Alphabetically  </option>
                                <option value="date" >Date</option>
                            </select>
                        </div>
                        <button type="submit" class="mt-4 px-2 py-1 bg-blue-500 text-white rounded cursor-pointer">Sort</button>
                    </form>
                </div>
           </div>

            {{--            select end--}}
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                {{--                    product card --}}
            @foreach($products as $product)
                <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full">
                            <img class="w-full h-full object-fit" src="{{ $product->image }}" alt="{{ $product->name }}">

                    </div>

                    <div class="flex justify-between">
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                            <span class="text-gray-500 mt-2">${{ $product->price }}</span>
                        </div>
                        <a href="{{ route('showProduct', ['id' => $product->id]) }}"
                            class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach


            </div>
{{--            pagination--}}
            <div class="flex justify-center ">
                <div class="flex rounded-md mt-8">
                    {{ $products->links ()}}

                </div>
            </div>

        </div>
    </main>

    <footer class="bg-gray-200">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
            <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
        </div>
    </footer>
</div>


</body>
</html>
