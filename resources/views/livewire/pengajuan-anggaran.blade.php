<div wire:init="loadPosts">
    {{-- Stop trying to control. --}}
    <div class="card">
        <div class="card-header">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i
                    class="fa fa-fw fa-plus"></i> Tambah</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-responsive-sm" style="white-space: nowrap">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Nilai</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->keterangan }}</td>
                                <td>Rp. {{ number_format($item->nilai, '0', ',', '.') }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <small class="text-teal">
                                            Diterima&nbsp;<i class="fa fa-fw fa-check"></i>
                                        </small>
                                    @elseif($item->status == 2)
                                        <small class="text-info">
                                            Menunggu Konfirmasi&nbsp;<i class="fa fa-fw fa-spinner fa-spin"></i>
                                        </small>
                                    @elseif($item->status == 3)
                                        <small class="text-danger">
                                            Ditolak&nbsp;<i class="fa fa-fw fa-times"></i>
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 2)
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-fw fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item" data-toggle="modal"
                                                    data-target="#modalUbah"
                                                    wire:click="edit('{{ $item->id }}','{{ $item->keterangan }}', '{{ $item->nilai }}', '{{ $item->tanggal }}')"><i
                                                        class="fa fa-fw fa-edit"></i>&nbsp;Ubah</button>
                                                <button wire:loading.attr="disabled" class="dropdown-item text-danger"
                                                    wire:click="triggerConfirm({{ $item->id }})"><i
                                                        class="fa fa-fw fa-trash"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($readyToLoad == true)
                <div>
                    {{ $data->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Tambah-->
    <div wire:ignore.self.prevent class="modal fade" data-backdrop="static" data-keyboard="false" id="modalTambah"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Pengajuan Anggaran</h5>
                    <button type="button" wire:click="resetFields()" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-calendar"></i></span>
                            <input type="date" wire:model.defer="tanggal" aria-describedby="basic-addon1"
                                class="form-control @error('tanggal') is-invalid @enderror" placeholder="tanggal">
                            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" wire:model.defer="keterangan"
                            class="form-control @error('keterangan') is-invalid @enderror" placeholder="keterangan">
                        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input min="0" type="number" wire:model.defer="nilai" aria-describedby="basic-addon1"
                                class="form-control @error('nilai') is-invalid @enderror" placeholder="100000">
                            @error('nilai') <div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="resetFields()" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="store()" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah-->
    <div wire:ignore.self.prevent class="modal fade" data-backdrop="static" data-keyboard="false" id="modalUbah"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Ubah Pengajuan Anggaran</h5>
                    <button type="button" wire:click="resetFields()" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-calendar"></i></span>
                            <input type="date" wire:model.defer="tanggal" aria-describedby="basic-addon1"
                                class="form-control @error('tanggal') is-invalid @enderror" placeholder="tanggal">
                            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" wire:model.defer="keterangan"
                            class="form-control @error('keterangan') is-invalid @enderror" placeholder="keterangan">
                        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input min="0" type="number" wire:model.defer="nilai" aria-describedby="basic-addon1"
                                class="form-control @error('nilai') is-invalid @enderror" placeholder="100000">
                            @error('nilai') <div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="resetFields()" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="update()" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
