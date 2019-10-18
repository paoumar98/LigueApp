@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.equipe.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipe.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $equipe->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipe.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $equipe->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipe.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($equipe->logo)
                                            <a href="{{ $equipe->logo->getUrl() }}" target="_blank">
                                                <img src="{{ $equipe->logo->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.equipe.fields.division') }}
                                    </th>
                                    <td>
                                        {{ App\Equipe::DIVISION_RADIO[$equipe->division] }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>

                    <ul class="nav nav-tabs">

                    </ul>
                    <div class="tab-content">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection