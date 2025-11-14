<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::orderBy('nama_rumah_sakit')->paginate(10);
        return view('hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('hospitals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_rumah_sakit' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'telepon' => ['required', 'string', 'max:50'],
        ]);
        Hospital::create($data);
        return redirect()->route('hospitals.index');
    }

    public function edit(Hospital $hospital)
    {
        return view('hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $data = $request->validate([
            'nama_rumah_sakit' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'telepon' => ['required', 'string', 'max:50'],
        ]);
        $hospital->update($data);
        return redirect()->route('hospitals.index');
    }

    public function destroy(Request $request, Hospital $hospital)
    {
        $hospital->delete();
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('hospitals.index');
    }
}