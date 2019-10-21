@extends('vendor.voyager.master')

@section('page_title', __('voyager::generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i> {{ __('voyager::generic.media') }}</h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager-user">
                    <media-manager-user
                        base-path="{{ config('voyager.media-user.path', '/') }}"
                        :show-folders="{{ config('voyager.media-user.show_folders', true) ? 'true' : 'false' }}"
                        :allow-upload="{{ config('voyager.media-user.allow_upload', true) ? 'true' : 'false' }}"
                        :allow-move="{{ config('voyager.media-user.allow_move', true) ? 'true' : 'false' }}"
                        :allow-delete="{{ config('voyager.media-user.allow_delete', true) ? 'true' : 'false' }}"
                        :allow-create-folder="{{ config('voyager.media-user.allow_create_folder', true) ? 'true' : 'false' }}"
                        :allow-rename="{{ config('voyager.media-user.allow_rename', true) ? 'true' : 'false' }}"
                        :allow-crop="{{ config('voyager.media-user.allow_crop', true) ? 'true' : 'false' }}"
                        :details="{{ json_encode(['thumbnails' => config('voyager.media-user.thumbnails', []), 'watermark' => config('voyager.media-user.watermark', (object)[])]) }}"
                    ></media-manager-user>
                </div>
            </div><!-- .row -->
        </div><!-- .col-md-12 -->
    </div><!-- .page-content container-fluid -->
@stop

@section('javascript')
    <script>
        new Vue({
            el: '#filemanager-user'
        });
    </script>
@endsection
