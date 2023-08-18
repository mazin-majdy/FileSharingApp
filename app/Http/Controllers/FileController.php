<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function showUploadForm()
    {
        return view('files.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        $user = Auth::user();

        $uploadedFile = $request->file('file');

        $fileName = uniqid('file_') . '.' . $uploadedFile->getClientOriginalExtension();


        $fileStored = Storage::disk('local')->putFileAs('uploads', $uploadedFile, $fileName);

        if ($fileStored) {
            $user->files()->create([
                'name' => $uploadedFile->getClientOriginalName(),
                'path' => $fileStored,
            ]);

            return redirect()->route('files')
                ->with('msg', 'File uploaded successfully.')
                ->with('type', 'success');
        } else {
            return redirect()->route('files')
                ->with('msg', 'File upload failed.')
                ->with('type', 'danger');
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $files = $user->files()
            ->filter($request->query())
            ->paginate(10);

        $msg = session('msg');
        $type = session('type');

        return view('files.index', compact('files', 'msg', 'type'));
    }

    public function generateDownloadLink($file)
    {
        $file = Auth::user()->files()->findOrFail($file);

        $downloadLink = route('download', $file->unique_identifier);

        return view('files.download-link', compact('downloadLink'));
    }

    public function download($token)
    {
        $file = File::where('unique_identifier', $token)->firstOrFail();
        $filePath = $file->path;
        $fileName = $file->name;

        return Storage::disk('local')->download($filePath, $fileName);
        // return response()->file(storage_path('app/' .$filePath));
    }

    public function delete($file)
    {
        $user = Auth::user();
        $fileToDelete = $user->files()->findOrFail($file);

        Storage::disk('local')->delete($fileToDelete->path);

        $fileToDelete->delete();

        return redirect()->route('files')
            ->with('msg', 'File deleted successfully.')
            ->with('type', 'success');
    }
}
