<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Member::all();
        $result = [
            'data' => $member,
            'code' => 200,
            'message' => 'listing member successfully!',
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
            'kode_member' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);
        $member = new Member;
        $member->kode_member= $request->kode_member;
        $member->nama= $request->nama;
        $member->alamat= $request->alamat;
        $member->telepon= $request->telepon;
        $member->save();

        $result = [
            'data' => $member,
            'code' => 200,
            'message' => 'insert member successfully!',
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
        $member = Member::findOrFail($id);

        $result = [
            'data' => $member,
            'code' => 200,
            'message' => 'edit member successfully!',
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
            'kode_member' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);
        $member = Member::findOrFail($id);
        $member->kode_member= $request->kode_member;
        $member->nama= $request->nama;
        $member->alamat= $request->alamat;
        $member->telepon= $request->telepon;
        $member->update();

        $result = [
            'data' => $member,
            'code' => 200,
            'message' => 'update member successfully!',
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
        $member = Member::findOrFail($id);
        $member->delete();
        $result = [
            'data' => $member,
            'code' => 200,
            'message' => 'delete member successfully!',
        ];

        return response()->json($result);
    }
}
