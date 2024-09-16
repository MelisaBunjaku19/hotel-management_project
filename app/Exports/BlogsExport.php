<?php

namespace App\Exports;

use App\Models\Blog;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class BlogsExport
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
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Category');
        $sheet->setCellValue('D1', 'Author');
        $sheet->setCellValue('E1', 'Created At');
    
        // Fetch data
        $blogs = Blog::with('category', 'author')->get();
        $row = 2;
    
        foreach ($blogs as $blog) {
            $sheet->setCellValue('A' . $row, $blog->id);
            $sheet->setCellValue('B' . $row, $blog->title);
            $sheet->setCellValue('C' . $row, $blog->category->name ?? 'N/A');
            $sheet->setCellValue('D' . $row, is_string($blog->author) ? json_decode($blog->author)->name ?? 'N/A' : ($blog->author->name ?? 'N/A'));
    
            // Check if created_at is not null
            $createdAt = $blog->created_at ? $blog->created_at->format('d-m-Y') : 'N/A';
            $sheet->setCellValue('E' . $row, $createdAt);
    
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
     * Export the blogs and download the file.
     *
     * @return \Illuminate\Http\Response
     */
    public function download()
    {
        $spreadsheet = $this->export();
        $writer = $this->save($spreadsheet);

        // Output to a file
        $fileName = 'blogs.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // Return the file as a response
        return Response::download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}
