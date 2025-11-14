<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::orderBy('nama_rumah_sakit')->get();
        $patients = Patient::with('hospital')->orderBy('nama_pasien')->paginate(10);
        return view('patients.index', compact('patients', 'hospitals'));
    }

    public function create()
    {
        $hospitals = Hospital::orderBy('nama_rumah_sakit')->get();
        return view('patients.create', compact('hospitals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pasien' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:50'],
            'hospital_id' => ['required', 'exists:hospitals,id'],
        ]);
        Patient::create($data);
        return redirect()->route('patients.index');
    }

    public function edit(Patient $patient)
    {
        $hospitals = Hospital::orderBy('nama_rumah_sakit')->get();
        return view('patients.edit', compact('patient', 'hospitals'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'nama_pasien' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:50'],
            'hospital_id' => ['required', 'exists:hospitals,id'],
        ]);
        $patient->update($data);
        return redirect()->route('patients.index');
    }

    public function destroy(Request $request, Patient $patient)
    {
        $patient->delete();
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('patients.index');
    }

    public function filter(Request $request)
    {
        $hospitalId = $request->query('hospital_id');
        $query = Patient::with('hospital');
        if ($hospitalId) {
            $query->where('hospital_id', $hospitalId);
        }
        $patients = $query->orderBy('nama_pasien')->get();
        return response()->json($patients);
    }
}