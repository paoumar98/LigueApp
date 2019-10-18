@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.actus.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.actuses.update", [$actus->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group {{ $errors->has('cover') ? 'has-error' : '' }}">
                            <label for="cover">{{ trans('cruds.actus.fields.cover') }}*</label>
                            <div class="needsclick dropzone" id="cover-dropzone">

                            </div>
                            @if($errors->has('cover'))
                                <p class="help-block">
                                    {{ $errors->first('cover') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.actus.fields.cover_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">{{ trans('cruds.actus.fields.title') }}*</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($actus) ? $actus->title : '') }}" required>
                            @if($errors->has('title'))
                                <p class="help-block">
                                    {{ $errors->first('title') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.actus.fields.title_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                            <label for="content">{{ trans('cruds.actus.fields.content') }}*</label>
                            <textarea id="content" name="content" class="form-control " required>{{ old('content', isset($actus) ? $actus->content : '') }}</textarea>
                            @if($errors->has('content'))
                                <p class="help-block">
                                    {{ $errors->first('content') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.actus.fields.content_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('division_id') ? 'has-error' : '' }}">
                            <label for="division">{{ trans('cruds.actus.fields.division') }}</label>
                            <select name="division_id" id="division" class="form-control select2">
                                @foreach($divisions as $id => $division)
                                    <option value="{{ $id }}" {{ (isset($actus) && $actus->division ? $actus->division->id : old('division_id')) == $id ? 'selected' : '' }}>{{ $division }}</option>
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

@section('scripts')
<script>
    Dropzone.options.coverDropzone = {
    url: '{{ route('admin.actuses.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="cover"]').remove()
      $('form').append('<input type="hidden" name="cover" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="cover"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($actus) && $actus->cover)
      var file = {!! json_encode($actus->cover) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="cover" value="' + file.file_name + '">')
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