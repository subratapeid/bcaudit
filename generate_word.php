<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\ListItem;

// Create a new Word document
$phpWord = new PhpWord();
$section = $phpWord->addSection();

// Add header with a logo
$header = $section->addHeader();
$header->addImage('assets/images/logo.png', [
    'width' => 100,
    'height' => 50,
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
]);

$header->addText('Your Company Name', [
    'bold' => true,
    'size' => 16,
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
]);

$header->addTextBreak(1);

// Example Data (you can replace this with your actual DB data later)
$fullName = "John Doe";
$userId = "User0354";
$address = "1234 Elm Street, Springfield";
$state = "Karnataka";

// Add user details in a single line
$section->addText(
    "Name: " . $fullName . "\t\tUser ID: " . $userId,
    ['size' => 12]
);
$section->addText(
    "Address: " . $address . "\t\tState: " . $state,
    ['size' => 12]
);
$section->addTextBreak(1);

// Example Paragraph
$section->addText(
    "This is an example paragraph which is inside the Word document and it may be up to 60 words. The content here will represent any additional information you want to include in this section of the document.",
    ['size' => 12]
);
$section->addTextBreak(2);

// Add Bullet Points
$section->addText('Key Points:', ['bold' => true, 'size' => 12]);
$section->addListItem('First point of importance.', 0, null, ListItem::TYPE_BULLET_FILLED);
$section->addListItem('Second point of importance.', 0, null, ListItem::TYPE_BULLET_FILLED);
$section->addListItem('Third point of importance.', 0, null, ListItem::TYPE_BULLET_FILLED);
$section->addTextBreak(2);

// Add Checkboxes
$section->addText('Options:', ['bold' => true, 'size' => 12]);
$section->addText('☐ Option 1');
$section->addText('☑ Option 2 (Selected)');
$section->addText('☐ Option 3');
$section->addTextBreak(2);

// Add footer with page numbers
$footer = $section->addFooter();
$footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', null, [
    'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
]);

// Save the document
$filename = "data_with_header_footer_checkboxes.docx";
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($phpWord, 'Word2007');
$writer->save('php://output');
exit;
