<?php

namespace App\Http\Requests;

use App\Match;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateMatchRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('match_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'home_id'     => [
                'required',
                'integer',
            ],
            'away_id'     => [
                'required',
                'integer',
            ],
            'start_time'  => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'ticket'      => [
                'required',
            ],
            'result_h'    => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'result_a'    => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'division_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
