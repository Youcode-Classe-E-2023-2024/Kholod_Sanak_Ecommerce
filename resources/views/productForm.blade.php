<?php
    ?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
<div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto">
        <div>
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">Product Form</p>
                    </div>
                    <!-- Product name -->
                    <div class="lg:col-span-2">

                        <form method="post" enctype="multipart/form-data" action="{{ isset($id) ? route('updateProduct', $product) : route('storeProduct') }}">
                            @csrf

                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-3">
                                        <label for="title">Product Name</label>
                                        <input type="text" id="title" name="name" placeholder="Enter your Product Name"
                                               value="{{ old('name', isset($product) ? $product->name : '') }}"
                                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                                    </div>

                                    <div class="md:col-span-3">
                                        <label for="id">Price</label>
                                        <input type="text" id="price" name="price" placeholder="Enter Your Price ....."
                                               value="{{ old('name', isset($product) ? $product->price : '') }}"

                                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                                    </div>

                                    <!-- Image  -->
                                <div class="md:col-span-3">
                                    <label for="image">Image Upload</label>
                                    <input type="file" name="image" id="image"
                                           class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                                </div>

                                <!-- Product Description -->
                                    <div class="md:col-span-3">
                                        <label for="body">Product Description</label>
                                        <input type="text" id="body" name="content" placeholder="Enter Your Product Description....."
                                               value="{{ old('name', isset($product) ? $product->content : '') }}"
                                               class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"/>
                                    </div>
                                </div>
                            <!-- Submit button-->
                            <div class="md:col-span-5 text-right">
                                <div class="inline-flex items-end">
                                    <button  id="save"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <a href="{{ route('home') }}"  class="md:absolute  bottom-0 left-0 p-10 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"></path>
            </svg>

        </a>
    </div>
</div>
</body>
</html>
