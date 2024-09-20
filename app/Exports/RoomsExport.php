<?php

namespace App\Exports;

use App\Models\Room;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class RoomsExport
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
        $sheet->setCellValue('B1', 'Room Title');
        $sheet->setCellValue('C1', 'Image');
        $sheet->setCellValue('D1', 'Description');
        $sheet->setCellValue('E1', 'Price');
        $sheet->setCellValue('F1', 'Room Type');
        $sheet->setCellValue('G1', 'WiFi');
        $sheet->setCellValue('H1', 'Created At');
        $sheet->setCellValue('I1', 'Updated At');

        // Fetch data
        $rooms = Room::all();
        $row = 2;
        foreach ($rooms as $room) {
            $sheet->setCellValue('A' . $row, $room->id);
            $sheet->setCellValue('B' . $row, $room->room_title);
            $sheet->setCellValue('C' . $row, $room->image);
            $sheet->setCellValue('D' . $row, $room->description);
            $sheet->setCellValue('E' . $row, $room->price);
            $sheet->setCellValue('F' . $row, $room->room_type);
            $sheet->setCellValue('G' . $row, $room->wifi ? 'Yes' : 'No');
            $sheet->setCellValue('H' . $row, $room->created_at);
            $sheet->setCellValue('I' . $row, $room->updated_at);
            $row++;
        }

        return $spreadsheet;
    }

    /**
     * Save the spreadsheet to a file.
     *
     * @param \PhpOffice\PhpSpreadsheet\Spreadsheet $spreadsheet
     * @return \PhpOffice\PhpSpreadsheet\Writer\Xlsx
     */
    public function save($spreadsheet)
    {
        return new Xlsx($spreadsheet);
    }

    /**
     * Export the rooms and download as Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel()
    {
        $spreadsheet = $this->export();
        $writer = $this->save($spreadsheet);

        // Output to a file
        $fileName = 'rooms.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return Response::download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Export the rooms and download as CSV.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadCsv()
    {
        $fileName = 'rooms.csv';
        $filePath = storage_path('app/' . $fileName);

        // Open file for writing
        $file = fopen($filePath, 'w');

        // Add CSV headers
        fputcsv($file, ['ID', 'Room Title', 'Image', 'Description', 'Price', 'Room Type', 'WiFi', 'Created At', 'Updated At']);

        // Fetch data and write to CSV
        $rooms = Room::all();
        foreach ($rooms as $room) {
            fputcsv($file, [
                $room->id,
                $room->room_title,
                $room->image,
                $room->description,
                $room->price,
                $room->room_type,
                $room->wifi ? 'Yes' : 'No',
                $room->created_at,
                $room->updated_at,
            ]);
        }

        fclose($file);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Export the rooms and download as JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadJson()
    {
        $fileName = 'rooms.json';
        $filePath = storage_path('app/' . $fileName);

        // Fetch data
        $rooms = Room::all();
        $data = $rooms->map(function ($room) {
            return [
                'ID' => $room->id,
                'Room Title' => $room->room_title,
                'Image' => $room->image,
                'Description' => $room->description,
                'Price' => $room->price,
                'Room Type' => $room->room_type,
                'WiFi' => $room->wifi ? 'Yes' : 'No',
                'Created At' => $room->created_at,
                'Updated At' => $room->updated_at,
            ];
        });

        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));

        return Response::download($filePath)->deleteFileAfterSend(true);
    }
}
