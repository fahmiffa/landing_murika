<div class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-orange-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 uppercase">{{ $footer->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Content Area -->
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-slate-100 overflow-hidden">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-8 border-b border-slate-100 pb-6 uppercase tracking-tight">
                {{ $footer->title }}
            </h1>

            <div class="prose prose-lg prose-orange max-w-none text-slate-600 leading-relaxed prose-headings:text-slate-900 prose-a:text-orange-600 prose-strong:text-slate-900 prose-img:rounded-2xl">
                {!! $footer->content !!}
            </div>
        </div>
    </div>
</div>