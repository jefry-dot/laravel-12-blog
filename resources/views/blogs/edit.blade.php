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

        <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input Title -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Judul Blog</label>
                <input type="text" name="title" value="{{ $blog->title }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <!-- Input Content -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Konten</label>
                <textarea name="content" rows="5" required
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">{{ $blog->content }}</textarea>
            </div>

            <!-- Input Reading Time -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Estimasi Waktu Baca (menit)</label>
                <input type="number" name="reading_time" value="{{ $blog->reading_time }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <!-- Input Category -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Kategori</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Teknologi" {{ $blog->category == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                    <option value="Web Development" {{ $blog->category == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                    <option value="AI" {{ $blog->category == 'AI' ? 'selected' : '' }}>Artificial Intelligence</option>
                </select>
            </div>

            <!-- Input Tags -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Tags</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($tags as $tag)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                {{ in_array($tag->id, $blog->tags->pluck('id')->toArray()) ? 'checked' : '' }}
                                class="rounded">
                            <span>{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-between">
                <a href="{{ route('blogs.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>

</body>
</html>
