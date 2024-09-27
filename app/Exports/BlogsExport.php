<?php

namespace App\Exports;

use App\Models\Blog;
use Illuminate\Support\Facades\Response;
use App\Models\User;

class BlogsExport
{
    /**
     * Export blogs as Excel with optional sorting.
     *
     * @param string|null $sortField
     * @param string|null $sortDirection
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadExcel($sortField = null, $sortDirection = 'asc')
    {
        $spreadsheet = $this->createSpreadsheet($sortField, $sortDirection);
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $filename = 'blogs_export_' . date('Ymd_His') . '.xlsx';
        $filePath = storage_path('app/' . $filename);
        $writer->save($filePath);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Export blogs as CSV with optional sorting.
     *
     * @param string|null $sortField
     * @param string|null $sortDirection
     * @return \Illuminate\Http\Response
     */
    public function downloadCsv($sortField = null, $sortDirection = 'asc')
    {
        $filename = 'blogs_export_' . date('Ymd_His') . '.csv';
        $filePath = storage_path('app/' . $filename);

        // Open file in write mode
        $file = fopen($filePath, 'w');

        // Add CSV headers
        fputcsv($file, ['ID', 'Title', 'Category', 'Author', 'Created At']);

        // Fetch blog data and write to CSV with sorting
        $blogs = Blog::with('category', 'author')
            ->orderBy($sortField ?? 'id', $sortDirection)
            ->get();

            foreach ($blogs as $blog) {
                $category = $blog->category->name ?? 'N/A';
                $author = $blog->author ? $blog->author->name : 'N/A'; // Adjust this line
                $createdAt = $blog->created_at ? $blog->created_at->format('d-m-Y') : 'N/A';
                fputcsv($file, [$blog->id, $blog->title, $category, $author, $createdAt]);
            }
            

        // Close the CSV file
        fclose($file);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Export blogs as JSON with optional sorting.
     *
     * @param string|null $sortField
     * @param string|null $sortDirection
     * @return \Illuminate\Http\Response
     */
    public function downloadJson($sortField = null, $sortDirection = 'asc')
    {
        $filename = 'blogs_export_' . date('Ymd_His') . '.json';
        $filePath = storage_path('app/' . $filename);

        // Fetch blog data with sorting
        $blogs = Blog::with('category', 'author')
            ->orderBy($sortField ?? 'id', $sortDirection)
            ->get()
            ->map(function ($blog) {
                return [
                    'ID' => $blog->id,
                    'Title' => $blog->title,
                    'Category' => $blog->category->name ?? 'N/A',
                    'Author' => $blog->author->name ?? 'N/A',
                    'Created At' => $blog->created_at ? $blog->created_at->format('d-m-Y') : 'N/A'
                ];
            });

        // Write JSON to file
        file_put_contents($filePath, $blogs->toJson(JSON_PRETTY_PRINT));

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Create a Spreadsheet object for Excel export with optional sorting.
     *
     * @param string|null $sortField
     * @param string|null $sortDirection
     * @return \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    private function createSpreadsheet($sortField = null, $sortDirection = 'asc')
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column headings
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Category');
        $sheet->setCellValue('D1', 'Author');
        $sheet->setCellValue('E1', 'Created At');

        // Fetch blog data and fill spreadsheet with sorting
        $blogs = Blog::with('category', 'author')
            ->orderBy($sortField ?? 'id', $sortDirection)
            ->get();
        $row = 2;

        foreach ($blogs as $blog) {
            $sheet->setCellValue('A' . $row, $blog->id);
            $sheet->setCellValue('B' . $row, $blog->title);
            $sheet->setCellValue('C' . $row, $blog->category->name ?? 'N/A');
            $sheet->setCellValue('D' . $row, $blog->author->name ?? 'N/A');
            $sheet->setCellValue('E' . $row, $blog->created_at ? $blog->created_at->format('d-m-Y') : 'N/A');
            $row++;
        }

        return $spreadsheet;
    }
}
