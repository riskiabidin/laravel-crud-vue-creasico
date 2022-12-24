<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\detail_penjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::with('member')->get();
        $result = [
            'data' => $penjualan,
            'code' => 200,
            'message' => 'listing penjualan successfully!',
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
            'id_member' => 'required',
            'total_harga' => 'required'
        ]);
        $penjualan = new Penjualan;
        $penjualan->id_member = $request->id_member;
        $penjualan->total_harga = $request->total_harga;
        $penjualan->save();

        foreach ($request->detail as $row) {
            detail_penjualan::create([
                'id_penjualan' => $penjualan->id,
                'id_produk' => $row['id_produk'],
                'harga_jual' => $row['harga_jual'],
                'jumlah' => $row['jumlah'],
                'sub_total' => $row['sub_total']
            ]);
        }
        $result = [
            'data' => $penjualan,
            'code' => 200,
            'message' => 'inserted penjualan successfully!',
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
        $penjualan = Penjualan::with('detail.produk')->findOrFail($id);;//nested relathionship acces function produk in detail_penjualan model
         $result = [
             'data' => $penjualan,
             'code' => 200,
             'message' => 'edit penjualan successfully!',
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
            'id_member' => 'required',
            'total_harga' => 'required'
        ]);
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->id_member = $request->id_member;
        $penjualan->total_harga = $request->total_harga;
        $penjualan->save();

        for($i=0;$i<count($request->delete);$i++){
            $detail_penjualan = detail_penjualan::findOrFail($request->delete[$i]);
            $detail_penjualan->delete();
        }

        foreach ($request->detail as $row) {
            detail_penjualan::updateOrCreate(
                ['id' => $row['id'],],
                [
                    'id_penjualan' => $penjualan->id,
                    'id_produk' => $row['id_produk'],
                    'harga_jual' => $row['harga_jual'],
                    'jumlah' => $row['jumlah'],
                    'sub_total' => $row['sub_total']
                ]
            );
        }

        $result = [
            'data' => $penjualan,
            'code' => 200,
            'message' => 'update penjualan successfully!',
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
       $penjualan = Penjualan::findOrFail($id);
       $penjualan->delete();
        $result = [
            'data' => $penjualan,
            'code' => 200,
            'message' => 'delete penjualan successfully!',
        ];

        return response()->json($result);
    }
}
