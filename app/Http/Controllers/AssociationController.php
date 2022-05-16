<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Association;
use App\Models\AssociationPhoto;
use App\Models\Committee;

class AssociationController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255|alphanumeric',
            'adress' => 'required',
            'adress_public' => '',
            'website' => 'alpha',
            'facebook' => 'alpha',
            'email' => 'required', 
            'tel' => 'numeric',
            'description' => '',
            'committee_id' => 'required|numeric',
        ]);

        $association = [
            'name' => $request->input('name'),
            'adress' => $request->input('adress'),
            'adress_public' => $request->input('adress_public'),
            'website' => $request->input('website'),
            'facebook' => $request->input('facebook'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'description' => $request->input('description'),
            'committee_id' => $request->input('committee_id'),
        ];


        $new_association = Association::create($association);

        $img = $request->file('photos');

        if ($img !== null){

            $destination_path = public_path('/image/card-' . $id.'/'); // upload path

            // merda que eu fiz pra funcionar em localhost
                $dest_array = explode('/', $destination_path);
                unset($dest_array[0], $dest_array[1], $dest_array[2], $dest_array[3], $dest_array[4], $dest_array[5], $dest_array[6]);

                $new_destination = implode('/', $dest_array);
            // fim da merda que eu fiz pra funcionar em localhost
                
            // Upload Orginal Image
            $cover_img = date('YmdHis') . "." . $img->getClientOriginalExtension();
            $img->move($destination_path, $cover_img);

            // Save In Database
        }

        $association_photos = [
            'id' => $new_association->id(),
            'extension' => $img->getClientOriginalExtension(),
            'url' => $new_destination,
        ];

        $new_association_photos = AssociationPhoto::create($association_photos)

        return $new_association;

    }

    public function show($id)
    {
        //
    }

    public function showAll($committee_id)
    {
        $associations = Committee::with('associations')->findMany($committee_id, 'committee_id');

        return $associations;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
