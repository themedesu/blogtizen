<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TinyMCEController extends Controller
{
    public function upload(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $imagePath = $request->file('file');
            $imageName = time() . '-' . Str::random(20) . '.' . $imagePath->getClientOriginalExtension();
            $storagePath = $request->file('file')->storeAs('content', $imageName, 'public');

            $message = 'Gambar berhasil diupload. Selanjutnya klik tambahkan.';
            $storageLink = config('app.url') . '/storage/' . $storagePath;

        } catch (\Exception$e) {
            $message = $e->getMessage();
            $storageLink = null;
        }

        return response()->json(['location' => $storageLink, 'message' => $message], 200);
    }
}
