<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Plugin\ListWith;

class BannerApiController extends Controller
{
    /** @var string */
    private $filesystem;

    /** @var string */
    private $directory = '';

    public function __construct()
    {
        $this->middleware('auth:api');

        $this->filesystem = config('voyager.storage.disk');
    }
    public function banners(){
        try{
            $dir = 'banner-app';

            $files = [];
            $storage = Storage::disk($this->filesystem)->addPlugin(new ListWith());
            $storageItems = $storage->listWith(['mimetype'], $dir);
            $files = [];
            foreach ($storageItems as $item){
                $files[] = [
                    'imageUrl' => Storage::disk($this->filesystem)->url($item['path']),
                ];
            }
            $updates = Banner::find(1);
            $updates->update = false;
            $updates->save();

            return response()->json(
                [
                    'message' => 'Banners de Divulgação!',
                    'errors' => false,
                    'data' => $files
                ]
            );
        }catch (Exception $e){
            return response()->json(
                [
                    'message' => 'Erro interno, Contate Administrado do Sistema!',
                    'errors' => false,
                ], 500
            );
        }
    }

    public function checkUpdate(){
        $updates = Banner::find(1);
        $updates->image = json_decode($updates->image);
        return response()->json(
            [
            'message' => 'Check Updates banners!',
            'errors' => false,
            'data' => $updates
            ]
        );
    }
}
