@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.match.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.matches.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('home_id') ? 'has-error' : '' }}">
                            <label for="home">{{ trans('cruds.match.fields.home') }}*</label>
                            <select name="home_id" id="home" class="form-control select2" required>
                                @foreach($homes as $id => $home)
                                    <option value="{{ $id }}" {{ (isset($match) && $match->home ? $match->home->id : old('home_id')) == $id ? 'selected' : '' }}>{{ $home }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('home_id'))
                                <p class="help-block">
                                    {{ $errors->first('home_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('away_id') ? 'has-error' : '' }}">
                            <label for="away">{{ trans('cruds.match.fields.away') }}*</label>
                            <select name="away_id" id="away" class="form-control select2" required>
                                @foreach($aways as $id => $away)
                                    <option value="{{ $id }}" {{ (isset($match) && $match->away ? $match->away->id : old('away_id')) == $id ? 'selected' : '' }}>{{ $away }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('away_id'))
                                <p class="help-block">
                                    {{ $errors->first('away_id') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                            <label for="start_time">{{ trans('cruds.match.fields.start_time') }}*</label>
                            <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($match) ? $match->start_time : '') }}" required>
                            @if($errors->has('start_time'))
                                <p class="help-block">
                                    {{ $errors->first('start_time') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.match.fields.start_time_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('ticket') ? 'has-error' : '' }}">
                            <label for="ticket">{{ trans('cruds.match.fields.ticket') }}*</label>
                            <input type="number" id="ticket" name="ticket" class="form-control" value="{{ old('ticket', isset($match) ? $match->ticket : '') }}" step="0.01" required>
                            @if($errors->has('ticket'))
                                <p class="help-block">
                                    {{ $errors->first('ticket') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.match.fields.ticket_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('result_h') ? 'has-error' : '' }}">
                            <label for="result_h">{{ trans('cruds.match.fields.result_h') }}*</label>
                            <input type="number" id="result_h" name="result_h" class="form-control" value="{{ old('result_h', isset($match) ? $match->result_h : '') }}" step="1" required>
                            @if($errors->has('result_h'))
                                <p class="help-block">
                                    {{ $errors->first('result_h') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.match.fields.result_h_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('result_a') ? 'has-error' : '' }}">
                            <label for="result_a">{{ trans('cruds.match.fields.result_a') }}*</label>
                            <input type="number" id="result_a" name="result_a" class="form-control" value="{{ old('result_a', isset($match) ? $match->result_a : '') }}" step="1" required>
                            @if($errors->has('result_a'))
                                <p class="help-block">
                                    {{ $errors->first('result_a') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.match.fields.result_a_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('division_id') ? 'has-error' : '' }}">
                            <label for="division">{{ trans('cruds.match.fields.division') }}*</label>
                            <select name="division_id" id="division" class="form-control select2" required>
                                @foreach($divisions as $id => $division)
                                    <option value="{{ $id }}" {{ (isset($match) && $match->division ? $match->division->id : old('division_id')) == $id ? 'selected' : '' }}>{{ $division }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('division_id'))
                                <p class="help-block">
                                    {{ $errors->first('division_id') }}
                                </p>
                            @endif
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection