<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        $employes = Employe::orderBy('created_at', 'desc')->get();
        return view('data_employe', compact('employes'));
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
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employes,email',
                'position' => 'required|string|max:255',
                'gender' => 'required|in:0,1',
                'phone' => 'required|string|max:15',
                'born' => 'required|date',
                'address' => 'required|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $filename = null;
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = date('YmdHis') . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
            }

            Employe::create([
                'name' => $request->name,
                'email' => $request->email,
                'position' => $request->position,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'born' => $request->born,
                'address' => $request->address,
                'photo' => $filename,
            ]);
            session()->flash('alert', 'success');
            session()->flash('message', 'Data Pegawai berhasil ditambahkan.');
        } catch (\Exception $e) {
            session()->flash('alert', 'danger');
            session()->flash('message', 'Terjadi kesalahan saat menambahkan data pegawai.');
        }

        return redirect()->route('employe.index');
    }

    public function drop()
    {
        $employes = Employe::select('id', 'name')->get();

        return view('drop', compact('employes'));
    }
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);

            $image = $request->file('file');
            $imageName = time() . rand(1, 99) . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);

            Employe::create([
                'photo' => $imageName,
            ]);

            return response()->json(['success' => $imageName]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $employe = Employe::findOrFail($id);

            if ($request->hasFile('photo')) {
                if ($employe->photo && file_exists(public_path('images/' . $employe->photo))) {
                    unlink(public_path('images/' . $employe->photo));
                }

                $file = $request->file('photo');
                $filename = date('YmdHis') . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);

                $employe->photo = $filename;
            }

            $employe->update([
                'name' => $request->name,
                'email' => $request->email,
                'position' => $request->position,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'born' => $request->born,
                'address' => $request->address,
                'photo' => $employe->photo,
            ]);
            session()->flash('alert', 'success');
            session()->flash('message', 'Data Pegawai berhasil diperbarui.');
        } catch (\Exception $e) {
            session()->flash('alert', 'danger');
            session()->flash('message', 'Terjadi kesalahan saat memperbarui data pegawai.');
        }

        return redirect()->route('employe.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $employe = Employe::findOrFail($id);

            if ($employe->photo && file_exists(public_path('images/' . $employe->photo))) {
                unlink(public_path('images/' . $employe->photo));
            }

            $employe->delete();
            session()->flash('alert', 'success');
            session()->flash('message', 'Data Pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('alert', 'danger');
            session()->flash('message', 'Terjadi kesalahan saat menghapus data pegawai.');
        }

        return redirect()->route('employe.index');
    }
}
