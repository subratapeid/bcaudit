<?php
include "../include/auth.php";
require_once 'config.php';

/* ===============================
   CSV UPLOAD FUNCTION
================================ */

function normalizeBcId($value): string
{
    $value = trim($value);

    // If Excel scientific notation detected
    if (stripos($value, 'E') !== false) {
        $value = sprintf('%.0f', (float) $value);
    }

    return $value;
}

function uploadCSVFile(): string|false
{
    if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $dir = __DIR__ . '/uploads/';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $fileName = time() . '_' . basename($_FILES['csv_file']['name']);
    $path = $dir . $fileName;

    return move_uploaded_file($_FILES['csv_file']['tmp_name'], $path)
        ? $path
        : false;
}

/* ===============================
   INSERT CSV RECORDS
================================ */
function insertRecordsFromCSV(string $csvFile, PDO $pdo): array
{
    $response = [];
    $userId = $_SESSION['user_id'];

    /* ---- Load existing BC IDs (DB SIDE CHECK) ---- */
    $existingIds = $pdo
        ->query("SELECT bca_id FROM all_bc_details")
        ->fetchAll(PDO::FETCH_COLUMN);

    $existingIds = array_flip($existingIds); // fast lookup

    /* ---- Track duplicates inside CSV ---- */
    $csvIds = [];

    $pdo->beginTransaction();

    $insertSQL = "
        INSERT INTO all_bc_details (
            bca_id, first_name, middle_name, last_name, bca_contact_no,
            bca_email_id, bc_point_name, transaction_module, village, location,
            district, state, pin, landmark, bca_bank, bca_bank_branch,
            bc_point_address, abe_name, abm_name, rm_name, zm_name, created_by_id
        ) VALUES (
            ?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?
        )
    ";

    $stmt = $pdo->prepare($insertSQL);

    if (($handle = fopen($csvFile, 'r')) !== false) {

        fgetcsv($handle); // skip header row

        while (($data = fgetcsv($handle, 2000, ',')) !== false) {

            if (empty($data[0])) {
                continue;
            }

            // $bcId = trim($data[0]);
            $bcId = normalizeBcId($data[0]);

            $fullName = trim(
                ($data[1] ?? '') . ' ' .
                ($data[2] ?? '') . ' ' .
                ($data[3] ?? '')
            );

            /* ---- DUPLICATE CHECK INSIDE CSV ---- */
            if (isset($csvIds[$bcId])) {
                // $response[] = [$bcId, $fullName, 'Duplicate in CSV'];
                $response[] = ['="' . $bcId . '"', $fullName, 'Duplicate in CSV'];

                continue;
            }
            $csvIds[$bcId] = true;

            /* ---- DUPLICATE CHECK IN DATABASE ---- */
            if (isset($existingIds[$bcId])) {
                // $response[] = [$bcId, $fullName, 'Already exists in DB'];
                $response[] = ['="' . $bcId . '"', $fullName, 'Already exists in DB'];
                continue;
            }

            /* ---- PREPARE EXACT 22 VALUES ---- */
            $params = [
                $bcId,
                $data[1] ?? '',
                $data[2] ?? '',
                $data[3] ?? '',
                $data[4] ?? '',
                $data[5] ?? '',
                $data[6] ?? '',
                $data[7] ?? '',
                $data[8] ?? '',
                $data[9] ?? '',
                $data[10] ?? '',
                $data[11] ?? '',
                $data[12] ?? '',
                $data[13] ?? '',
                $data[14] ?? '',
                $data[15] ?? '',
                $data[16] ?? '',
                $data[17] ?? '',
                $data[18] ?? '',
                $data[19] ?? '',
                $data[20] ?? '',
                $userId
            ];

            try {
                $stmt->execute($params);

                // mark inserted BC ID
                $existingIds[$bcId] = true;

                // $response[] = [$bcId, $fullName, 'Inserted'];
                $response[] = ['="' . $bcId . '"', $fullName, 'Inserted'];

            } catch (PDOException $e) {
                // $response[] = [$bcId, $fullName, 'Error'];
                $response[] = ['="' . $bcId . '"', $fullName, 'Error'];

            }
        }

        fclose($handle);
    }

    $pdo->commit();
    return $response;
}

/* ===============================
   MAIN REQUEST HANDLER
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $csvFile = uploadCSVFile();

    if (!$csvFile) {
        echo "CSV upload failed.";
        exit;
    }

    $response = insertRecordsFromCSV($csvFile, $pdo);

    $responseDir = __DIR__ . '/response/';
    if (!is_dir($responseDir)) {
        mkdir($responseDir, 0777, true);
    }

    $responseFile = $responseDir . 'response_' . time() . '.csv';
    $fp = fopen($responseFile, 'w');

    fputcsv($fp, ['BC ID', 'Full Name', 'Status']);
    foreach ($response as $row) {
        fputcsv($fp, $row);
    }
    fclose($fp);

    $link = 'download_response.php?file=' . urlencode(basename($responseFile));

    echo "Bulk upload completed successfully. 
<a href=\"$link\">Download Response</a>";


}

unset($pdo);
