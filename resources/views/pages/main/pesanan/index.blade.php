<x-layout.main title="Pesanan">
    <section class="py-15 py-xl-20 pb-xl-15">
        <div class="container mt-10">
            <h1>Pesanan Anda</h1>
            <p class="text-secondary">Daftar riwayat pesanan anda.</p>
        </div>
    </section>

    <section class="py-10 py-xl-15 border-top bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>ID Pesanan</th>
                                            <th>Destinasi</th>
                                            <th>Tanggal</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($pesanan as $item)
                                            <tr>
                                                <td>
                                                    <span
                                                        @class([
                                                            'badge',
                                                            'bg-primary' => $item->status == 'Dipesan',
                                                            'bg-secondary' => $item->status == 'Dikonfirmasi',
                                                            'bg-warning' => $item->status == 'Dalam Perjalanan',
                                                            'bg-success' => $item->status == 'Selesai',
                                                            'bg-danger' => $item->status == 'Dibatalkan',
                                                        ])
                                                    >
                                                        {{ $item->status }}
                                                    </span>
                                                </td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->destinasi->wilayah }}</td>
                                                <td>{{ date('d M Y', strtotime($item->tanggal_keberangkatan)) }}</td>
                                                <td>
                                                    <a href="{{ route('main.pesanan.show', ['pesanan' => $item->id]) }}"
                                                        class="btn btn-sm btn-outline-dark">
                                                        <span>Detail</span>
                                                        <i class="ms-1 bi-arrow-right"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.main>
