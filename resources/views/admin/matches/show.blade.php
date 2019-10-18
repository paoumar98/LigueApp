@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.match.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.match.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $match->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.match.fields.home') }}
                                    </th>
                                    <td>
                                        {{ $match->home->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.match.fields.away') }}
                                    </th>
                                    <td>
                                        {{ $match->away->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.match.fields.start_time') }}
                                    </th>
                                    <td>
                                        {{ $match->start_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.match.fields.ticket') }}
                                    </th>
                                    <td>
                                        ${{ $match->ticket }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.match.fields.result_h') }}
                                    </th>
                                    <td>
                                        {{ $match->result_h }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.match.fields.result_a') }}
                                    </th>
                                    <td>
                                        {{ $match->result_a }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.match.fields.division') }}
                                    </th>
                                    <td>
                                        {{ $match->division->division ?? '' }}
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