<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Actus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreActusRequest;
use App\Http\Requests\UpdateActusRequest;
use App\Http\Resources\Admin\ActusResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActusApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('actus_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ActusResource(Actus::with(['division'])->get());
    }

    public function store(StoreActusRequest $request)
    {
        $actus = Actus::create($request->all());

        if ($request->input('cover', false)) {
            $actus->addMedia(storage_path('tmp/uploads/' . $request->input('cover')))->toMediaCollection('cover');
        }

        return (new ActusResource($actus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Actus $actus)
    {
        abort_if(Gate::denies('actus_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ActusResource($actus->load(['division']));
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

        return (new ActusResource($actus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Actus $actus)
    {
        abort_if(Gate::denies('actus_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
