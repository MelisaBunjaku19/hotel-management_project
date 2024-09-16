<?php

namespace App\Http\Controllers;

use App\Exports\RoomsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // If you're using Maatwebsite Excel package for export

class RoomExportController extends Controller
{
    /**
     * Handle the export request and return the spreadsheet.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportRooms()
    {
        $export = new RoomsExport();
        return $export->download();
    }
}
