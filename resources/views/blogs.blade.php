<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    @if(session('success'))
    <div class="bg-green-500 text-white p-3 mb-4 rounded text-center">
        {{ session('success') }}
    </div>
@endif

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Blog List</h1>

        <!-- Tombol Tambah -->
        <div class="mb-4">
            <a href="/blogs/add" class="bg-blue-500 text-white px-4 py-2 rounded">Add New</a>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ url('/blogs') }}" class="mb-4">
            <div class="relative">
                <input type="search" name="search" value="{{ request('search') }}"
                    class="w-full pl-4 pr-10 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:outline-none"
                    placeholder="Search Title">
                <button type="submit" class="absolute right-3 top-3 text-gray-400 hover:text-blue-500">
                    Search
                </button>
            </div>
        </form>

        <!-- Tabel Blog -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border border-gray-300 p-2">#</th>
                    <th class="border border-gray-300 p-2">Title</th>
                    <th class="border border-gray-300 p-2">Author</th>
                    <th class="border border-gray-300 p-2 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $index => $blog)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 p-2">{{ ($blogs->currentPage() - 1) * $blogs->perPage() + $index + 1 }}</td>
                    <td class="border border-gray-300 p-2">{{ $blog->title }}</td>
                    <td class="border border-gray-300 p-2">{{ $blog->user->name ?? 'Guest' }}</td>
                    <td class="border border-gray-300 p-2 text-center">
                        <a href="{{ route('blogs.view', $blog->id) }}" class="text-green-500 hover:underline">view</a> |
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="text-blue-500 hover:underline">edit</a> |
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Yakin ingin menghapus blog ini?')">
                                delete
                            </button>
                        </form>
                    </td>
                    
                    
                </tr>
                @endforeach

                @if ($blogs->isEmpty())
                <div class="text-center text-gray-500 mt-6">
                    <p>Maaf, tidak ada hasil untuk <strong>"{{ request('search') }}"</strong>.</p>
                </div>
            @endif



            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center">
            {{ $blogs->links() }}
        </div>
    </div>

</body>
</html>
