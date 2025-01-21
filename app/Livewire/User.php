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
    public $penggunaTerpilih;


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
        $this->penggunaTerpilih = ModelUser::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function batal()
    {
        $this->reset();
    }

    public function hapus()
    {
        $this->penggunaTerpilih->delete();
        $this->reset();
    }
}
