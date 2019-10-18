@extends('layouts.admin')
@section('content')
<div class="content">
    @can('actus_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.actuses.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.actus.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.actus.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Actus">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>
                                    {{ trans('cruds.actus.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.actus.fields.cover') }}
                                </th>
                                <th>
                                    {{ trans('cruds.actus.fields.title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.actus.fields.content') }}
                                </th>
                                <th>
                                    {{ trans('cruds.actus.fields.division') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('actus_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.actuses.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.actuses.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'cover', name: 'cover', sortable: false, searchable: false },
{ data: 'title', name: 'title' },
{ data: 'content', name: 'content' },
{ data: 'division_division', name: 'division.division' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-Actus').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection