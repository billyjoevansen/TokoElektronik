<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('nama_produk', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
        }

        $perPage = $request->get('perPage', 5);

        $products = $query->latest()
                        ->paginate($perPage)
                        ->withQueryString();

        return view('produk.index', compact('products', 'perPage'));
    }

    public function dashboard()
    {
        $totalProduk = Product::count();
        $totalKategori = Product::distinct('kategori')->count('kategori');
        $produkTerbaru = Product::latest()->take(5)->get();

        $kategori = Product::selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        // Data line chart (produk per bulan)
        $produkPerBulan = Product::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        return view('dashboard', compact(
            'totalProduk',
            'totalKategori',
            'produkTerbaru',
            'kategori',
            'produkPerBulan'
        ));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fileName = null;

        if ($request->hasFile('thumbnail')) {

            $manager = new ImageManager(new Driver());

            $file = $request->file('thumbnail');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $image = $manager->read($file);

            // Resize jadi 300x300 crop tengah
            $image->cover(300, 300);

            $image->save(public_path('uploads/' . $fileName));
        }

        Product::create([
            'kategori' => $request->kategori,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'thumbnail' => $fileName
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Product $produk)
    {
        $data = $request->only(['kategori','nama_produk','harga']);

        if ($request->hasFile('thumbnail')) {

            $manager = new ImageManager(new Driver());

            $file = $request->file('thumbnail');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $image = $manager->read($file);
            $image->cover(300, 300);

            $image->save(public_path('uploads/' . $fileName));

            $data['thumbnail'] = $fileName;
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Product $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')
         ->with('success', 'Data berhasil dihapus');
    }

    public function exportPdf(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('nama_produk', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
        }

        $products = $query->get();

        $pdf = Pdf::loadView('produk.laporan_pdf', compact('products'));

        return $pdf->download('laporan-produk.pdf');
    }
}

