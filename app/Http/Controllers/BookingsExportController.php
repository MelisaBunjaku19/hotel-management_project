<?php

namespace App\Http\Controllers;

use App\Exports\BookingsExport;

class BookingsExportController extends Controller
{
    public function exportBookings()
    {
        $export = new BookingsExport();
        return $export->download();
    }
}
