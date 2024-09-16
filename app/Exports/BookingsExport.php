<?php

namespace App\Exports;

use App\Models\Booking;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class BookingsExport
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
        $sheet->setCellValue('C1', 'Arrival Date');
        $sheet->setCellValue('D1', 'Departure Date');
        $sheet->setCellValue('E1', 'Amount Paid');
        $sheet->setCellValue('F1', 'Status');
        $sheet->setCellValue('G1', 'User ID');
        $sheet->setCellValue('H1', 'Created At');
        $sheet->setCellValue('I1', 'Updated At');

        // Fetch data
        $bookings = Booking::with('room')->get();
        $row = 2;
        foreach ($bookings as $booking) {
            $sheet->setCellValue('A' . $row, $booking->id);
            $sheet->setCellValue('B' . $row, $booking->room->room_title);
            $sheet->setCellValue('C' . $row, $booking->arrival_date);
            $sheet->setCellValue('D' . $row, $booking->departure_date);
            $sheet->setCellValue('E' . $row, $booking->amount_paid);
            $sheet->setCellValue('F' . $row, $booking->status);
            $sheet->setCellValue('G' . $row, $booking->user_id);
            $sheet->setCellValue('H' . $row, $booking->created_at);
            $sheet->setCellValue('I' . $row, $booking->updated_at);
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
     * Export the bookings and download the file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        $spreadsheet = $this->export();
        $writer = $this->save($spreadsheet);

        // Output to a file
        $fileName = 'bookings.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // Return the file as a response
        return Response::download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
