<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\User as ModelUser;


class User extends Component
{
    public $pilihanMenu = 'lihat';
    public $nama;
    public $email;
    public $password;
    public $peran;
    public $produkTerpilih;


    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }
    public function render()
    {
        return view('livewire.user')->with([
            'semuaPengguna'  => ModelUser::all()
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'peran' => 'required',
            'password' => 'required'
        ],[
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format musti email',
            'email.unique' => 'Email telah digunakan',
            'peran.required' => 'Peran harus dipilih',
            'password.required' => 'Password harus diisi'
        ]);

        $simpan = new ModelUser();
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        $simpan->password =bcrypt($this->peran);
        $simpan->peran = $this->peran;
        $simpan->save();

        $this->reset(['nama', 'email', 'password', 'peran']);
        $this->pilihanMenu = 'lihat';
    }

    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelUser::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function batal()
    {
        $this->reset();
    }

    public function hapus()
    {
        $this->produkTerpilih->delete();
        $this->reset();
    }

    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelUser::findOrFail($id);
        $this->nama = $this->produkTerpilih->name;
        $this->email = $this->produkTerpilih->email;
        $this->peran = $this->produkTerpilih->peran;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->produkTerpilih->id,
            'peran' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format musti email',
            'email.unique' => 'Email telah digunakan',
            'peran.required' => 'Peran harus dipilih',
        ]);

        $simpan = $this->produkTerpilih;
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        if($this->password) {
            $simpan->password =bcrypt($this->peran);
        }
        $simpan->peran = $this->peran;
        $simpan->save();

        $this->reset(['nama', 'email', 'password', 'peran', 'produkTerpilih']);
        $this->pilihanMenu = 'lihat';
    }
}
