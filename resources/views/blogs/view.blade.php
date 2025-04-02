<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 antialiased">

   

    <!-- Main Content -->
    <main class="max-w-3xl mx-auto px-4 py-8">
        <!-- Featured Image -->
      

        <!-- Article Content -->
        <article class="bg-white rounded-xl shadow-md p-8 mb-8">
            <!-- Metadata -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    
                    <div>
                        <p class="font-medium text-gray-900">{{ $blog->user->name ?? 'Guest' }}</p>
                        <div class="flex space-x-2 text-sm text-gray-500">
                            <time>{{ $blog->created_at->format('M d, Y') }}</time>
                            <span>•</span>
                            <span>{{ $blog->reading_time }} min read</span>
                        </div>
                    </div>
                </div>
                
                <h1 class="text-4xl font-bold font-playfair text-gray-900 mb-4 leading-tight">
                    {{ $blog->title }}
                </h1>
                
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">Teknologi</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">Web Development</span>
                </div>
            </div>

            <!-- Content -->
            <div class="prose max-w-none mb-12">
                {{ $blog->content }}
                
                <blockquote class="border-l-4 border-blue-500 pl-4 italic text-gray-600 my-8">
                    "Ini adalah contoh blockquote yang menarik untuk menyorot poin penting dalam artikel"
                </blockquote>
                
                <p class="text-gray-600 leading-relaxed">
                    Tambahan konten contoh dengan paragraf yang lebih panjang untuk menunjukkan tata letak yang baik.
                </p>
            </div>

            <!-- Social Sharing -->
            <div class="border-t pt-8 flex items-center justify-between">
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-800">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.3.839-2.692 3.029-2.692h1.971v3z"/>
                        </svg>
                    </a>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Edit Artikel
                    </a>
                    <a href="{{ url('/blogs') }}" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </article>
        <section class="bg-white rounded-xl shadow-md p-8">
            <h3 class="text-xl font-bold mb-6">Komentar</h3>
        
            <!-- List Komentar -->
            <div class="space-y-6">
                @foreach ($blog->comments as $comment)
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium">{{ $comment->user->name ?? 'Anonim' }}</span>
                                    <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-600">{{ $comment->content }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        
            <!-- Form Tambah Komentar -->
            <form action="{{ route('comments.store', $blog->id) }}" method="POST" class="mt-6">
                @csrf
                <textarea name="content" rows="3" class="w-full border rounded-lg p-2" placeholder="Tambahkan komentar..."></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Kirim Komentar
                </button>
            </form>
        </section>
        
    </main>
</body>
</html>