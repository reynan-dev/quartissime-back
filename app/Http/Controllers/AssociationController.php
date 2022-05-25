<?php

namespace App\Http\Controllers;

use App\Models\Committee;

use App\Models\Association;
use Illuminate\Http\Request;
use App\Models\AssociationPhoto;
use Illuminate\Support\Facades\Validator;

class AssociationController extends Controller
{
    public function index()
    {
        $association_details = Association::all();
        return compact('association_details');
    }

    public function store(Request $request)
    {
        $array = (array) $request->all();


        $validator = Validator::make(
            $array,
            [
                'nom' => 'min:3|max:255|string',
                'adresse' => 'required|string',
                'website' => 'url',
                'email' => 'required|email:rfc',
                'tel' => 'regex:/(0)[0-9]{9}/',
                'description' => 'string',
                'comiteId' => 'required|integer',
            ],
            [
                'name' => 'Le nom est invalide.',
                'adress' => "L'adresse est invalide.",
                'website' => 'Le site web est invalide.',
                'email' => "L'adresse mail est invalide",
                'description' => "La description est invalide.",
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 406);
        } else {

        $association = [
            'name' => $request->nom,
            'adress' => $request->adresse,
            'adress_public' => $request->adressePublique,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'email' => $request->email,
            'tel' => $request->tel,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'committee_id' => $request->comiteId,
        ];


        $newAssociation = Association::create($association);

        return response()->json(["message" => $newAssociation]);
        };
        /*
        $photos = $request->file('photos');

        if ($photos !== null){

            $destination_path = public_path('/image/association-' . $new_association->id() .'/'); // upload path

            // merda que eu fiz pra funcionar em localhost
                $dest_array = explode('/', $destination_path);
                unset($dest_array[0], $dest_array[1], $dest_array[2], $dest_array[3], $dest_array[4], $dest_array[5], $dest_array[6]);

                $new_destination = implode('/', $dest_array);
            // fim da merda que eu fiz pra funcionar em localhost
                
            // Upload Orginal Image
            $photos_img = date('YmdHis') . "." . $photos->getClientOriginalExtension();
            $photos->move($destination_path, $photos_img);

            // Save In Database
        }

        $association_photos = [
            'id' => $new_association->id(),
            'extension' => $img->getClientOriginalExtension(),
            'url' => $new_destination,
        ];

        $new_association_photos = AssociationPhoto::create($association_photos); */
    }

    public function show($id)
    {
        $association = Association::findOrFail($id);

        return $association;
    }

    public function findByComittee(Request $request)
    {
        $committee_id = $request->input("id");

        $associations = Association::where("committee_id", "=", $committee_id)->get();

        return response()->json(['associations_details' => $associations]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255|alpha_num',
            'adress' => 'required|alpha_num',
            'website' => 'alpha_dash',
            'facebook' => 'alpha_dash',
            'email' => 'required|email:rfc',
            'tel' => 'integer',
            'description' => 'alpha_num',
            'committee_id' => 'required|integer',
        ]);

        $association = Association::findOrFail($id);

        $association->name = $request->input('name');
        $association->adress = $request->input('adress');
        $association->adress_public = $request->input('adress_public');
        $association->website = $request->input('website');
        $association->facebook = $request->input('facebook');
        $association->email = $request->input('email');
        $association->tel = $request->input('tel');
        $association->description = $request->input('description');

        $association->save();
    }

    public function destroy($id)
    {
        $association = Association::findOrFail($id);
        $association->delete();

        return "L'association a été bien supprimer.";
    }
}
