<x-layout.member title="Tagihan">
    <h1>Tagihan</h1>

    {{-- Tabel daftar tagihan --}}
    <section>
        <div class="card bg-white">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>ID Pesanan</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach ($tagihan as $item)
                                <tr style="cursor: pointer" onclick="return handleDetail('{{ $item->id }}')">
                                    <td>
                                        <span
                                            @class([
                                                'badge',
                                                'bg-success' => $item->status == 'Lunas',
                                                'bg-danger' => $item->status == 'Belum Bayar',
                                            ])
                                        >
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>{{ $item->pesanan->id }}</td>
                                    <td>Rp {{ number_format($item->jumlah) }}</td>
                                    <td>{{ $item->tanggal_pembayaran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal detail --}}
    <div class="modal fade" id="modalDetailTagihan" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="bi bi-x modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
                <div class="modal-body p-8 text-center">
                    <h3 id="modalLabel">Save on Premium Membership</h3>
                    
                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam saepe tempore illo
                        dolorem, maiores, sit
                        vitae ducimus officiis reprehenderit, laudantium recusandae. Laborum iste aperiam harum.
                    </p>
                    
                    <div class="d-grid gap-1 w-100 mt-3">
                        <button type="button" class="btn btn-primary rounded-pill">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot:script>

        {{-- Show detail --}}
        <script>
            const handleDetail = (id) => {
                $('#preloader').fadeIn();

                const baseUrl = $('meta[name=base-url]').attr('content');

                $.ajax({
                    type: "get",
                    url: `${baseUrl}/tagihan/${id}`,
                    dataType: "json",
                    success: function (response) {
                        new bootstrap.Modal($('#modalDetailTagihan'), {}).show();
                    },
                    error: function(error) {
                        alert(`Error - ${error.status} ${error.statusText}`)
                    },
                    complete: function() {
                        $('#preloader').fadeOut();
                    }
                });
            }
        </script>

    </x-slot:script>

</x-layout.member>