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
     * Export the bookings and download the file as Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel()
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

    /**
     * Export the bookings and download the file as CSV.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadCsv()
    {
        $fileName = 'bookings.csv';
        $filePath = storage_path('app/' . $fileName);

        // Open file in write mode
        $file = fopen($filePath, 'w');

        // Add CSV headers
        fputcsv($file, ['ID', 'Room Title', 'Arrival Date', 'Departure Date', 'Amount Paid', 'Status', 'User ID', 'Created At', 'Updated At']);

        // Fetch data and write to CSV
        $bookings = Booking::with('room')->get();
        foreach ($bookings as $booking) {
            fputcsv($file, [
                $booking->id,
                $booking->room->room_title,
                $booking->arrival_date,
                $booking->departure_date,
                $booking->amount_paid,
                $booking->status,
                $booking->user_id,
                $booking->created_at,
                $booking->updated_at,
            ]);
        }

        // Close the CSV file
        fclose($file);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Export the bookings and download the file as JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadJson()
    {
        $fileName = 'bookings.json';
        $filePath = storage_path('app/' . $fileName);

        // Fetch data
        $bookings = Booking::with('room')->get();
        $data = $bookings->map(function ($booking) {
            return [
                'ID' => $booking->id,
                'Room Title' => $booking->room->room_title,
                'Arrival Date' => $booking->arrival_date,
                'Departure Date' => $booking->departure_date,
                'Amount Paid' => $booking->amount_paid,
                'Status' => $booking->status,
                'User ID' => $booking->user_id,
                'Created At' => $booking->created_at,
                'Updated At' => $booking->updated_at,
            ];
        });

        // Save JSON file
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));

        return Response::download($filePath)->deleteFileAfterSend(true);
    }
}
