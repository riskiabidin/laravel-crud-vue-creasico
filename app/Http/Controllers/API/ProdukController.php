<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = produk::all();
        $produk = produk::with('category')->get();
        
        $result = [
            'data' => $produk,
            'code' => 200,
            'message' => 'listing produk successfully!',
        ];

        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required',
            'id_category' => 'required',
            'name_produk' => 'required',
            'merk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
        ]);
        $produk = new produk;
        $produk->kode_produk = $request->kode_produk;
        $produk->id_category = $request->id_category;
        $produk->name_produk = $request->name_produk;
        $produk->merk = $request->merk;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stock = $request->stock;
        $produk->save();

        $result = [
            'data' => $produk,
            'code' => 200,
            'message' => 'inserted produk successfully!',
        ];

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = produk::findOrFail($id);
        $result = [
            'data' => $produk,
            'code' => 200,
            'message' => 'edit produk successfully!',
        ];
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_produk' => 'required',
            'id_category' => 'required',
            'name_produk' => 'required',
            'merk' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
        ]);
        $produk = produk::findOrFail($id);
        $produk->kode_produk = $request->kode_produk;
        $produk->id_category = $request->id_category;
        $produk->name_produk = $request->name_produk;
        $produk->merk = $request->merk;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stock = $request->stock;
        $produk->update();

        $result = [
            'data' => $produk,
            'code' => 200,
            'message' => 'update produk successfully!',
        ];
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = produk::findOrFail($id);
        $produk->delete();
        $result = [
            'data' => $produk,
            'code' => 200,
            'message' => 'delete produk successfully!',
        ];
        return response()->json($result);
    }
}
