<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $today = \Carbon\Carbon::today(); // Mengambil tanggal hari ini menggunakan Carbon
    
    // Filter berdasarkan date_in dan date_out terlebih dahulu
    $products = Product::where(function($query) use ($today) {
            $query->where('date_out', '>', $today)  // Produk dengan date_out > today
                  ->orWhere('date_out', '');        // atau date_out adalah string kosong
        })
        ->when($search, function ($query, $search) {
            // Jika ada query search, tambahkan pencarian berdasarkan merk atau seri
            return $query->where(function($query) use ($search) {
                $query->where('merk', 'like', "%{$search}%")
                      ->orWhere('seri', 'like', "%{$search}%");
            });
        })
        ->orderBy('id', 'desc')
        ->get();
    
    $total = Product::where(function($query) use ($today) {
            $query->where('date_out', '>', $today)  // Total produk dengan date_out > today
                  ->orWhere('date_out', '');        // atau date_out adalah string kosong
        })
        ->count(); // Total produk sesuai filter tanggal
    
    return view('admin.product.home', compact(['products', 'total']));
}

public function dash(Request $request)
{
    $today = \Carbon\Carbon::today(); // Mengambil tanggal hari ini menggunakan Carbon
    $total = Product::where(function($query) use ($today) {
        $query->where('date_out', '>', $today)  // Total produk dengan date_out > today
              ->orWhere('date_out', '');        // atau date_out adalah string kosong
    })
    ->count(); // Total produk sesuai filter tanggal

    $totalin = Product::where('flg_item_out', 'N')->count();  // Total produk dengan flg_item_out = 'N'

    $totalout = Product::where('flg_item_out', 'Y')
    ->where('date_out', '>', $today)->count();

    $dayName = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd'); // Nama hari, e.g., "Selasa"
    $dayDate = \Carbon\Carbon::now()->format('d');                     // Tanggal, e.g., "19"
    $month = \Carbon\Carbon::now()->format('m');                       // Bulan, format mm
    $year = \Carbon\Carbon::now()->format('y');

    return view('admin.dashboard', compact(['total', 'totalin', 'totalout', 'dayName', 'month', 'year', 'dayDate']));


}



    public function indexIn(Request $request)
    {
        $search = $request->input('search');
        
        // Query untuk mengambil produk dengan flg_item_out = 'N' dan tambahkan pencarian jika ada
        $products = Product::where('flg_item_out', 'N')  // Filter hanya produk dengan flg_item_out = 'N'
            ->when($search, function ($query, $search) {
                return $query->where(function($query) use ($search) {
                    $query->where('merk', 'like', "%{$search}%")
                          ->orWhere('seri', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->get();
        
        $total = Product::where('flg_item_out', 'N')->count();  // Total produk dengan flg_item_out = 'N'
        
        return view('admin.product.listin', compact(['products', 'total']));
    }
    

    public function indexOut(Request $request)
{
    $search = $request->input('search');
    $today = \Carbon\Carbon::today(); // Mengambil tanggal hari ini menggunakan Carbon

    // Query untuk mengambil produk dengan flg_item_out = 'Y' dan date_out <= hari ini
    $products = Product::where('flg_item_out', 'Y')  // Filter hanya produk dengan flg_item_out = 'Y'
        ->where('date_out', '>', $today)  // Tambahkan filter untuk date_out <= today
        ->when($search, function ($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('merk', 'like', "%{$search}%")
                      ->orWhere('seri', 'like', "%{$search}%");
            });
        })
        ->orderBy('id', 'desc')
        ->get();
        
    $total = Product::where('flg_item_out', 'Y')
        ->where('date_out', '>', $today)  // Total produk sesuai filter date_out <= today
        ->count();  // Hitung total produk
    
    return view('admin.product.listout', compact(['products', 'total']));
}
    

    public function create()
    {
        return view('admin.product.create');
    }
    
    public function save(Request $request)
{
    $validation = $request->validate([
        'merk' => 'required',
        'spek' => 'required',
        'lokasi' => 'required',
        'seri' => 'required|unique:products,seri',
        'keterangan' => 'required',
        'status' => 'required',
    ]);
    
    $data = Product::create($validation);
    
    if ($data) {
        History::create([
            'product_id' => $data->id,
            'merk' => $data->merk,
            'seri' => $data->seri,
            'keterangan' => $data->keterangan,
            'tipe' => 'ADD'
        ]);
        
        session()->flash('success', 'Product Added Successfully');
        return redirect(route('admin/products'));
    } else {
        session()->flash('error', 'Some problem occurred');
        return redirect(route('admin.products/create'));
    }
}


    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('admin.product.update', compact('products'));
    }

    public function editOut($id)
    {
        $products = Product::findOrFail($id);
        return view('admin.product.out', compact('products'));
    }

    public function updateOut(Request $request, $id)
{
    $validation = $request->validate([
        'keterangan' => 'required',
        'status' => 'required',
        'dateout' => 'required|date',
    ]);

    $product = Product::findOrFail($id);
    $product->update([
        'keterangan' => $request->keterangan,
        'status' => $request->status,
        'date_out' => $request->dateout,
        'flg_item_out' => 'Y',
    ]);

    // Buat entri di History jika update berhasil
    History::create([
        'product_id' => $product->id,
        'merk' => $product->merk,
        'seri' => $product->seri,
        'keterangan' => $product->keterangan,
        'tipe' => 'OUT'
    ]);

    session()->flash('success', 'Product Updated Successfully');
    return redirect()->route('admin/products');
}

    
    public function delete($id)
{
    // Cari produk berdasarkan ID, jika tidak ada maka akan error
    $product = Product::findOrFail($id);
    
    // Buat entri di tabel history sebelum produk dihapus
    History::create([
        'product_id' => $id,
        'merk' => $product->merk,
        'seri' => $product->seri,
        'keterangan' => $product->keterangan,
        'tipe' => 'DELETE'
    ]);
    
    // Hapus produk dari tabel products
    $product->delete();
    
    // Beri pesan sukses ke session dan redirect ke halaman daftar produk
    session()->flash('success', 'Product Deleted Successfully');
    return redirect(route('admin/products'));
}


    public function update(Request $request, $id)
{
    $validation = $request->validate([
        'merk' => 'required',
        'spek' => 'required',
        'lokasi' => 'required',
        'seri' => 'unique:products,seri,' . $id,
        'keterangan' => 'required',
        'status' => 'required',
    ]);
    
    $products = Product::findOrFail($id);
    $products->update($validation);
    
    if ($products) {
        History::create([
            'product_id' => $id,
            'merk' => $products->merk,
            'seri' => $products->seri,
            'keterangan' => $products->keterangan,
            'tipe' => 'EDIT'
        ]);
        
        session()->flash('success', 'Product Update Successfully');
        return redirect(route('admin/products'));
    } else {
        session()->flash('error', 'Some problem occurred');
        return redirect(route('admin/products/update'));
    }
}
}