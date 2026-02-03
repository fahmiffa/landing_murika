<div class="min-h-screen bg-slate-50/50">
    <!-- Hero Section with Carousel -->
    <div class="relative bg-white overflow-hidden" x-data="{ 
            activeSlide: 0, 
            slides: {{ $sliders->count() }},
            next() { this.activeSlide = (this.activeSlide + 1) % this.slides },
            prev() { this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides },
            init() { 
                if(this.slides > 1) {
                    setInterval(() => this.next(), 6000) 
                }
            }
        }">

        @if($sliders->count() > 0)
        <!-- Slides -->
        <div class="relative h-[450px] md:h-[550px] lg:h-[650px] w-full overflow-hidden bg-slate-100">
            @foreach($sliders as $index => $slider)
            <div
                x-show="activeSlide === {{ $index }}"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform scale-105"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 w-full h-full">

                @if($slider->image)
                <img src="{{ asset('storage/' . $slider->image) }}" class="absolute inset-0 w-full h-full object-cover" alt="{{ $slider->title }}">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900/80 via-slate-900/40 to-transparent"></div>
                @else
                <!-- Default Orange Theme Fallback -->
                <div class="absolute inset-0 bg-gradient-to-br from-orange-600 via-orange-500 to-orange-400">
                    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'white\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>
                @endif

                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">
                        <div class="max-w-2xl text-left">
                            <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white mb-6 leading-tight tracking-tight drop-shadow-md" x-transition:enter="transition delay-300 duration-700 ease-out" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                                {{ $slider->title }}
                            </h1>
                            <p class="text-base md:text-lg text-orange-50 mb-8 leading-relaxed drop-shadow-sm font-medium" x-transition:enter="transition delay-500 duration-700 ease-out" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                                {{ $slider->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Indicators (minimalist) -->
            @if($sliders->count() > 1)
            <div class="absolute bottom-16 md:bottom-24 left-6 lg:left-8 flex gap-2 z-20">
                @foreach($sliders as $index => $slider)
                <button @click="activeSlide = {{ $index }}" class="h-1.5 rounded-full transition-all duration-300" :class="activeSlide === {{ $index }} ? 'bg-white w-10' : 'bg-white/30 w-4'"></button>
                @endforeach
            </div>
            @endif
        </div>
        @else
        <!-- Fallback Static Hero if no sliders -->
        <div class="relative bg-orange-600 py-24 md:py-32 overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'white\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center relative z-10">
                <h1 class="text-4xl md:text-6xl font-black tracking-tight text-white mb-6 uppercase">Portal Belajar {{ config('app.name', 'Murika') }}</h1>
                <p class="text-xl text-orange-100 font-medium max-w-2xl mx-auto">Tingkatkan prestasimu dengan materi belajar terbaik, tips ujian, dan info bimbel terkini.</p>
            </div>
        </div>
        @endif

    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 pb-24 mt-20">
        <!-- Section Title & Categories -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12 border-b border-slate-200 pb-8">
            <div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button
                    wire:click="selectCategory(null)"
                    class="px-5 py-2 rounded-xl text-xs font-bold transition-all uppercase tracking-wider {{ is_null($selectedCategory) ? 'bg-orange-600 text-white shadow-lg shadow-orange-100' : 'bg-white text-slate-500 hover:text-orange-600 border border-slate-200 shadow-sm' }}">
                    Semua
                </button>
                @foreach($categories as $category)
                <button
                    wire:click="selectCategory({{ $category->id }})"
                    class="px-5 py-2 rounded-xl text-xs font-bold transition-all uppercase tracking-wider {{ $selectedCategory == $category->id ? 'bg-orange-600 text-white shadow-lg shadow-orange-100' : 'bg-white text-slate-500 hover:text-orange-600 border border-slate-200 shadow-sm' }}">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Featured Post (Only on first page, no category selected) -->
        @if($featured && $contents->onFirstPage() && is_null($selectedCategory) && empty($search))
        <div class="mb-16">
            <a href="{{ route('blogs.detail', $featured->id) }}" class="group relative flex flex-col lg:flex-row bg-white rounded-[2rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-slate-100 min-h-[400px]">
                <div class="relative lg:w-3/5 overflow-hidden">
                    @if($featured->image)
                    <img src="{{ asset('storage/' . $featured->image) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="{{ $featured->judul }}">
                    @else
                    <div class="absolute inset-0 bg-orange-100 flex items-center justify-center">
                        <svg class="w-20 h-20 text-orange-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-6 left-6">
                        <span class="px-4 py-2 bg-orange-600 text-white rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-orange-200">Rekomendasi</span>
                    </div>
                </div>
                <div class="p-8 lg:p-12 lg:w-2/5 flex flex-col justify-center bg-white">
                    <span class="text-orange-600 font-black text-[10px] mb-4 uppercase tracking-[0.2em]">{{ $featured->category->name }}</span>
                    <h2 class="text-2xl lg:text-3xl font-black text-slate-900 mb-6 group-hover:text-orange-600 transition tracking-tight leading-tight">
                        {{ $featured->judul }}
                    </h2>
                    <div class="text-slate-500 line-clamp-3 mb-8 text-base leading-relaxed font-medium">
                        {!! strip_tags($featured->content) !!}
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900 uppercase tracking-wider">Tentor Murika</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $featured->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-full border border-slate-100 flex items-center justify-center group-hover:bg-orange-600 group-hover:text-white transition-all transform group-hover:rotate-45">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
            @forelse($contents as $item)
            @if(!($featured && $item->id == $featured->id && $contents->onFirstPage() && is_null($selectedCategory) && empty($search)))
            <article class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 flex flex-col h-full">
                <a href="{{ route('blogs.detail', $item->id) }}" class="relative h-56 overflow-hidden block bg-orange-50">
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $item->judul }}">
                    @else
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-100 to-orange-50 flex items-center justify-center">
                        <svg class="w-12 h-12 text-orange-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1.5 bg-white/90 backdrop-blur rounded-xl text-[10px] font-black text-orange-600 uppercase tracking-widest shadow-sm border border-white/50">{{ $item->category->name }}</span>
                    </div>
                </a>
                <div class="p-6 md:p-8 flex flex-col flex-1">
                    <div class="flex items-center text-[10px] font-black text-slate-400 mb-4 gap-4 uppercase tracking-[0.1em]">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $item->created_at->format('d M Y') }}
                        </span>
                        <span>•</span>
                        <span>10 mnt baca</span>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4 group-hover:text-orange-600 transition-colors line-clamp-2 leading-tight tracking-tight">
                        <a href="{{ route('blogs.detail', $item->id) }}">{{ $item->judul }}</a>
                    </h3>
                    <p class="text-slate-500 text-sm line-clamp-3 mb-6 leading-relaxed font-medium">
                        {!! strip_tags($item->content) !!}
                    </p>
                    <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Lembaga Murika</span>
                        </div>
                        <a href="{{ route('blogs.detail', $item->id) }}" class="text-orange-600 text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5 group/btn border-b-2 border-transparent hover:border-orange-600 transition-all pb-0.5">
                            Belajar
                            <svg class="w-3.5 h-3.5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @endif
            @empty
            <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-slate-200">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-orange-50 text-orange-400 mb-8 border-2 border-white shadow-lg">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2 uppercase tracking-tight">Belum Ada Materi</h3>
                <p class="text-slate-500 font-medium">Materi untuk kategori ini akan segera hadir. Tunggu ya!</p>
            </div>
            @endforelse
        </div>

        <div class="mt-20">
            {{ $contents->links() }}
        </div>
    </div>
</div>