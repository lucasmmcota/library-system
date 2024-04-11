<?php

namespace App\Http\Controllers;

use App\Models\Book;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Response;

class TagController extends Controller
{
    /**
     * Function to generate tags
     * @access public
     * @param string|null $id
     * @return void
     */
    public function generateTag(string $id = null)
    {
        $zpl = $this->getTag(unserialize($id));

        $i = 0;
        $pdfFilename = [];
        foreach ($zpl as $zplCode) {
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, "http://api.labelary.com/v1/printers/8dpmm/labels/8x11/0/");
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $zplCode);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept: application/pdf"));

            $result = curl_exec($curl);

            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                $filename = 'etiqueta_' . $i . '.pdf';
                $pdfFilename[] = $filename;

                $response = Response::make($result, 200);
                $response->header('Content-Type', 'application/pdf');
                $response->header('Content-Disposition', 'attachment; filename=' . $filename);
            } else {
                return "Error: $result";
            }

            file_put_contents(public_path($filename), $response);
            $i++;
        }

        $filename = $this->mergePDFs($pdfFilename);
        $this->deletePDFs($pdfFilename);

        return Response::download($filename, 'etiqueta.pdf');
    }

    /**
     * Function to generate zpl code for a tag
     * @access private
     * @param int|null $id
     * @return array
     */
    private function getTag(int $id = null)
    {
        $books = (new Book())->lstBook(!empty($id) ? $id : null);

        $zplCode = '^XA^CI28';
        $vertical = 20;
        $horizontal = 60;
        $i = 0;
        $zpl = [];
        foreach ($books as $book) {
            $zplCode .= "^ARN,20,10^FO" . $horizontal . "," . $vertical . "^FDAcervo: " . $book['idBookCopie'] . "^FS";
            $zplCode .= "^ARN,20,10^FO" . ($horizontal + 430) . "," . $vertical . "^FDISBN: " . $book['ISBN'] . "^FS";
            $zplCode .= "^ARN,20,10^FO" . $horizontal . "," . ($vertical + 40) . "^FDTítulo: " . $book['title'] . "^FS";
            $zplCode .= "^ARN,20,10^FO" . $horizontal . "," . ($vertical + 80) . "^FDAutor: " . $book['author'] . "^FS";
            $zplCode .= "^BY3,2,120^FO" . $horizontal . "," . ($vertical + 150) . "^BC^FD" . $book['idBookCopie'] . "^FS";
            $zplCode .= "^FO" . ($horizontal + 540) . "," . ($vertical + 10) . "^BQN,2,7^FDHM,N" . $book['idBookCopie'] . "^FS";
            $zplCode .= "^FO" . $horizontal . "," . ($vertical + 315) . "^GB700,3,3^FS";

            if ($i % 2 == 0) {
                $horizontal += 800;
            } else {
                $horizontal -= 800;
                $vertical += 370;
            }

            $i++;
            if ($i == 12) {
                $zplCode .= '^XZ';
                $vertical = 20;
                $i = 0;
                $zpl[] = $zplCode;
                $zplCode = '^XA^CI28';
            }
        }

        if ($i != 0) {
            $zplCode .= '^XZ';
            $zpl[] = $zplCode;
        }

        return $zpl;
    }

    /**
     * Function to merge pdf
     * @access private
     * @param array $pdfFiles name of the pdf files
     * @return string path to merged pdf
     */
    private function mergePDFs(array $pdfFiles)
    {
        // Inicializar o objeto FPDI
        $pdf = new Fpdi();

        // Adicionar as páginas de cada PDF gerado
        foreach ($pdfFiles as $pdfFile) {
            $pageCount = $pdf->setSourceFile($pdfFile);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $templateId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($templateId);
                $orientation = $size['width'] > $size['height'] ? 'L' : 'P';
                $pdf->AddPage($orientation, array($size['width'], $size['height']));
                $pdf->useTemplate($templateId);
            }
        }

        // Gerar o nome do arquivo final
        $mergedPdfFile = public_path('merged_etiquetas.pdf');

        // Salvar o PDF final
        $pdf->Output($mergedPdfFile, 'F');

        return $mergedPdfFile;
    }

    /**
     * Function to remove temporary pdf files
     * @access private
     * @param array $pdfFiles name of pdf files
     * @return void
     */
    private function deletePDFs(array $pdfFiles)
    {
        foreach ($pdfFiles as $pdfFile) {
            $filePath = public_path($pdfFile);

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
}
