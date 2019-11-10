<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Informacoe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Plugin\ListWith;
use stdClass;
use Exception;
use TCG\Voyager\Voyager;

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

    public function hospitais(){

//        $h = new StdClass;
//        $lalo = new StdClass;
//        $lalo->latitude = -10.1808948;
//        $lalo->longitude = -48.9131606;
//        $h->id = 1;
//        $h->nome = "Hospital Regional de Paraíso";
//        $h->localizacao = $lalo;
//        $h->endereco = 'RUA 03 QD 02 LT 01 A 19 ';
//        $h->bairro = 'Setor Aeroporto';
//        $h->telefone = '(63) 3904-1200';
//        $h->descricao = '';
//        $h->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $h->servicos = [];
//        $h->cidade = 'Paraiso do Tocantins';
//        $h->estado = 'TO';
//        $h->created_at = 'string';
//
//        $h1 = new StdClass;
//        $lalo1 = new StdClass;
//        $lalo1->latitude = -10.1752863;
//        $lalo1->longitude = -48.8831248;
//        $h1->id = 2;
//        $h1->nome = 'Hospital Modelo';
//        $h1->localizacao = $lalo1;
//        $h1->endereco = 'Rua Tapajós, Quadra 24, Lote1, 260 ';
//        $h1->bairro = 'Centro';
//        $h1->telefone = '(63) 3602-1188';
//        $h1->descricao = '';
//        $h1->cidade = 'Paraiso do Tocantins';
//        $h1->estado = 'TO';
//        $h1->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $h1->servicos = [];
//        $h1->created_at = 'string';
//
//    	$h2 = new StdClass;
//        $lalo2 = new StdClass;
//        $lalo2->latitude = -10.1749416;
//        $lalo2->longitude = -48.8848086;
//        $h2->id = 3;
//        $h2->nome = 'Centro Médico Paraíso';
//        $h2->localizacao = $lalo2;
//        $h2->endereco = 'Rua Mal Rondon Q 25, 104 lt 7 ';
//        $h2->bairro = 'Centro';
//        $h2->telefone = '(63) 3602-1399';
//        $h2->descricao = '';
//        $h2->cidade = 'Paraiso do Tocantins';
//        $h2->estado = 'TO';
//        $h2->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $h2->servicos = [];
//        $h2->created_at = 'string';
        try{
        $hs = Informacoe::where('type', 'HPT')->get();
        if(count($hs) != 0)
            foreach ($hs as $key => $h) {
                $hs[$key]->localizacao = json_decode($h->localizacao);
                $hs[$key]->imagem = str_replace('\\', '/', Storage::disk($this->filesystem)->url($hs[$key]->imagem));
            }
        return response()->json([
            'message' => 'Hospitais buscados!',
            'errors' => false,
            'data' => $hs,
//            'data' => [$h, $h1, $h2],

        ]);
        }catch (Exception $e){
            return response()->json([
            'message' => 'Erro interno, contate administrador do sistema!',
            'errors' => true,
        ]);
}
    }

    public function ubs(){
//        $u = new StdClass;
//        $s = new StdClass;
//        $lalo = new StdClass;
//        $lalo->latitude = -10.174507;
//        $lalo->longitude = -48.900191;
//        $s1 = new StdClass;
//        $s2 = new StdClass;
//        $s3 = new StdClass;
//        $s->s = 'ESTRATEGIA DE SAUDE DA FAMILIA'; $s->c = 'SAUDE BUCAL MI';
//        $s1->s = 'ESTRATEGIA DE SAUDE DA FAMILIA'; $s1->c = 'SAUDE DA FAMILIA';
//        $s2->s = 'SERVICO DE ATENCAO A SAUDE DO TRABALHADOR'; $s2->c = 'ATENDIMENTO ACOMPANHAMENTO EM SAUDE TRABALHADOR';
//        $s3->s = 'SERVICO DE ATENCAO AO PACIENTE COM TUBERCULOSE'; $s3->c = 'DIAGNOSTICO E TRATAMENTO';
//        $u->id = 4;
//        $u->nome = 'UBS Norte Paraíso ';
//        $u->localizacao = $lalo;
//        $u->endereco = 'Rua Dom Pedro Ii Qd 151 Lt10';
//        $u->bairro = 'Jardim Paulista ';
//        $u->telefone = '(63) 3904-1442';
//        $u->descricao = '';
//        $u->cidade = 'Paraiso do Tocantins';
//        $u->estado = 'TO';
//        $u->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u->servicos = [$s,$s1,$s2,$s3];
//        $u->created_at = 'string';
//
//        $u1 = new StdClass;
//        $lalo1 = new StdClass;
//        $lalo1->latitude = -10.194348;
//        $lalo1->longitude = -48.889405;
//        $u1->id = 5;
//        $u1->nome = 'UBS Sul Paraíso';
//        $u1->localizacao = $lalo1;
//        $u1->endereco = 'Av 23 De Outubro';
//        $u1->bairro = 'Pouso Alegre';
//        $u1->telefone = '(63) 3904-1443';
//        $u1->descricao = '';
//        $u1->servicos = [];
//        $u1->cidade = 'Paraiso do Tocantins';
//        $u1->estado = 'TO';
//        $u1->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u1->created_at = 'string';
//
//    	$u2 = new StdClass;
//    	$lalo2 = new StdClass;
//        $lalo2->latitude = 0;
//        $lalo2->longitude = 0;
//        $su2 = new StdClass;
//        $su21 = new StdClass;
//        $su22 = new StdClass;
//         $su2->s = 'ESTRATEGIA DE SAUDE DA FAMILIA'; $su2->c = 'SAUDE BUCAL MI';
//             $su21->s = 'SERVICO DE ATENCAO A SAUDE DO TRABALHADOR'; $su21->c = 'ATENDIMENTO ACOMPANHAMENTO EM SAUDE DO TRABALHADOR';
//             $su22->s = 'SERVICO DE ATENCAO AO PACIENTE COM TUBERCULOSE'; $su22->c = 'DIAGNOSTICO E TRATAMENTO' ;
//        $u2->id = 6;
//        $u2->nome = 'UBS Clovis Carneiro Campos';
//        $u2->localizacao = $lalo2;
//        $u2->endereco = 'Av Brasil, Nª985';
//        $u2->bairro = 'Vila Regina';
//        $u2->telefone = '  -';
//        $u2->descricao = '';
//        $u2->servicos = [$su2, $su21, $su22];
//        $u2->cidade = 'Paraiso do Tocantins';
//        $u2->estado = 'TO';
//        $u2->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u2->created_at = 'string';
//
//    	$u3 = new StdClass;
//    	$lalo3 = new StdClass;
//        $lalo3->latitude = -10.160145;
//        $lalo3->longitude = -48.887119;
//        $u3->id = 7;
//        $u3->nome = 'UBS Vila Milena Paraíso';
//        $u3->localizacao = $lalo3;
//        $u3->endereco = 'Av Santos Dumont';
//        $u3->bairro = 'Vila Milena';
//        $u3->telefone = '(63) 3904-1579';
//        $u3->descricao = '';
//        $u3->servicos = [];
//        $u3->cidade = 'Paraiso do Tocantins';
//        $u3->estado = 'TO';
//        $u3->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u3->created_at = 'string';
//
//    	$u4 = new StdClass;
//    	$lalo4 = new StdClass;
//        $lalo4->latitude = -10.180484;
//        $lalo4->longitude = -48.887435;
//        $u4->id = 8;
//        $u4->nome = 'UBS Sespe Paraíso';
//        $u4->localizacao = $lalo4;
//        $u4->endereco = 'Rua Santos Dumont';
//        $u4->bairro = 'Centro';
//        $u4->telefone = '(63) 3602-3775';
//        $u4->descricao = '';
//        $u4->servicos = [];
//        $u4->cidade = 'Paraiso do Tocantins';
//        $u4->estado = 'TO';
//        $u4->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u4->created_at = 'string';
//
//    	$u5 = new StdClass;
//    	$lalo5 = new StdClass;
//        $lalo5->latitude = 2;
//        $lalo5->longitude = 4;
//        $u5->id = 9;
//        $u5->nome = 'UBS Oeste Paraiso';
//        $u5->localizacao = $lalo5;
//        $u5->endereco = 'Rua Bernadino Maciel';
//        $u5->bairro = 'Setor Aeroporto';
//        $u5->telefone = '(63) 3904-1445';
//        $u5->descricao = '';
//        $u5->servicos = [];
//        $u5->cidade = 'Paraiso do Tocantins';
//        $u5->estado = 'TO';
//        $u5->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u5->created_at = 'string';
//
//    	$u6 = new StdClass;
//    	$lalo6 = new StdClass;
//        $lalo6->latitude = 0;
//        $lalo6->longitude = 0;
//        $u6->id = 10;
//        $u6->nome = 'UBS Gentil Costa';
//        $u6->localizacao = $lalo6;
//        $u6->endereco = 'Rua L 14 Esquina com L 24';
//        $u6->bairro = 'Interlagos';
//        $u6->telefone = '   -';
//        $u6->descricao = '';
//        $u6->servicos = [];
//        $u6->cidade = 'Paraiso do Tocantins';
//        $u6->estado = 'TO';
//        $u6->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u6->created_at = 'string1';
        try{
            $hs = Informacoe::where('type', 'UBS')->get();
            if(count($hs) != 0)
                foreach ($hs as $key => $h) {
                    $hs[$key]->localizacao = json_decode($h->localizacao);
                    $hs[$key]->imagem = str_replace('\\', '/', Storage::disk($this->filesystem)->url($hs[$key]->imagem));
                }

            return response()->json([
                'message' => 'Hospitais buscados!',
                'errors' => false,
                'data' => $hs
    //            'data' => [$u, $u1, $u2, $u3, $u4, $u5, $u6],

            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Erro interno, contate administrador do sistema!',
                'errors' => true,

            ]);
        }
    }

    public function ubsh($id){

//        $h = new StdClass;
//        $lalo = new StdClass;
//        $lalo->latitude = -10.1808948;
//        $lalo->longitude = -48.9131606;
//        $h->id = 1;
//        $h->nome = "Hospital Regional de Paraíso";
//        $h->localizacao = $lalo;
//        $h->endereco = 'RUA 03 QD 02 LT 01 A 19 ';
//        $h->bairro = 'Setor Aeroporto';
//        $h->telefone = '(63) 3904-1200';
//        $h->descricao = '';
//        $h->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $h->servicos = [];
//        $h->cidade = 'Paraiso do Tocantins';
//        $h->estado = 'TO';
//        $h->created_at = 'string';
//
//        $h1 = new StdClass;
//        $lalo1 = new StdClass;
//        $lalo1->latitude = -10.1752863;
//        $lalo1->longitude = -48.8831248;
//        $h1->id = 2;
//        $h1->nome = 'Hospital Modelo';
//        $h1->localizacao = $lalo1;
//        $h1->endereco = 'Rua Tapajós, Quadra 24, Lote1, 260 ';
//        $h1->bairro = 'Centro';
//        $h1->telefone = '(63) 3602-1188';
//        $h1->descricao = '';
//        $h1->cidade = 'Paraiso do Tocantins';
//        $h1->estado = 'TO';
//        $h1->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $h1->servicos = [];
//        $h1->created_at = 'string';
//
//        $h2 = new StdClass;
//        $lalo2 = new StdClass;
//        $lalo2->latitude = -10.1749416;
//        $lalo2->longitude = -48.8848086;
//        $h2->id = 3;
//        $h2->nome = 'Centro Médico Paraíso';
//        $h2->localizacao = $lalo2;
//        $h2->endereco = 'Rua Mal Rondon Q 25, 104 lt 7 ';
//        $h2->bairro = 'Centro';
//        $h2->telefone = '(63) 3602-1399';
//        $h2->descricao = '';
//        $h2->cidade = 'Paraiso do Tocantins';
//        $h2->estado = 'TO';
//        $h2->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $h2->servicos = [];
//        $h2->created_at = 'string';
//
//        $u = new StdClass;
//        $s = new StdClass;
//        $lalo = new StdClass;
//        $lalo->latitude = -10.174507;
//        $lalo->longitude = -48.900191;
//        $s1 = new StdClass;
//        $s2 = new StdClass;
//        $s3 = new StdClass;
//        $s->s = 'ESTRATEGIA DE SAUDE DA FAMILIA'; $s->c = 'SAUDE BUCAL MI';
//        $s1->s = 'ESTRATEGIA DE SAUDE DA FAMILIA'; $s1->c = 'SAUDE DA FAMILIA';
//        $s2->s = 'SERVICO DE ATENCAO A SAUDE DO TRABALHADOR'; $s2->c = 'ATENDIMENTO ACOMPANHAMENTO EM SAUDE TRABALHADOR';
//        $s3->s = 'SERVICO DE ATENCAO AO PACIENTE COM TUBERCULOSE'; $s3->c = 'DIAGNOSTICO E TRATAMENTO';
//        $u->id = 4;
//        $u->nome = 'UBS Norte Paraíso ';
//        $u->localizacao = $lalo;
//        $u->endereco = 'Rua Dom Pedro Ii Qd 151 Lt10';
//        $u->bairro = 'Jardim Paulista ';
//        $u->telefone = '(63) 3904-1442';
//        $u->descricao = '';
//        $u->cidade = 'Paraiso do Tocantins';
//        $u->estado = 'TO';
//        $u->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u->servicos = [$s,$s1,$s2,$s3];
//        $u->created_at = 'string';
//
//        $u1 = new StdClass;
//        $lalo1 = new StdClass;
//        $lalo1->latitude = -10.194348;
//        $lalo1->longitude = -48.889405;
//        $u1->id = 5;
//        $u1->nome = 'UBS Sul Paraíso';
//        $u1->localizacao = $lalo1;
//        $u1->endereco = 'Av 23 De Outubro';
//        $u1->bairro = 'Pouso Alegre';
//        $u1->telefone = '(63) 3904-1443';
//        $u1->descricao = '';
//        $u1->servicos = [];
//        $u1->cidade = 'Paraiso do Tocantins';
//        $u1->estado = 'TO';
//        $u1->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u1->created_at = 'string';
//
//        $u2 = new StdClass;
//        $lalo2 = new StdClass;
//        $lalo2->latitude = 0;
//        $lalo2->longitude = 0;
//        $su2 = new StdClass;
//        $su21 = new StdClass;
//        $su22 = new StdClass;
//        $su2->s = 'ESTRATEGIA DE SAUDE DA FAMILIA'; $su2->c = 'SAUDE BUCAL MI';
//        $su21->s = 'SERVICO DE ATENCAO A SAUDE DO TRABALHADOR'; $su21->c = 'ATENDIMENTO ACOMPANHAMENTO EM SAUDE DO TRABALHADOR';
//        $su22->s = 'SERVICO DE ATENCAO AO PACIENTE COM TUBERCULOSE'; $su22->c = 'DIAGNOSTICO E TRATAMENTO' ;
//        $u2->id = 6;
//        $u2->nome = 'UBS Clovis Carneiro Campos';
//        $u2->localizacao = $lalo2;
//        $u2->endereco = 'Av Brasil, Nª985';
//        $u2->bairro = 'Vila Regina';
//        $u2->telefone = '  -';
//        $u2->descricao = '';
//        $u2->servicos = [$su2, $su21, $su22];
//        $u2->cidade = 'Paraiso do Tocantins';
//        $u2->estado = 'TO';
//        $u2->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u2->created_at = 'string';
//
//        $u3 = new StdClass;
//        $lalo3 = new StdClass;
//        $lalo3->latitude = -10.160145;
//        $lalo3->longitude = -48.887119;
//        $u3->id = 7;
//        $u3->nome = 'UBS Vila Milena Paraíso';
//        $u3->localizacao = $lalo3;
//        $u3->endereco = 'Av Santos Dumont';
//        $u3->bairro = 'Vila Milena';
//        $u3->telefone = '(63) 3904-1579';
//        $u3->descricao = '';
//        $u3->servicos = [];
//        $u3->cidade = 'Paraiso do Tocantins';
//        $u3->estado = 'TO';
//        $u3->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u3->created_at = 'string';
//
//        $u4 = new StdClass;
//        $lalo4 = new StdClass;
//        $lalo4->latitude = -10.180484;
//        $lalo4->longitude = -48.887435;
//        $u4->id = 8;
//        $u4->nome = 'UBS Sespe Paraíso';
//        $u4->localizacao = $lalo4;
//        $u4->endereco = 'Rua Santos Dumont';
//        $u4->bairro = 'Centro';
//        $u4->telefone = '(63) 3602-3775';
//        $u4->descricao = '';
//        $u4->servicos = [];
//        $u4->cidade = 'Paraiso do Tocantins';
//        $u4->estado = 'TO';
//        $u4->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u4->created_at = 'string';
//
//        $u5 = new StdClass;
//        $lalo5 = new StdClass;
//        $lalo5->latitude = 2;
//        $lalo5->longitude = 4;
//        $u5->id = 9;
//        $u5->nome = 'UBS Oeste Paraiso';
//        $u5->localizacao = $lalo5;
//        $u5->endereco = 'Rua Bernadino Maciel';
//        $u5->bairro = 'Setor Aeroporto';
//        $u5->telefone = '(63) 3904-1445';
//        $u5->descricao = '';
//        $u5->servicos = [];
//        $u5->cidade = 'Paraiso do Tocantins';
//        $u5->estado = 'TO';
//        $u5->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u5->created_at = 'string';
//
//        $u6 = new StdClass;
//        $lalo6 = new StdClass;
//        $lalo6->latitude = 0;
//        $lalo6->longitude = 0;
//        $u6->id = 10;
//        $u6->nome = 'UBS Gentil Costa';
//        $u6->localizacao = $lalo6;
//        $u6->endereco = 'Rua L 14 Esquina com L 24';
//        $u6->bairro = 'Interlagos';
//        $u6->telefone = '   -';
//        $u6->descricao = '';
//        $u6->servicos = [];
//        $u6->cidade = 'Paraiso do Tocantins';
//        $u6->estado = 'TO';
//        $u6->imagem = Storage::disk($this->filesystem)->url('admin-storage/icon.png');
//        $u6->created_at = 'string1';
//
//        $ret = null;
//        switch ($id){
//            case $u->id :
//                $ret = $u;
//            case $u1->id :
//                $ret = $u1;
//            case $u2->id :
//                $ret = $u2;
//            case $u3->id :
//                $ret = $u3;
//            case $u4->id :
//                $ret = $u4;
//            case $u5->id :
//                $ret = $u5;
//            case $u6->id :
//                $ret = $u6;
//            case $h->id :
//                $ret = $h;
//            case $h1->id :
//                $ret = $h1;
//            case $h2->id :
//                $ret = $h2;
//        }
        try{
            $ret = Informacoe::find($id);
            if(!is_null($ret)) {
                $ret->localizacao = json_decode($ret->localizacao);
                $ret->imagem = str_replace('\\', '/', Storage::disk($this->filesystem)->url($ret->imagem));
            }
            return response()->json([
                'message' => 'Busco ok',
                'errors' => false,
                'data' => $ret
            ]);
        }catch (Exception $e){
            return response()->json([
                'message' => 'Erro interno, contate administrador do sistema!',
                'errors' => true,
            ]);
        }
    }
}
