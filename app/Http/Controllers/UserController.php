<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('pages.user.index', compact("user"));
    }

    public function get($token)
    {
        $user = User::where('user_token', $token)->first();
        return response()->json(['message' => "Berhasil Mendapatkan User!", 'status' => true, 'data' => $user]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'max:255'],
            // 'telepon' => ['required', 'string', 'max:255'],
            // 'alamat' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'repassword' => ['required', 'string', 'max:255'],
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => $validation->errors()->all()]);
        }

        if ($request->password != $request->repassword) {
            return response()->json(['status' => false, 'message' => "Password Tidak Sama"]);
        }

        DB::beginTransaction();
        try {
            $data = User::create([
                'username' => $request->username,
                'name' => $request->nama,
                // 'email' => $request->email,
                // 'telepon' => $request->telepon,
                // 'alamat' => $request->alamat,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            if ($data) {
                DB::commit();
                return response()->json(['message' => "Berhasil Menambahkan User!", 'status' => true], 201);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th, 'status' => false], 200);
        }
    }

    public function destroy($token)
    {
        $user = User::where('user_token', $token)->first();
        if ($user) {
            User::where('user_token', $token)->delete();
            // $user->status = 'deleted';
            // $user->username = Str::uuid()->toString();
            // $user->save();
            return response()->json(['message' => "Berhasil Menghapus User!", 'status' => true], 201);
        }
    }

    public function edit(Request $request, $token)
    {
        $user = User::where('user_token', $token)->first();

        if ($user) {
            User::where('user_token', $token)->update([
                'username' => $request->username,
                'name' => $request->nama,
                'role' => $request->role,
            ]);

            return response()->json(['message' => "Berhasil Merubah User!", 'status' => true], 201);
        }
    }
}
