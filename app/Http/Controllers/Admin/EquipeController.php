<?php

namespace App\Http\Controllers\Admin;

use App\Equipe;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEquipeRequest;
use App\Http\Requests\StoreEquipeRequest;
use App\Http\Requests\UpdateEquipeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EquipeController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Equipe::query()->select(sprintf('%s.*', (new Equipe)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'equipe_show';
                $editGate      = 'equipe_edit';
                $deleteGate    = 'equipe_delete';
                $crudRoutePart = 'equipes';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('division', function ($row) {
                return $row->division ? Equipe::DIVISION_RADIO[$row->division] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'logo']);

            return $table->make(true);
        }

        return view('admin.equipes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('equipe_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.equipes.create');
    }

    public function store(StoreEquipeRequest $request)
    {
        $equipe = Equipe::create($request->all());

        if ($request->input('logo', false)) {
            $equipe->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        return redirect()->route('admin.equipes.index');
    }

    public function edit(Equipe $equipe)
    {
        abort_if(Gate::denies('equipe_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.equipes.edit', compact('equipe'));
    }

    public function update(UpdateEquipeRequest $request, Equipe $equipe)
    {
        $equipe->update($request->all());

        if ($request->input('logo', false)) {
            if (!$equipe->logo || $request->input('logo') !== $equipe->logo->file_name) {
                $equipe->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($equipe->logo) {
            $equipe->logo->delete();
        }

        return redirect()->route('admin.equipes.index');
    }

    public function show(Equipe $equipe)
    {
        abort_if(Gate::denies('equipe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.equipes.show', compact('equipe'));
    }

    public function destroy(Equipe $equipe)
    {
        abort_if(Gate::denies('equipe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipe->delete();

        return back();
    }

    public function massDestroy(MassDestroyEquipeRequest $request)
    {
        Equipe::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
