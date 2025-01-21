<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;

class Produk extends Component
{
    public $pilihanMenu = 'lihat';
    public $nama;
    public $kode;
    public $harga;
    public $stok;
    public $produkTerpilih;


    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }


    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => 'required|unique:produks,kode',
            'harga' => 'required',
            'stok' => 'required'
        ],[
            'nama.required' => 'Nama harus diisi',
            'kode.required' => 'Kode harus diisi',
            'kode.unique' => 'Kode telah digunakan',
            'harga.required' => 'Harga harus diisi',
            'stok.required' => 'Stok harus diisi'
        ]);

        $simpan = new ModelProduk();
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->stok =$this->stok;
        $simpan->harga = $this->harga;
        $simpan->save();

        $this->reset(['nama', 'kode', 'stok', 'harga']);
        $this->pilihanMenu = 'lihat';
    }

    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
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
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => 'required|kode|unique:users,kode,'.$this->produkTerpilih->id,
            'harga' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi',
            'kode.required' => 'Kode harus diisi',
            'kode.kode' => 'Format musti kode',
            'kode.unique' => 'Kode telah digunakan',
            'harga.required' => 'Peran harus dipilih',
        ]);

        $simpan = $this->produkTerpilih;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        if($this->stok) {
            $simpan->stok =bcrypt($this->harga);
        }
        $simpan->harga = $this->harga;
        $simpan->save();

        $this->reset(['nama', 'kode', 'stok', 'harga', 'produkTerpilih']);
        $this->pilihanMenu = 'lihat';
    }

    public function render()
    {
        return view('livewire.produk')->with([
            'semuaProduk' => ModelProduk::all()
        ]);
    }
}
