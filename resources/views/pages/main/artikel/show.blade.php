<x-layout.main title="Artikel" footer-bg-color="dark" header-bg-color="dark">
    <article id="artikel">
        <section class="bg-black inverted overflow-hidden">
            <div class="d-flex flex-column py-15 container min-vh-75 level-3">
                <div class="row justify-content-center mt-auto">
                    <div class="col-lg-10">
                        <span class="badge bg-opaque-white text-white rounded-pill mb-2">{{ $artikel->kategori->nama }}</span>
                        <h1 class="display-1">{{ $artikel->judul }}</h1>
                    </div>
                </div>
            </div>

            <span style="background-image: url('{{ image($artikel->gambar) }}')" class="background background-gradient-horizontal" data-top-top="transform: translateY(0%);" data-top-bottom="transform: translateY(10%);"></span>
        </section>

        <section class="py-10 py-xl-15" id="articleContent">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        {!! $artikel->konten !!}
                    </div>
                </div>
            </div>
        </section>
    </article>

    <x-slot:script>
        <script>
            $('#articleContent img').addClass('img-fluid');
        </script>
    </x-slot:script>
</x-layout.main>
