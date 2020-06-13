<?php  
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;
    class test extends CI_Model{
        function test1(){
            // Template processor instance creation

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resource/Sample_07_TemplateCloneRow.docx');

// Variables on different parts of document
$templateProcessor->setValue('weekday', date('l'));            // On section/content
$templateProcessor->setValue('time', date('H:i'));             // On footer
$templateProcessor->setValue('serverName', realpath(__DIR__)); // On header

// Simple table
$templateProcessor->cloneRow('rowValue', 10);

$templateProcessor->setValue('rowValue#1', 'Sun');
$templateProcessor->setValue('rowValue#2', 'Mercury');
$templateProcessor->setValue('rowValue#3', 'Venus');
$templateProcessor->setValue('rowValue#4', 'Earth');
$templateProcessor->setValue('rowValue#5', 'Mars');
$templateProcessor->setValue('rowValue#6', 'Jupiter');
$templateProcessor->setValue('rowValue#7', 'Saturn');
$templateProcessor->setValue('rowValue#8', 'Uranus');
$templateProcessor->setValue('rowValue#9', 'Neptun');
$templateProcessor->setValue('rowValue#10', 'Pluto');

$templateProcessor->setValue('rowNumber#1', '1');
$templateProcessor->setValue('rowNumber#2', '2');
$templateProcessor->setValue('rowNumber#3', '3');
$templateProcessor->setValue('rowNumber#4', '4');
$templateProcessor->setValue('rowNumber#5', '5');
$templateProcessor->setValue('rowNumber#6', '6');
$templateProcessor->setValue('rowNumber#7', '7');
$templateProcessor->setValue('rowNumber#8', '8');
$templateProcessor->setValue('rowNumber#9', '9');
$templateProcessor->setValue('rowNumber#10', '10');

// Table with a spanned cell
$values = array(
    array(
        'userId'        => 1,
        'userFirstName' => 'James',
        'userName'      => 'Taylor',
        'userPhone'     => '+1 428 889 773',
    ),
    array(
        'userId'        => 2,
        'userFirstName' => 'Robert',
        'userName'      => 'Bell',
        'userPhone'     => '+1 428 889 774',
    ),
    array(
        'userId'        => 3,
        'userFirstName' => 'Michael',
        'userName'      => 'Ray',
        'userPhone'     => '+1 428 889 775',
    ),
);

$templateProcessor->cloneRowAndSetValues('userId', $values);

//this is equivalent to cloning and settings values with cloneRowAndSetValues
// $templateProcessor->cloneRow('userId', 3);

// $templateProcessor->setValue('userId#1', '1');
// $templateProcessor->setValue('userFirstName#1', 'James');
// $templateProcessor->setValue('userName#1', 'Taylor');
// $templateProcessor->setValue('userPhone#1', '+1 428 889 773');

// $templateProcessor->setValue('userId#2', '2');
// $templateProcessor->setValue('userFirstName#2', 'Robert');
// $templateProcessor->setValue('userName#2', 'Bell');
// $templateProcessor->setValue('userPhone#2', '+1 428 889 774');

// $templateProcessor->setValue('userId#3', '3');
// $templateProcessor->setValue('userFirstName#3', 'Michael');
// $templateProcessor->setValue('userName#3', 'Ray');
// $templateProcessor->setValue('userPhone#3', '+1 428 889 775');


$templateProcessor->saveAs('results/Sample_07_TemplateCloneRow.docx');

        }
        function test2() {

// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

/* Note: any element you append to a document must reside inside of a Section. */

// Adding an empty Section to the document...
$section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...
$section->addText(
    '"Learn from yesterday, live for today, hope for tomorrow. '
        . 'The important thing is not to stop questioning." '
        . '(Albert Einstein)'
);

/*
 * Note: it's possible to customize font style of the Text element you add in three ways:
 * - inline;
 * - using named font style (new font style object will be implicitly created);
 * - using explicitly created font style object.
 */

// Adding Text element with font customized inline...
$section->addText(
    '"Great achievement is usually born of great sacrifice, '
        . 'and is never the result of selfishness." '
        . '(Napoleon Hill)',
    array('name' => 'Tahoma', 'size' => 10)
);

// Adding Text element with font customized using named font style...
$fontStyleName = 'oneUserDefinedStyle';
$phpWord->addFontStyle(
    $fontStyleName,
    array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
);
$section->addText(
    '"The greatest accomplishment is not in never falling, '
        . 'but in rising again after you fall." '
        . '(Vince Lombardi)',
    $fontStyleName
);

// Adding Text element with font customized using explicitly created font style object...
$fontStyle = new \PhpOffice\PhpWord\Style\Font();
$fontStyle->setBold(true);
$fontStyle->setName('Tahoma');
$fontStyle->setSize(13);
$myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
$myTextElement->setFontStyle($fontStyle);

// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('resource/helloWorld.docx');
        }
}