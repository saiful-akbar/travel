<x-layout.member title="Pesanan Anda">
    <h2>Pesanan Anda</h2>

    <section>
        <div class="card bg-white">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Destinasi</th>
                                <th>Jadwal</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pesanans as $pesanan)
                                <tr>
                                    <td>
                                        <span
                                            @class([
                                                'badge',
                                                'rounded-pill',
                                                'bg-primary' => $pesanan->status === 'Dipesan',
                                                'bg-secondary' => $pesanan->status === 'Konfirmasi',
                                                'bg-warning' => $pesanan->status === 'Proses',
                                                'bg-success' => $pesanan->status === 'Selesai',
                                                'bg-danger' => $pesanan->status === 'Batal',
                                            ])
                                        >
                                            {{ $pesanan->status }}
                                        </span>
                                    </td>
                                    <td>{{ $pesanan->destinasi->wilayah }}</td>
                                    <td>{{ date("d M Y", strtotime($pesanan->tanggal_keberangkatan)) }} s/d {{ date("d M Y", strtotime($pesanan->tanggal_kepulangan)) }}</td>
                                    <td>
                                        <a href="{{ route('main.pesanan.show', ['pesanan' => $pesanan->id]) }}" class="btn btn-sm btn-dark rounded-pill">
                                            <span>Detail</span>
                                            <i class="bi-arrow-right ms-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-center align-item-center">
                {{ $pesanans->links() }}
            </div>
        </div>
    </section>

    <x-slot:script>

        <script>
            function toDetail(id) {
                const baseUrl = "{{ url('/') }}";

                console.log(`${baseUrl}/pesanan/${id}`);
            }
        </script>

    </x-slot:script>
</x-layout.member>
