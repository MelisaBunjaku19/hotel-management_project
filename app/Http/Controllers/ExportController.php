<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    public function exportUsers()
    {
        $export = new UsersExport();
        $spreadsheet = $export->export();
        $writer = $export->save($spreadsheet);

        // Create a temporary file to save the spreadsheet
        $tempFile = tempnam(sys_get_temp_dir(), 'users');
        $writer->save($tempFile);

        // Return the file as a download response
        return Response::download($tempFile, 'users.xlsx')->deleteFileAfterSend(true);
    }
}
