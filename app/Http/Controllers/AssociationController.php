<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;
use App\Models\AssociationPhoto;
use App\Models\Committee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AssociationController extends Controller
{
    public function index()
    {
        $association_details = Association::all();
        return compact('association_details');
    }

    public function show($id)
    {
        $association = Association::findOrFail($id);

        $committee = Committee::findOrFail($association->committee_id);

        return response()->json([
            'associations' => $association,
            'committees' => $committee
        ]);
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

            if ($request->adress_public === false) {
                $association['adress_public'] = 0;
            };
    
            if ($request->adress_public === true) {
                $association['adress_public'] = 1;
            };


            $newAssociation = Association::create($association);

            return response()->json([
                "message" => $newAssociation,
                'association' => $newAssociation
            ]);
        }
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


    public function findByComittee(Request $request)
    {
        $committee_id = $request->input("id");

        $associations = Association::where("committee_id", "=", $committee_id)->get();

        return response()->json(['associations_details' => $associations]);
    }

    public function update(Request $request, $id)
    {

        /* $array = (array) $request->all();

        $validator = Validator::make(
            $array,
            [
                'name' => 'required|string|alpha_num',
                'adress' => 'required|string|alpha_num',
                'website' => 'required|url',
                'facebook' => 'url',
                'email' => 'required|email:rfc,dns',
                'tel' => 'regex:/(0)[0-9]{9}/',
                'description' => 'string',
            ],
            [
                'name' => 'Le nom est invalide.',
                'adress' => 'Le adress est invalide.',
                'website' => "L'url est invalide.",
                'facebook' => "L'url est invalide.",
                'email' => "L'email est invalide.",
                'tel' => "Le tel est invalide.",
                'description' => "La description est invalide.",
            ]
        );

        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()], 406);
        } else {
*/
        $association = Association::findOrFail($id);

        if ($request->adress_public === false) {
            $association->adress_public = 0;
        };

        if ($request->adress_public === true) {
            $association->adress_public = 1;
        };

        $association->name = $request->input('name');
        $association->adress = $request->input('adress');
        $association->website = $request->input('website');
        $association->facebook = $request->input('facebook');
        $association->email = $request->input('email');
        $association->tel = $request->input('tel');
        $association->description = $request->input('description');

        $association->save();

        return response()->json([
            'association' => $association
        ]);
        /*}*/
    }

    public function destroy(Request $request)
    {
        $association = Association::findOrFail($request->id);

        if ($association->accept === 0) {

            $association->delete();
            return response()->json([
                'message' => 'Delete successfull'
            ]);
        } else {

            $user = User::findOrFail($request->user_id);

            $validation_password = true;

            if (password_verify($request->input('password'), $user->password) !== true) {
                $validation_password = false;
            };

            if ($validation_password === true) {
                $association->delete();
            };

            return response()->json([
                'message' => 'Delete successfull'
            ]);
        }
    }

    public function accept(Request $request)
    {

        $association = Association::findOrFail($request->id);

        $association->accept = 1;
        $association->save();

        return response()->json([
            'message' => 'Accept successfull',
            'association' => $association
        ]);
    }

    public function acceptAll(Request $request)
    {
        $associations = Association::where('committee_id', $request->committee_id)->get();

        foreach ($associations as $item) {
            $item->accept = 1;
            $item->save();
        }

        return response()->json([
            'message' => 'Accept All successfull'
        ]);
    }
}
