<?php
namespace App\Utilities;


use Illuminate\Http\Response;

class ExportCsv
{
    public static function export($columnNames, $dataColumnNames, $dataArr, $fileName = 'file.csv')
    {
        $callback = function() use ($columnNames, $dataColumnNames, $dataArr)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columnNames);

            foreach($dataArr as $dataRow) {
                $rowData = array();
                foreach($dataColumnNames as $dataColumn) {
                    $pos = strpos($dataColumn, "|");
                    if ($pos !== false) {
                        $colArr = explode("|", $dataColumn);
                        if(count($colArr) > 2) {
                            $rowData[] = $dataRow[$colArr[0]][$colArr[1]][$colArr[2]];
                        } else {
                            $rowData[] = $dataRow[$colArr[0]][$colArr[1]];
                        }
                    } else {
                        $rowData[] = $dataRow[$dataColumn];
                    }
                }
                fputcsv($file, $rowData);
            }
            fclose($file);
        };
        return response()->streamDownload($callback, $fileName);
    }
}
