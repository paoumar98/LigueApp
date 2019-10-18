<?php

namespace App\Http\Controllers\Admin;

use App\Actus;
use App\Equipe;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyActusRequest;
use App\Http\Requests\StoreActusRequest;
use App\Http\Requests\UpdateActusRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ActusController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Actus::with(['division'])->select(sprintf('%s.*', (new Actus)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'actus_show';
                $editGate      = 'actus_edit';
                $deleteGate    = 'actus_delete';
                $crudRoutePart = 'actuses';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('cover', function ($row) {
                if ($photo = $row->cover) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->editColumn('content', function ($row) {
                return $row->content ? $row->content : "";
            });
            $table->addColumn('division_division', function ($row) {
                return $row->division ? $row->division->division : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'cover', 'division']);

            return $table->make(true);
        }

        return view('admin.actuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('actus_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Equipe::all()->pluck('division', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.actuses.create', compact('divisions'));
    }

    public function store(StoreActusRequest $request)
    {
        $actus = Actus::create($request->all());

        if ($request->input('cover', false)) {
            $actus->addMedia(storage_path('tmp/uploads/' . $request->input('cover')))->toMediaCollection('cover');
        }

        return redirect()->route('admin.actuses.index');
    }

    public function edit(Actus $actus)
    {
        abort_if(Gate::denies('actus_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Equipe::all()->pluck('division', 'id')->prepend(trans('global.pleaseSelect'), '');

        $actus->load('division');

        return view('admin.actuses.edit', compact('divisions', 'actus'));
    }

    public function update(UpdateActusRequest $request, Actus $actus)
    {
        $actus->update($request->all());

        if ($request->input('cover', false)) {
            if (!$actus->cover || $request->input('cover') !== $actus->cover->file_name) {
                $actus->addMedia(storage_path('tmp/uploads/' . $request->input('cover')))->toMediaCollection('cover');
            }
        } elseif ($actus->cover) {
            $actus->cover->delete();
        }

        return redirect()->route('admin.actuses.index');
    }

    public function show(Actus $actus)
    {
        abort_if(Gate::denies('actus_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actus->load('division');

        return view('admin.actuses.show', compact('actus'));
    }

    public function destroy(Actus $actus)
    {
        abort_if(Gate::denies('actus_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actus->delete();

        return back();
    }

    public function massDestroy(MassDestroyActusRequest $request)
    {
        Actus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
