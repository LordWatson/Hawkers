<?php

namespace App\Console\Commands;

use DB;
use Queue;
use App\View;
use Illuminate\Console\Command;

class PostcodesImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:postcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import postcodes from master spreadsheet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sheet = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $sheet->setReadDataOnly(true);
        $sheet->setReadEmptyCells(false);

        $spreadsheet = $sheet->load(storage_path("assets/PN01_Master.xlsx"));

        $sheet = $spreadsheet->getSheet(0);

        foreach ($sheet->getRowIterator() as $row) {
            if($row->getRowIndex() !== 1){
                $existing = DB::connection('sqlite')->table('postcodes')->where('uprn', $spreadsheet->getActiveSheet()->getCellByColumnAndRow(1, $row->getRowIndex())->getValue())->first();
                if(!isset($existing)){
                    DB::connection('sqlite')->table('postcodes')->insert([
                        'uprn' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(1, $row->getRowIndex())->getValue(),
                        'building' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(5, $row->getRowIndex())->getValue(),
                        'street' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(9, $row->getRowIndex())->getValue(),
                        'city' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(10, $row->getRowIndex())->getValue(),
                        'postcode' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(11, $row->getRowIndex())->getValue(),
                        'company' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(2, $row->getRowIndex())->getValue(),
                        'sub_building' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(3, $row->getRowIndex())->getValue(),
                        'classification' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(12, $row->getRowIndex())->getValue(),
                        'type' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(13, $row->getRowIndex())->getValue(),
                        'created_at' => date("Y-m-d H:i:s")
                    ]);
                }
            }

        }
        return "done";
    }
}
