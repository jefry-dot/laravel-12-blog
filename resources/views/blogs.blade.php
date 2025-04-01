<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <form method="GET" action="{{ url('/blogs') }}" class="max-w-2xl mx-auto">
        <div class="relative">
            <input type="search" name="search" value="{{ request('search') }}"
                class="w-full pl-4 pr-10 py-3 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-colors"
                placeholder="Cari artikel...">
            <button type="submit" class="absolute right-3 top-3 text-gray-400 hover:text-blue-500">
                <i class='bx bx-search-alt-2 text-xl'></i>
            </button>
        </div>
    </form>
 
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Daftar Blog</h1>

        @foreach ($blogs as $blog)
            <div class="p-4 border-b border-gray-300">
                <h2 class="text-xl font-semibold text-blue-600">{{ $blog->title }}</h2>
                <p class="text-gray-600">{{ Str::limit($blog->content, 100) }}</p>
                <a href="#" class="text-sm text-blue-500 hover:underline">Baca selengkapnya</a>
            </div>
        @endforeach

        @if ($blogs->isEmpty())
    <div class="text-center text-gray-500 mt-6">
        <p>Maaf, tidak ada hasil untuk <strong>"{{ request('search') }}"</strong>.</p>
    </div>
@endif
        <!-- Pagination -->
        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>

</body>
</html>
