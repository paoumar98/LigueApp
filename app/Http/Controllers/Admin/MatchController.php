<?php

namespace App\Http\Controllers\Admin;

use App\Equipe;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMatchRequest;
use App\Http\Requests\StoreMatchRequest;
use App\Http\Requests\UpdateMatchRequest;
use App\Match;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Match::with(['home', 'away', 'division'])->select(sprintf('%s.*', (new Match)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'match_show';
                $editGate      = 'match_edit';
                $deleteGate    = 'match_delete';
                $crudRoutePart = 'matches';

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
            $table->addColumn('home_name', function ($row) {
                return $row->home ? $row->home->name : '';
            });

            $table->addColumn('away_name', function ($row) {
                return $row->away ? $row->away->name : '';
            });

            $table->editColumn('ticket', function ($row) {
                return $row->ticket ? $row->ticket : "";
            });
            $table->editColumn('result_h', function ($row) {
                return $row->result_h ? $row->result_h : "";
            });
            $table->editColumn('result_a', function ($row) {
                return $row->result_a ? $row->result_a : "";
            });
            $table->addColumn('division_division', function ($row) {
                return $row->division ? $row->division->division : '';
            });

            $table->editColumn('division.name', function ($row) {
                return $row->division ? (is_string($row->division) ? $row->division : $row->division->name) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'home', 'away', 'division']);

            return $table->make(true);
        }

        return view('admin.matches.index');
    }

    public function create()
    {
        abort_if(Gate::denies('match_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homes = Equipe::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aways = Equipe::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Equipe::all()->pluck('division', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.matches.create', compact('homes', 'aways', 'divisions'));
    }

    public function store(StoreMatchRequest $request)
    {
        $match = Match::create($request->all());

        return redirect()->route('admin.matches.index');
    }

    public function edit(Match $match)
    {
        abort_if(Gate::denies('match_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homes = Equipe::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aways = Equipe::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Equipe::all()->pluck('division', 'id')->prepend(trans('global.pleaseSelect'), '');

        $match->load('home', 'away', 'division');

        return view('admin.matches.edit', compact('homes', 'aways', 'divisions', 'match'));
    }

    public function update(UpdateMatchRequest $request, Match $match)
    {
        $match->update($request->all());

        return redirect()->route('admin.matches.index');
    }

    public function show(Match $match)
    {
        abort_if(Gate::denies('match_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $match->load('home', 'away', 'division');

        return view('admin.matches.show', compact('match'));
    }

    public function destroy(Match $match)
    {
        abort_if(Gate::denies('match_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $match->delete();

        return back();
    }

    public function massDestroy(MassDestroyMatchRequest $request)
    {
        Match::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
