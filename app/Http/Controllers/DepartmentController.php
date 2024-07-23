<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department = Department::all();
        if ($department->isEmpty()) {
            return response()->json([
                'msg' => 'data belum ada'
            ], 200);
        }
        return response()->json([
            'data' => $department
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'kode' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'msg' => $validate->errors()
            ], 422);
        }
        $department = Department::create($request->all());
        if (!$department) {
            return response()->json([
                'msg' => 'gagal menyimpan data',
            ], 401);
        }
        return response()->json([
            'msg' => 'berhasil menyimpan data',
            'data' => $department
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'kode' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'msg' => $validate->errors()
            ], 422);
        }
        $department = Department::findOrFail($id);
        $department->update($request->all());
        if (!$department) {
            return response()->json([
                'msg' => 'gagal menyimpan data',
            ], 401);
        }
        return response()->json([
            'msg' => 'berhasil menyimpan data',
            'data' => $department
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        if ($department->isEmpty()) {
            return response()->json([
                'msg' => 'data tidak ditemukan',
            ], 401);
        } else {
            $department->delete();
            return response()->json([
                'msg' => 'berhasil menyimpan data',
                'data' => $department
            ], 200);
        }
    }
}
