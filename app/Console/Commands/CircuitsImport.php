<?php

namespace App\Console\Commands;

use App\Circuit;
use App\Company;
use App\Helpers\generalHelper;
use DB;
use Queue;
use App\View;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class circuitsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:circuits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import circuits from spreadsheet';

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
        $run = $this->ask('Companies or circuits?');
        // Check if file exists
        if(Storage::disk("assets")->exists("vc_initial_data_load_1.xlsx")){
            // Init PHPSpreadsheet
            $sheet = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $sheet->setReadDataOnly(true);
            $sheet->setReadEmptyCells(false);
            // When a file has multiple sheets, name the sheet you're looking for - This can be an array of multiple sheets
            $sheet->setLoadSheetsOnly(["TTB Services"]);
            // Get file from storage
            $spreadsheet = $sheet->load(storage_path("assets/vc_initial_data_load_1.xlsx"));
            // Honestly not sure what this does but the docs say we need it
            $sheet = $spreadsheet->getSheet(0);
            $created = 0;
            $updated = 0;
            $missing = [];
            // Iterate each row and count
            $this->info("[".date("H:i:s")."] - " . $run . " SYNC STARTED");
            foreach ($sheet->getRowIterator() as $row) {
                // Ignore first row because that has titles and not data
                if($row->getRowIndex() !== 1){
                    if(strtolower($run) == 'companies'){
                        // Check if entry already exists
                        $existing = Company::where('name', $spreadsheet->getActiveSheet()->getCellByColumnAndRow(5, $row->getRowIndex())->getValue())
                            ->where('api_secondary_link_id', $spreadsheet->getActiveSheet()->getCellByColumnAndRow(1, $row->getRowIndex())->getValue())->first();
                        // Add if it doesn't
                        if(!isset($existing)){
                            Company::insert([
                                'api_secondary_link_id' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(1, $row->getRowIndex())->getValue(), // Site ID
                                'name' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(5, $row->getRowIndex())->getValue(), // Reseller Name
                                'type' => 2,
                                'parent_company_id' => 2,
                                'hash' => '0#1#2#3#',
                                'status' => 1,
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ]);
                            $created++;
                        }
                    }elseif(strtolower($run) == 'circuits'){
                        // Check if entry already exists
                        $existing = Circuit::where('cli', $spreadsheet->getActiveSheet()->getCellByColumnAndRow(2, $row->getRowIndex())->getValue())->first();
                        // Get company
                        $companyId = Company::where('name', $spreadsheet->getActiveSheet()->getCellByColumnAndRow(5, $row->getRowIndex())->getValue())
                            ->where('api_secondary_link_id', $spreadsheet->getActiveSheet()->getCellByColumnAndRow(1, $row->getRowIndex())->getValue())->first();
                        // Update if exists
                        if(isset($existing) && $existing->id != 975){
                            $existing->update([
                                "company_id" => $companyId->id,
                                'updated_at' => date("Y-m-d H:i:s")
                            ]);
                            $updated++;
                        }else{
                            // Excel makes dates a number
                            // The 86400 is number of seconds in a day = 24 * 60 * 60.
                            // The 25569 is the number of days from Jan 1, 1900 to Jan 1, 1970.
                            // Excel base date is Jan 1, 1900 and Unix is Jan 1, 1970.
                            // UNIX date values are in seconds from Jan 1, 1970 (midnight Dec 31, 1969).
                            // So to convert from excel you must subtract the number of days and then convert to seconds
                            $unixDate = ($spreadsheet->getActiveSheet()->getCellByColumnAndRow(3, $row->getRowIndex())->getValue() - 25569) * 86400;
                            $start_date = date('Y-m-d', $unixDate);
                            // Insert circuits that don't exist
                            Circuit::insert([
                                'platform' => 'TTB LLU',
                                'status' => 2,
                                'type' => 2,
                                'company_id' => 2,
                                'cli' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(2, $row->getRowIndex())->getValue(),
                                'supplier_product' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(4, $row->getRowIndex())->getValue(),
                                'activation_date' => $start_date,
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            ]);
                            $created++;
                            // If it doesn't exist, add to an array to dump later
                            $missing[] = [
                                'cli' => $spreadsheet->getActiveSheet()->getCellByColumnAndRow(2, $row->getRowIndex())->getValue(),
                                "company_id" => $companyId->id
                            ];
                        }
                    }
                }
            }
            $this->info("\n[".date("H:i:s")."] - CIRCUIT SYNC COMPLETE");
            if($created > 0) $this->info('Added ' . $created);
            if($updated > 0) $this->info("\nUpdated " . $updated);
            $this->info('');
            if($run == 'circuits'){
                $this->info("\nMissing " . count($missing));
                dump($missing);
            }
            return "exit";
        }else{
            $this->info('File does not exist. Did you mean one of these?');
            // Get and dump files in Storage folder
            $files = Storage::disk('assets')->listContents();
            foreach($files as $file){
                dump($file['basename']);
            }
        }
    }
}
