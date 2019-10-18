<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Equipe;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEquipeRequest;
use App\Http\Requests\UpdateEquipeRequest;
use App\Http\Resources\Admin\EquipeResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EquipeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('equipe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EquipeResource(Equipe::all());
    }

    public function store(StoreEquipeRequest $request)
    {
        $equipe = Equipe::create($request->all());

        if ($request->input('logo', false)) {
            $equipe->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        return (new EquipeResource($equipe))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Equipe $equipe)
    {
        abort_if(Gate::denies('equipe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EquipeResource($equipe);
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

        return (new EquipeResource($equipe))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Equipe $equipe)
    {
        abort_if(Gate::denies('equipe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $equipe->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
