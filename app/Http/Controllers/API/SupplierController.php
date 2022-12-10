<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        $result = [
            'data' => $supplier,
            'code' => 200,
            'message' => 'listing supplier successfully!',
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
        $supplier = new Supplier;
        $validated = $request->validate([
            'name_supplier' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);
        $supplier->name_supplier = $request->name_supplier;
        $supplier->alamat = $request->alamat;
        $supplier->telepon= $request->telepon;
        $supplier->save();
        
        $result = [
            'data' => $supplier,
            'code' => 200,
            'message' => 'inserted supplier successfully!',
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
        $supplier = Supplier::findOrFail($id);

        $result = [
            'data' => $supplier,
            'code' => 200,
            'message' => 'edit supplier successfully!',
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
            'name_supplier' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);
        
        $supplier = Supplier::findOrFail($id);
        $supplier->name_supplier = $request->name_supplier;
        $supplier->alamat = $request->alamat;
        $supplier->telepon= $request->telepon;
        $supplier->update();
        
        $result = [
            'data' => $supplier,
            'code' => 200,
            'message' => 'update supplier successfully!',
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
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        $result = [
            'data' => $supplier,
            'code' => 200,
            'message' => 'delete supplier successfully!',
        ];
        return response()->json($result);        
    }
}
