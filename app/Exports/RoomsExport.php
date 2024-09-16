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

    /**
     * Export the rooms and download the file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        $spreadsheet = $this->export();
        $writer = $this->save($spreadsheet);

        // Output to a file
        $fileName = 'rooms.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // Return the file as a response
        return Response::download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
