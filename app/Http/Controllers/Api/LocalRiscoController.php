<?php

namespace App\Http\Controllers\Api;

use App\LocalRisco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LocalRiscoController extends Controller
{

    /** @var string */
    private $filesystem;

    public function __construct()
    {
        $this->filesystem = config('voyager.storage.disk');
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $ret = LocalRisco::where("status", "T")->get();
            $data = null;
            foreach ($ret as $lr){
                $lr->location;
                $lr->imagem = str_replace('\\', '/', Storage::disk($this->filesystem)->url('local-risco/'.$lr->imagem));
                $data[] = $lr;
            }
            return response()->json([
                'message' => 'Busco ok',
                'errors' => false,
                'data' => $data
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Erro interno, contate administrador do sistema!',
                'errors' => true,
            ]);
        }
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
//                return response()->json([
//                    'message' => 'Falha no envio da imagem!',
//                    'errors' => false,
//                    'data' => $request->all()
//                ]);

            $lr = new LocalRisco();
            $lr->descricao = $request['descricao'];
            $lr->endereco = $request['endereco'];
            $lr->bairro = $request['bairro'];
            $lr->location_id = $lr->location()->create($request['location'])->id;
            $lr->save();

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

    public function uploadImage($id, Request $request)
    {

        $file = $request['fileToUpload'];
        try{
        $extension = $request->fileToUpload->getClientOriginalExtension();
        $fileName = time() . random_int(100, 999) .'.' . $extension;
        $destinationPath = Storage::disk($this->filesystem)->path('local-risco/');
        $url = 'http://'.$_SERVER['HTTP_HOST'].'/imagens/'.$fileName;
        $fullPath = $destinationPath.$fileName;
        if (!file_exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775);
        }
        $image = Image::make($file)
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
        $image->save($fullPath, 100);

        $localrisco = LocalRisco::find($id);
        $localrisco->imagem = $fileName;
        $localrisco->save();

        return response()->json(
             [
                'message' => 'Imagem Salva!',
                'errors' => false,
                'data' => $fileName
            ], 200);
        }catch (\Exception $e){
            return response()->json(
                [
                    'message' => 'Falha de carregamento da imagem tente novamente',
                    'errors' => true,
                    'data' => $fileName
                ], 404);
        }

    }
}
