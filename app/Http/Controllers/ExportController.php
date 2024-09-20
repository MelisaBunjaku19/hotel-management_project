<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Export users as Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportUsers()
    {
        $export = new UsersExport();
        return $export->downloadExcel();
    }

    /**
     * Export users as CSV.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportUsersCsv()
    {
        $export = new UsersExport();
        return $export->downloadCsv();
    }

    /**
     * Export users as JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportUsersJson()
    {
        $export = new UsersExport();
        return $export->downloadJson();
    }
}
