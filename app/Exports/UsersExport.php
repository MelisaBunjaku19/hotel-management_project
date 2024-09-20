<?php

namespace App\Exports;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer as CsvWriter;
use Illuminate\Support\Facades\Storage;

class UsersExport
{
    /**
     * Create a spreadsheet for Excel export.
     *
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headings
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Phone');
        $sheet->setCellValue('E1', 'Role');
        $sheet->setCellValue('F1', 'Created At');
        $sheet->setCellValue('G1', 'Updated At');

        // Fetch data
        $users = User::all();
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->id);
            $sheet->setCellValue('B' . $row, $user->name);
            $sheet->setCellValue('C' . $row, $user->email);
            $sheet->setCellValue('D' . $row, $user->phone ?? 'N/A'); // Ensure 'phone' is handled properly
            $sheet->setCellValue('E' . $row, $user->usertype); // Assuming 'usertype' is the role field
            $sheet->setCellValue('F' . $row, $user->created_at->format('d-m-Y H:i:s')); // Format datetime
            $sheet->setCellValue('G' . $row, $user->updated_at->format('d-m-Y H:i:s')); // Format datetime
            $row++;
        }

        return $spreadsheet;
    }

    /**
     * Create a writer instance for Excel export.
     *
     * @param \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return \PhpOffice\PhpSpreadsheet\Writer\Xlsx
     */
    public function saveExcel($spreadsheet)
    {
        $writer = new Xlsx($spreadsheet);
        return $writer;
    }

    /**
     * Export users as Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadExcel()
    {
        $spreadsheet = $this->exportExcel();
        $writer = $this->saveExcel($spreadsheet);

        $filename = 'users_export_' . date('Ymd_His') . '.xlsx';
        $filePath = storage_path('app/' . $filename);
        $writer->save($filePath);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Export users as CSV.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadCsv()
    {
        $filename = 'users_export_' . date('Ymd_His') . '.csv';
        $filePath = storage_path('app/' . $filename);

        // Open file in write mode
        $file = fopen($filePath, 'w');

        // Add CSV headers
        fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Role', 'Created At', 'Updated At']);

        // Fetch user data and write to CSV
        $users = User::all();
        foreach ($users as $user) {
            fputcsv($file, [
                $user->id,
                $user->name,
                $user->email,
                $user->phone ?? 'N/A',
                $user->usertype,
                $user->created_at->format('d-m-Y H:i:s'),
                $user->updated_at->format('d-m-Y H:i:s'),
            ]);
        }

        // Close the CSV file
        fclose($file);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Export users as JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadJson()
    {
        $filename = 'users_export_' . date('Ymd_His') . '.json';
        $filePath = storage_path('app/' . $filename);

        // Fetch user data
        $users = User::all()->map(function ($user) {
            return [
                'ID' => $user->id,
                'Name' => $user->name,
                'Email' => $user->email,
                'Phone' => $user->phone ?? 'N/A',
                'Role' => $user->usertype,
                'Created At' => $user->created_at ? $user->created_at->format('d-m-Y H:i:s') : 'N/A',
                'Updated At' => $user->updated_at ? $user->updated_at->format('d-m-Y H:i:s') : 'N/A',
            ];
        });

        // Write JSON to file
        file_put_contents($filePath, $users->toJson(JSON_PRETTY_PRINT));

        return Response::download($filePath)->deleteFileAfterSend(true);
    }
}
