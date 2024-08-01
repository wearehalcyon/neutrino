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
                                    <th scope="col">{{  __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apps as $app)
                                    @php($app = (array)$app)
                                    @if($app['json'])
                                        <tr @if($app['status'] == 0) style="opacity: .5; filter: grayscale(100%);" @endif>
                                            <td class="app-icon">{!! $app['svg'] !!}</td>
                                            <td>{{  $app['json']->name }}</td>
                                            <td>{{  $app['json']->version }}</td>
                                            <td>{{  $app['json']->author }}</td>
                                            <td>{{  $app['json']->description }}</td>
                                            <td>
                                                <select name="status" class="form-select form-control w-auto" data-name="{{ $app['name']  }}" data-id="{{ $app['id']  }}" style="padding-right: 40px;">
                                                    <option value="1" @if($app['status'] == 1) selected @endif>{{  __('Activated') }}</option>
                                                    <option value="0" @if($app['status'] == 0) selected @endif>{{  __('Deactivated') }}</option>
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
                url = urlTemplate
                .replace('ID_PLACEHOLDER', id)
                .replace('NAME_PLACEHOLDER', encodeURIComponent(name))
                .replace('STATUS_PLACEHOLDER', encodeURIComponent(status));

                window.location.href = url;
        });
    </script>
@endsection
