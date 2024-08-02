@extends('dashboard.layouts.app')

@section('title', __('Applications'))

@section('header-scripts')
    <style>
        .app-icon,
        .app-icon svg{
            width: 42px;
            height: 42px;
        }
    </style>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4" >
        <div>
            <h3 class="fw-bold mb-3">{{ __('All Applications') }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Installed Applications List') }}</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">{{  __('Name') }}</th>
                                    <th scope="col">{{  __('Version') }}</th>
                                    <th scope="col">{{  __('Author') }}</th>
                                    <th scope="col">{{  __('Description') }}</th>
                                    <th scope="col">{{  __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apps as $app)
                                    @php($app = (array)$app)
                                    @if($app['json'])
                                        <tr>
                                            <td class="app-icon" @if($app['status'] == 0) style="opacity: .5; filter: grayscale(100%);" @endif>{!! $app['svg'] !!}</td>
                                            <td @if($app['status'] == 0) style="color: #999;" @endif><strong style="font-weight:700;">{{  $app['json']->name }}</strong></td>
                                            <td @if($app['status'] == 0) style="color: #999;" @endif>{{  $app['json']->version }}</td>
                                            <td @if($app['status'] == 0) style="color: #999;" @endif><a href="{{  $app['json']->author_url }}" title="{{  $app['json']->author }}" style="font-weight:400;">{{  $app['json']->author }}</a></td>
                                            <td @if($app['status'] == 0) style="color: #999;" @endif>{{  $app['json']->description }}</td>
                                            <td>
                                                <select name="status" class="form-select form-control w-auto" data-name="{{ $app['name']  }}" data-id="{{ $app['id']  }}" style="padding-right: 40px;">
                                                    <option value="1" @if($app['status'] == 1) selected @endif>{{  __('Activated') }}</option>
                                                    <option value="0" @if($app['status'] == 0) selected @endif>{{  __('Deactivated') }}</option>
                                                    <option value="2">{{ __('Uninstall') }}</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        let status = $('select[name="status"]');
        status.on('change', function(event){
            let name = $(this).data('name'),
                id = $(this).data('id'),
                status = $(this).val(),
                urlTemplate = "{{ route('dash.apps.update', ['id' => 'ID_PLACEHOLDER', 'name' => 'NAME_PLACEHOLDER', 'status' => 'STATUS_PLACEHOLDER']) }}",
                urlTemplateUninstall = "{{ route('dash.apps.uninstall', ['id' => 'ID_PLACEHOLDER', 'name' => 'NAME_PLACEHOLDER', 'status' => 'STATUS_PLACEHOLDER']) }}",
                url = urlTemplate
                .replace('ID_PLACEHOLDER', id)
                .replace('NAME_PLACEHOLDER', encodeURIComponent(name))
                .replace('STATUS_PLACEHOLDER', encodeURIComponent(status)),
                urlUninstall = urlTemplateUninstall
                .replace('ID_PLACEHOLDER', id)
                .replace('NAME_PLACEHOLDER', encodeURIComponent(name))
                .replace('STATUS_PLACEHOLDER', encodeURIComponent(status));

                if (parseInt(status) !== 2) {
                    window.location.href = url;
                } else {
                    if (confirm('Do you really want to delete this App?') == true) {
                        window.location.href = urlUninstall;
                    }
                    return false;
                }
        });
    </script>
    <script>
        let delBtn = $('.delete');
        delBtn.on('click', function(){
            if (confirm('Do you really want to delete this page?') == true) {
                return true;
            }
            return false;
        });
    </script>
@endsection
