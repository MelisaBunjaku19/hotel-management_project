<?php

namespace App\Exports;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;

class UsersExport
{
    /**
     * Create a spreadsheet and return it.
     *
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headings
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Created At');
        $sheet->setCellValue('E1', 'Updated At');

        // Fetch data
        $users = User::all();
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->id);
            $sheet->setCellValue('B' . $row, $user->name);
            $sheet->setCellValue('C' . $row, $user->email);
            $sheet->setCellValue('D' . $row, $user->created_at);
            $sheet->setCellValue('E' . $row, $user->updated_at);
            $row++;
        }

        return $spreadsheet;
    }

    /**
     * Create a writer instance to save the spreadsheet.
     *
     * @param \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return \PhpOffice\PhpSpreadsheet\Writer\Xlsx
     */
    public function save($spreadsheet)
    {
        $writer = new Xlsx($spreadsheet);
        return $writer;
    }
}
