@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.actus.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.actus.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $actus->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.actus.fields.cover') }}
                                    </th>
                                    <td>
                                        @if($actus->cover)
                                            <a href="{{ $actus->cover->getUrl() }}" target="_blank">
                                                <img src="{{ $actus->cover->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.actus.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $actus->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.actus.fields.content') }}
                                    </th>
                                    <td>
                                        {!! $actus->content !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.actus.fields.division') }}
                                    </th>
                                    <td>
                                        {{ $actus->division->division ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection