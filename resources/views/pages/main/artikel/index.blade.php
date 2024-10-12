<x-layout.main title="Artikel" footer-bg-color="dark" header-bg-color="white">
    <section class="py-15 py-xl-20">
        <div class="container mt-5 mt-xl-10">
            <h1 class="mb-1">Artikel</h1>

            <div class="row g-4 g-xl-5 mt-5">
                
                @foreach ($artikels as $artikel)
                    <div class="col-md-6 col-lg-4">
                        <article class="card hover-arrow">
                            <a href="{{ route('main.artikel.show', ['artikel' => $artikel->id]) }}">
                                <img
                                    src="{{ image($artikel->gambar) }}"
                                    class="card-img-top" alt="{{ $artikel->judul }}"
                                    style="object-fit: cover; object-position: center; height: 200px;"
                                />
                            </a>
                            
                            <div class="card-body p-0 pe-lg-10 mt-2">
                                <a href="{{ route('main.artikel.show', ['artikel' => $artikel->id]) }}" class="card-title">
                                    <h5>{{ Str::words($artikel->judul, 6, '...') }}</h5>
                                </a>
                                
                                <time datetime="{{ $artikel->created_at }}" class="eyebrow text-muted">
                                    {{ $artikel->created_at }}
                                </time>
                            </div>
                        </article>
                    </div>
                @endforeach
			</div>

            <div class="row mt-5 justify-content-center">
                <div class="col-auto">
                    {{ $artikels->links() }}
                </div>
            </div>
        </div>
    </section>
</x-layout.main>
