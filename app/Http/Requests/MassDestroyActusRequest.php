<?php

namespace App\Http\Requests;

use App\Actus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyActusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('actus_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:actuses,id',
        ];
    }
}
