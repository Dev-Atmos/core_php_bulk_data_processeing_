<?php

namespace App\Controllers;

use App\Models\ImportStagingData;


class ImportStagingController
{
    private $importStagingData;

    public function __construct()
    {
        // Initialize the ImportStagingData model with a PDO instance

        $this->importStagingData = new ImportStagingData();
    }


    public function form()
    {
        // Render the import staging data form view
        require_once VIEW_PATH . 'import_staging_data.php';
    }

    private function readCSV($filePath)
    {
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            throw new \Exception("Unable to open CSV.");
        }

        $header = fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
           
            $data = [];
            $data['Customer_Id'] = $row[1];
            $data['First_Name'] = $row[2];
            $data['Last_Name'] = $row[3];
            $data['Company'] = $row[4];
            $data['City'] = $row[5];
            $data['Country'] = $row[6];
            $data['Phone_1'] = $row[7];
            $data['Phone_2'] = $row[8];
            $data['Email'] = $row[9];
            $data['Subscription_Date'] = $row[10];
            $data['Website'] = $row[11];
            yield $data;
        }

        fclose($handle);
    }


    public function importStagingDataSubmit()
    {
        // Handle the form submission for importing staging data
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_FILES);
            if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
                die("❌ Upload failed.");
            }

            $uploadPath = UPLOAD_PATH;
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $fileName = basename($_FILES['csv_file']['name']);
            $targetPath = $uploadPath . $fileName;

            $data = !empty($_FILES) ? $_FILES : [];


            if (!move_uploaded_file($_FILES['csv_file']['tmp_name'], $targetPath)) {
                die("❌ Could not move uploaded file.");
            }
            // Assuming the file is a CSV, read it and convert to an array
            $batch = [];
            $batchSize = 500;
            $line = 0;

            foreach ($this->readCSV($targetPath) as $row) {
                $batch[] = $row;
                $line++;

                if (count($batch) >= $batchSize) {
                    $this->importData($batch);
                    log_info("Imported batch at line $line");
                    $batch = [];
                }
            }

            // Import remaining rows
            if (!empty($batch)) {
                $this->importData($batch);
                log_info("Imported batch at line $line");
            }
            flashMessage('import_staging_data', '✅ Data imported successfully!', 'success');
        }

        // Render the import staging data form view
        redirect('import-staging-data');
    }

    public function importData(array $data)
    {

        $this->importStagingData->importData($data);
    }

    public function getStagingData()
    {
        return $this->importStagingData->getStagingData();
    }

    public function clearStagingData()
    {
        $this->importStagingData->clearStagingData();
    }

    public function deleteStagingData($id)
    {
        $this->importStagingData->deleteStagingData($id);
    }
}
