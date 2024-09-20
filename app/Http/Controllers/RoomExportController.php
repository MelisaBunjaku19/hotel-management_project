<?php

namespace App\Http\Controllers;

use App\Exports\RoomsExport;

class RoomExportController extends Controller
{
    /**
     * Export rooms as Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportRooms()
    {
        $export = new RoomsExport();
        return $export->downloadExcel();
    }

    /**
     * Export rooms as CSV.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportRoomsCsv()
    {
        $export = new RoomsExport();
        return $export->downloadCsv();
    }

    /**
     * Export rooms as JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportRoomsJson()
    {
        $export = new RoomsExport();
        return $export->downloadJson();
    }
}
