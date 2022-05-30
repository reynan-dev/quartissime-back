<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{

    public function submit(Request $request)
    {
        dd($request->all());

        /*
        $array = (array) $request->all();

        // dd($array);

        if ($request->type === 'committee') {

            $validator = Validator::make(
                $array,
                [
                    'file' => 'required|image',
                ],
                [
                    'file' => "Le format d'image est pas accepté."
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->messages(),
                    406
                ]);
            };

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();

            $request->file->move(public_path('upload'), $fileName);

            $path = public_path('upload') . $fileName;


            $file = [
                'extension' => $request->file->getClientOriginalExtension(),
                'url' => $path,
                'committee_id' => $request->committee_id
            ];

            $new_file = FileUpload::create($file);

            return response()->json([
                'message' => 'You have successfully upload file.',
                'file' => $new_file,
            ]);
        } else if ($request->type === 'event') {

            $validator = Validator::make(
                $array,
                [
                    'file' => 'required|mimes:pdf,jpeg,jpg,png,bmp,svg|max:10000',
                ],
                [
                    'file' => "Le format de fichier est pas accepté."
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->messages(),
                    406
                ]);
            };

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();

            $request->file->move(public_path('upload'), $fileName);

            $path = public_path('upload') . $fileName;


            $file = [
                'extension' => $request->file->getClientOriginalExtension(),
                'url' => $path,
                'committee_id' => $request->committee_id
            ];

            $new_file = FileUpload::create($file);

            return response()->json([
                'message' => 'You have successfully upload file.',
                'file' => $new_file,
            ]);
        };


        return response()->json([
            'message' => 'error upload',
        ]); */
    }

    public function test() {
        dd('test');
    }
};
