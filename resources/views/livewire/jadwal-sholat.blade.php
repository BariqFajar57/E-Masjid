<div wire:init="loadPosts">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="card">
        <div class="card-header">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Data <i
                    class="fa fa-fw fa-plus"></i></button>
        </div>
        <div class="card-body">
            <div class="table table-responsive-sm">
                <table class="table" style="white-space: nowrap">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Imam</th>
                            <th scope="col">Khotib</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody wire:init="loadPosts">
                        @foreach ($data_sholat as $item)
                            <tr>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->imam->name }}</td>
                                <td>{{ $item->khotib->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-fw fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <button wire:loading.attr="disabled" type="button" data-toggle="modal"
                                                data-target="#modalUbah" class="dropdown-item"
                                                wire:click="edit('{{ $item->id }}','{{ $item->tanggal }}','{{ $item->imam_id }}','{{ $item->khotib_id }}')"><i
                                                    class="fa fa-fw fa-edit"></i>&nbsp;Ubah</button>
                                            <button wire:loading.attr="disabled" type="button" data-toggle="modal"
                                                data-target="#modalHapus" class="dropdown-item text-danger"
                                                wire:click="triggerConfirm('{{ $item->id }}')"><i
                                                    class="fa fa-fw fa-trash"></i> Hapus</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($readyToLoad == true)
                <div>
                    {{ $data_sholat->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Tambah-->
    <div wire:ignore.self class="modal fade" id="modalTambah" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sholat Jumat</h5>
                    <button type="button" wire:click="resetFields()" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="date" wire:model.defer="tanggal_kegiatan"
                            class="form-control @error('tanggal_kegiatan') is-invalid @enderror" placeholder="Tanggal">
                        @error('tanggal_kegiatan') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <select wire:model.defer="imam_id" class="form-control @error('imam_id') is-invalid @enderror">
                            <option>Pilih Imam</option>
                            @foreach ($imam as $item)
                                <option value={{ $item->id }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('imam_id') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <select wire:model.defer="khotib_id" class="form-control @error('khotib_id') is-invalid @enderror">
                            <option>Pilih Khotib</option>
                            @foreach ($khotib as $item)
                                <option value={{ $item->id }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('khotib_id') <div class="invalid-feedback">{{ $message }}</div>@enderror
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
    <div wire:ignore.self class="modal fade" id="modalUbah" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Sholat Jumat</h5>
                    <button type="button" wire:click="resetFields()" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="date" wire:model.defer="tanggal_kegiatan"
                            class="form-control @error('tanggal_kegiatan') is-invalid @enderror" placeholder="Tanggal">
                        @error('tanggal_kegiatan') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <select wire:model.defer="imam_id" class="form-control @error('imam_id') is-invalid @enderror">
                            @foreach ($imam as $item)
                                <option value={{ $item->id }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('imam_id') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <select wire:model.defer="khotib_id" class="form-control @error('khotib_id') is-invalid @enderror">
                            @foreach ($imam as $item)
                                <option value={{ $item->id }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('khotib_id') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="resetFields()"
                        data-dismiss="modal">Tutup</button>
                    <button type="button" wire:click="update()" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
