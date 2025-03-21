<div wire:init="loadPosts">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="card">
        <div class="card-header">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Data <i
                    class="fa fa-fw fa-plus"></i></button>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Judul Kajian</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Ustadz</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_kajian as $item)
                            <tr>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ $item->tanggal_kegiatan }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-fw fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <button wire:loading.attr="disabled" type="button" data-toggle="modal"
                                                data-target="#modalUbah" class="dropdown-item"
                                                wire:click="edit('{{ $item->id }}')"><i
                                                    class="fa fa-fw fa-edit"></i>&nbsp;Ubah</button>
                                            <button wire:loading.attr="disabled" class="dropdown-item text-danger"
                                                wire:click="triggerConfirm('{{ $item->id }}')"><i
                                                    class="fa fa-fw fa-trash"></i>&nbsp;Hapus</button>
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
                    {{ $data_kajian->links() }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kajian</h5>
                    <button type="button" class="close" wire:click="resetFields()" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" wire:model.defer="nama_kegiatan"
                            class="form-control @error('nama_kegiatan') is-invalid @enderror"
                            placeholder="Judul Kajian">
                        @error('nama_kegiatan') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <input type="date" wire:model.defer="tanggal_kegiatan"
                            class="form-control @error('tanggal_kegiatan') is-invalid @enderror" placeholder="Tanggal">
                        @error('tanggal_kegiatan') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <select wire:model.defer="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            <option>Pilih Ustadz</option>
                            @foreach ($data_ustadz as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <div class="invalid-feedback">{{ $message }}</div>@enderror
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kajian</h5>
                    <button type="button" class="close" data-dismiss="modal" wire:click="resetFields()"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" wire:model.defer="nama_kegiatan"
                            class="form-control @error('nama_kegiatan') is-invalid @enderror"
                            placeholder="Judul Kajian">
                        @error('nama_kegiatan') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <input type="date" wire:model.defer="tanggal_kegiatan" class="form-control"
                            @error('tanggal_kegiatan') is-invalid @enderror placeholder="Tanggal">
                        @error('tanggal_kegiatan') <div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <select wire:model.defer="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            @foreach ($data_ustadz as $item)
                                <option value={{ $item->user_id }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id') <div class="invalid-feedback">{{ $message }}</div>@enderror
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
