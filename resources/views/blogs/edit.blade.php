<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Edit Blog</h1>

        <form action="{{ url('/blogs/' . $blog->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input Title -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Title</label>
                <input type="text" name="title" value="{{ $blog->title }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <!-- Input Content -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Content</label>
                <textarea name="content" rows="5"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">{{ $blog->content }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between">
                <a href="{{ url('/blogs') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>

</body>
</html>
    