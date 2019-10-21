<?php

namespace App\Http\Controllers\Api;

use App\LocalRisco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class LocalRiscoController extends Controller
{

    /** @var string */
    private $filesystem;

    public function __construct()
    {
        $this->filesystem = config('voyager.storage.disk');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        try{
            $lr = new LocalRisco();
            $lr->descricao = $request['descricao'];
            $lr->endereco = $request['endereco'];
            $lr->bairro = $request['bairro'];
            $lr->imagem = 'fewfewe';
            $lr->imagem = $this->uploadImage($request->primaryImage);
            $lr->location_id = $lr->location()->create($request['location'])->id;
//            $lr->save();

            return response()->json(
                [
                    'message' => 'Cadastro realizado com sucesso!',
                    'errors' => false,
                    'data' => $lr
                ]
            );
        } catch (\Exception $e){
            return response()->json(
                [
                    'message' => 'Erro (LR1) Interno servidor, Contate um Administrador do Sistema!',
                    'errors' => false,
                ], 500
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImage($image)
    {
        if (!is_null($image))
        {
            $file = $image;
            $extension = $image->getClientOriginalExtension();
            $fileName = time() . random_int(100, 999) .'.' . $extension;
            $destinationPath = public_path('images/'.$fileName);
            $url = 'http://'.$_SERVER['HTTP_HOST'].'/images/'.$fileName;
            $fullPath = $destinationPath.$fileName;
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775);
            }
            $image = Image::make($file)
                ->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg');
            $image->save($fullPath, 100);
            return $url;
        } else {
            return 'http://'.$_SERVER['HTTP_HOST'].'/images/'.$type.'/placeholder300x300.jpg';
        }
    }
}
