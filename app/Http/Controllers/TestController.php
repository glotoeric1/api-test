<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestModel;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*j'ai selectionner tous les donnees et je retour avec le format json
        On peut aussi fait les suit: 

        $testModel=TestModel::latest()->get();
        $testModel=TestModel::get();
        $testModel=TestModel::latest()->limit(30)->get();
        */

        $testModel=TestModel::latest()->get();
        return response()->json($testModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        Tu peux validate les inputs comme ca ou tu peut fait appel a la methode ValidateNomEtPrenom ;

        validate input sans la methode validateNomEtPrenom
        $validateData=$request->validate([
            'nom'=>'required|max:190',
            'prenom'=>'required|max:190',
        ]);

        */
        //appel a la methode validateNomEtPrenom
        $data=$this->validateNomEtPrenom($request);

        //je fait insertion ici
        $testModel=TestModel::create($data);
        return response(['message'=>'Successful'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*
        On peut utiliser findorfail ou find etc 
        $testModel=TestModel::find($id);
        */
        $testModel=TestModel::findorfail($id);
        return response()->json($testModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate input 
        $data=$this->validateNomEtPrenom($request);

        //cherche la donnee a modifier 
        $testModel=TestModel::findorfail($id);
        
        //modifier ici
        $testModel->update($request->all());
        return response(['message'=>'Successful'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Je cherche la donnee avec la methode where et je supprimer avec le methode delete
        TestModel::where('id', $id)->delete();
        return response(['message'=>'Successful'], 200);
    }

    //Une methode pour validate les inputs 
    //'region'=>'required|min:5|max:100', min->pour verifier minimun carateres et max->pour verifier maxinum carateres
    //source: https://laravel.com/docs/8.x/validation 

    public function validateInput($request){
        return $this->validate($request, [
            'region'=>'required|max:100',
            'cercle'=>'required|max:200',
            'commune'=>'required|max:100',
            'village'=>'required|max:200',
            'nomchefmenage'=>'required|max:100',
            'prenomchefmenage'=>'required|max:200',
            'sexe'=>'required|max:100',
            'age'=>'required|max:200',
            'etatcivil'=>'required|max:100',
            'profession'=>'required|max:200',
            'contact'=>'required|max:100',
            'prenom1'=>'required|max:200',
            'nom1'=>'required|max:100',
            'affiliation1'=>'required|max:200',
            'contact1'=>'required|max:100',
            'nom2'=>'required|max:200',
            'contact2'=>'required|max:200',
            'affiliation2'=>'required|max:200',
            'photo'=>'required|mimes:png,jpg,jpeg,PNG,JPG,JPEG'
        ]);
    }

    //Une methode pour validate les inputs 
    //'region'=>'required|min:5|max:100', min->pour verifier minimun carateres et max->pour verifier maxinum carateres
    //source: https://laravel.com/docs/8.x/validation 

    public function validateNomEtPrenom($request){
        return $this->validate($request, [
            'nom'=>'required|max:100',
            'prenom'=>'required|max:200',
        ]);
    }
}
