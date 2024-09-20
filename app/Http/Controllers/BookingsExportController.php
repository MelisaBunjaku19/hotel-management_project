<?php

namespace App\Http\Controllers;

use App\Exports\BookingsExport;

class BookingsExportController extends Controller
{
    /**
     * Export bookings as Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportBookings()
    {
        $export = new BookingsExport();
        return $export->downloadExcel();
    }

    /**
     * Export bookings as CSV.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportBookingsCsv()
    {
        $export = new BookingsExport();
        return $export->downloadCsv();
    }

    /**
     * Export bookings as JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportBookingsJson()
    {
        $export = new BookingsExport();
        return $export->downloadJson();
    }
}
