@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.equipe.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.equipes.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.equipe.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($equipe) ? $equipe->name : '') }}" required>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipe.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                            <label for="logo">{{ trans('cruds.equipe.fields.logo') }}*</label>
                            <div class="needsclick dropzone" id="logo-dropzone">

                            </div>
                            @if($errors->has('logo'))
                                <p class="help-block">
                                    {{ $errors->first('logo') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.equipe.fields.logo_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('division') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.equipe.fields.division') }}*</label>
                            @foreach(App\Equipe::DIVISION_RADIO as $key => $label)
                                <div>
                                    <input id="division_{{ $key }}" name="division" type="radio" value="{{ $key }}" {{ old('division', null) === (string)$key ? 'checked' : '' }} required>
                                    <label for="division_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('division'))
                                <p class="help-block">
                                    {{ $errors->first('division') }}
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

@section('scripts')
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.equipes.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($equipe) && $equipe->logo)
      var file = {!! json_encode($equipe->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@stop