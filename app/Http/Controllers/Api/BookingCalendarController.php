<?php

namespace App\Http\Controllers\Api;

use App\Models\BookingCalendar;
use App\Http\Controllers\Controller;

class BookingCalendarController extends Controller
{
    use BaseApiTrait;

    protected function getModelClass()
    {
        return BookingCalendar::class;
    }

    protected function getStoreValidationRules()
    {
        return [
            'kamar_id' => 'required|exists:kamar,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'quantity' => 'required|integer|min:1'
        ];
    }

    protected function getUpdateValidationRules()
    {
        return [
            'kamar_id' => 'sometimes|required|exists:kamar,id',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after:start_date',
            'quantity' => 'sometimes|required|integer|min:1'
        ];
    }
}