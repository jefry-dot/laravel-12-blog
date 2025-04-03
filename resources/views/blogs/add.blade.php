<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Tambah Blog Baru</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <strong>Oops! Ada kesalahan:</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Judul Blog:</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Konten:</label>
                <textarea name="content" id="content" rows="5" class="w-full px-4 py-2 border rounded-lg" required></textarea>
            </div>

            <div class="mb-4">
                <label for="reading_time" class="block text-gray-700 font-bold mb-2">Estimasi Waktu Baca (menit):</label>
                <input type="number" name="reading_time" id="reading_time" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-bold mb-2">Kategori:</label>
                <select name="category" id="category" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Teknologi">Teknologi</option>
                    <option value="Web Development">Web Development</option>
                    <option value="AI">Artificial Intelligence</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tags:</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($tags as $tag)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded">
                            <span>{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Thumbnail</label>
                <input type="file" name="thumbnail" accept="image/*"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ url('/blogs') }}" class="ml-2 text-gray-600">Batal</a>

        </form>
    </div>

</body>
</html>
