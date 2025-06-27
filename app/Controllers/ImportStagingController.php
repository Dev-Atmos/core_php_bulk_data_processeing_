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
        // Read a CSV file and return its contents as an array
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            throw new \Exception("Unable to open file.");
        }

        $header = fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
            yield array_combine($header, $row);
        }

        fclose($handle);
    }




    public function importStagingDataSubmit()
    {
        // Handle the form submission for importing staging data
        set_time_limit(0);
        ini_set('memory_limit', '512M');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = !empty($_FILES) ? $_FILES : [];
            move_uploaded_file($data['file']['tmp_name'], UPLOAD_PATH . $data['file']['name']);
            // Assuming the file is a CSV, read it and convert to an array
            $batch = [];
            $batchSize = 200;
            $line = 0;

            foreach ($this->readCSV(UPLOAD_PATH . $data['file']['name']) as $row) {
                $batch[] = $row;
                $line++;

                if ($line % $batchSize === 0) {
                    $this->importData($batch);
                    $batch = [];
                }
            }

            // Import remaining rows
            if (!empty($batch)) {
                $this->importData($batch);
            }
        }

        // Render the import staging data form view
        require_once VIEW_PATH . 'import_staging_data.php';
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
