@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verificação de e-mail') }}</div>

                    <div class="card-body">

                            <div class="alert alert-success" role="alert">
                                {{ __('E-mail validado com sucesso! Pode acessar sua conta no APP Paraiso-Saúde.') }}
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
