<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Semua Pengguna
                </button>
                <button wire:click="pilihMenu('tambah')"
                    class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Tambah Pengguna
                </button>
                <button wire:loading class="btn btn-info">
                    Loading...
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if ($pilihanMenu == 'lihat')
                    <div class="card border-primary">
                        <div class="card-header">
                            Semua Pengguna
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Data</th>
                                </thead>
                                <tbody>
                                    @foreach ($semuaPengguna as $pengguna)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pengguna->name }}</td>
                                            <td>{{ $pengguna->email }}</td>
                                            <td>{{ $pengguna->peran }}</td>
                                            <td>
                                                <button wire:click="pilihMenu('edit')"
                                                    class="btn {{ $pilihanMenu == 'edit' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                    Edit Pengguna
                                                </button>
                                                <button wire:click="pilihMenu('hapus')"
                                                    class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">
                                                    Hapus Pengguna
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'tambah')
                    <div class="card border-primary">
                        <div class="card-header">
                            Tambah Pengguna
                        </div>
                        <div class="card-body">
                            <form action="" wire:submit='simpan'>
                                <label for="">Nama</label>
                                <input type="text" class="form-control" wire:model='nama' name="" id="">
                                @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="">Email</label>
                                <input type="email" class="form-control" wire:model='email' name="" id="">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="">Password</label>
                                <input type="password" class="form-control" wire:model='password' name="" id="">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <label for="">Peran</label>
                                <select name="" id="" class="form-control" wire:model='peran'>
                                    <option>--Pilih peran--</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('peran')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </form>
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'edit')
                    <div class="card border-primary">
                        <div class="card-header">
                            Edit Pengguna
                        </div>
                        <div class="card-body">
                            test
                        </div>
                    </div>
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card border-primary">
                        <div class="card-header">
                            Hapus Pengguna
                        </div>
                        <div class="card-body">
                            test
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
