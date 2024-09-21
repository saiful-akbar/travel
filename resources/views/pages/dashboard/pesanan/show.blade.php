<x-layout.dashboard title="Detail Pesanan">
    <x-slot:header-action>
        <x-button type="link" href="{{ route('dashboard.pesanan') }}" color="white" start-icon="bi-chevron-left" role="button">
            Kembali
        </x-button>
    </x-slot:header-action>

    <x-slot:header-content>
        <span class="badge bg-soft-success text-success">
            <span class="legend-indicator bg-success"></span>{{ $pesanan->status }}
        </span>
        <span class="ms-2 ms-sm-3">
            <i class="bi-calendar-week"></i> {{ $pesanan->created_at }}
        </span>
    </x-slot:header-content>

    {{-- content --}}
    <div class="row">
        <div class="col-lg-8 mb-3 mb-lg-0">
            <div class="card mb-3 mb-lg-5">
                <div class="card-header card-header-content-between">
                    <h4 class="card-header-title">Detail pesanan</h4>
                    <a class="link" href="javascript:;">Edit</a>
                </div>

                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-xl">
                                <img class="img-fluid" src="{{ image($pesanan->unitKendaraan->kendaraan->gambar) }}" alt="Kendaraan">
                            </div>
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h5 class="h5 d-block">
                                        {{ $pesanan->unitKendaraan->kendaraan->merek }} {{ $pesanan->unitKendaraan->kendaraan->tipe }}
                                    </h5>

                                    <div class="fs-6 text-body">
                                        <span>Gender:</span>
                                        <span class="fw-semibold">Women</span>
                                    </div>
                                    <div class="fs-6 text-body">
                                        <span>Color:</span>
                                        <span class="fw-semibold">Green</span>
                                    </div>
                                    <div class="fs-6 text-body">
                                        <span>Size:</span>
                                        <span class="fw-semibold">UK 7</span>
                                    </div>
                                </div>

                                <div class="col col-md-2 align-self-center">
                                    <h5>$21.00</h5>
                                </div>

                                <div class="col col-md-2 align-self-center">
                                    <h5>2</h5>
                                </div>

                                <div class="col col-md-2 align-self-center text-end">
                                    <h5>$42.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row justify-content-md-end mb-3">
                        <div class="col-md-8 col-lg-7">
                            <dl class="row text-sm-end">
                                <dt class="col-sm-6">Subtotal:</dt>
                                <dd class="col-sm-6">$65.00</dd>
                                <dt class="col-sm-6">Shipping fee:</dt>
                                <dd class="col-sm-6">$0.00</dd>
                                <dt class="col-sm-6">Tax:</dt>
                                <dd class="col-sm-6">$7.00</dd>
                                <dt class="col-sm-6">Total:</dt>
                                <dd class="col-sm-6">$65.00</dd>
                                <dt class="col-sm-6">Amount paid:</dt>
                                <dd class="col-sm-6">$65.00</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Pemesan</h4>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush list-group-no-gutters">
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img" src="{{ photo($pesanan->user->foto) }}" alt="Foto">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <span class="text-body text-inherit">{{ $pesanan->user->nama_lengkap }}</span>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Kontak info</h5>
                                <a class="link" href="{{ route('dashboard.user.edit', ['user' => $pesanan->user->id]) }}">Edit</a>
                            </div>

                            <ul class="list-unstyled list-py-2 text-body">
                                <li><i class="bi-at me-2"></i>{{ $pesanan->user->email }}</li>
                                <li><i class="bi-phone me-2"></i>{{ $pesanan->user->telepon }}</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layout.dashboard>
