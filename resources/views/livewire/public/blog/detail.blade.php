<div class="min-h-screen pb-24 bg-slate-50/30">
    <!-- Article Header -->
    <div class="pt-16 pb-12 lg:pt-24 lg:pb-16 bg-white border-b border-slate-100">
        <div class="max-w-4xl mx-auto px-6">
            <nav class="flex mb-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="/" class="hover:text-orange-600 transition">Beranda</a></li>
                    <li class="flex items-center space-x-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="text-orange-600 font-black">{{ $content->category->name }}</span>
                    </li>
                </ol>
            </nav>

            <h1 class="text-3xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight mb-8 uppercase">
                {{ $content->judul }}
            </h1>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-orange-600 flex items-center justify-center text-white font-black shadow-lg shadow-orange-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1.5">Penulis</p>
                        <p class="text-sm font-black text-slate-900 uppercase">Tentor {{ config('app.name', 'Murika') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <div class="text-right hidden sm:block font-black uppercase text-[10px] tracking-widest text-slate-400">
                        <p class="mb-1">Tanggal Terbit</p>
                        <p class="text-slate-900">{{ $content->created_at->format('d F Y') }}</p>
                    </div>
                    <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-orange-600 transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    <div class="max-w-6xl mx-auto px-6 -mt-8 mb-16">
        <div class="aspect-video lg:aspect-[21/9] rounded-[2rem] overflow-hidden shadow-2xl border-4 border-white">
            @if($content->image)
            <img src="{{ asset('storage/' . $content->image) }}" class="w-full h-full object-cover" alt="{{ $content->judul }}">
            @else
            <div class="w-full h-full bg-gradient-to-br from-orange-500 to-orange-400 flex items-center justify-center">
                <svg class="w-24 h-24 text-white opacity-20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                </svg>
            </div>
            @endif
        </div>
    </div>

    <!-- Article Content -->
    <div class="max-w-4xl mx-auto px-6">
        <div class="prose prose-lg lg:prose-xl prose-orange prose-slate max-w-none 
            prose-headings:font-black prose-headings:tracking-tight prose-headings:text-slate-900 prose-headings:uppercase
            prose-p:leading-relaxed prose-p:text-slate-600 prose-p:font-medium prose-img:rounded-[2rem] prose-a:font-black prose-strong:font-black prose-strong:text-slate-900">
            {!! $content->content !!}
        </div>

        <!-- Related Posts -->
        @if($related->count() > 0)
        <div class="mt-24">
            <div class="flex items-center justify-between mb-10 pb-6 border-b border-slate-100">
                <h3 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Materi Pilihan Lainnya</h3>
                <a href="/blogs" class="text-orange-600 font-black text-[10px] uppercase tracking-widest flex items-center gap-2 hover:gap-3 transition-all">Semua Materi <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($related as $rel)
                <a href="{{ route('blogs.detail', $rel->id) }}" class="group flex flex-col h-full bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500">
                    <div class="aspect-video rounded-2xl overflow-hidden mb-6 block bg-orange-50">
                        @if($rel->image)
                        <img src="{{ asset('storage/' . $rel->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $rel->judul }}">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-orange-200">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="px-2 pb-2">
                        <span class="text-orange-600 font-black text-[9px] uppercase tracking-widest mb-2 block">{{ $rel->category->name }}</span>
                        <h4 class="text-base font-black text-slate-900 group-hover:text-orange-600 transition tracking-tight line-clamp-2 leading-tight uppercase">
                            {{ $rel->judul }}
                        </h4>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>