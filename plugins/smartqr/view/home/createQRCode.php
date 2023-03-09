<?php 
include(__DIR__.'/../../lib/qr-code-master/vendor/autoload.php');

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

$content = (!empty($data->code))?'https://smartqr.vn/r/'.$data->code:'https://smartqr.vn';
$logoURL = @$data->logo;
$label = (!empty($_GET['label']))?$_GET['label']:'';
$size = (!empty($_GET['size']))?$_GET['size']:1000;

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($content)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size($size)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->logoPath($logoURL)
    ->labelText($label)
    ->labelFont(new NotoSans(20))
    ->labelAlignment(new LabelAlignmentCenter())
    ->validateResult(false)
    ->build();

// Generate a data URI to include image data inline (i.e. inside an <img> tag)
$dataUri = $result->getDataUri();

if(!empty($_GET['type']) && $_GET['type']=='code'){
    // Directly output the QR code
    header('Content-Type: '.$result->getMimeType());
    echo $result->getString();
}else{
    echo '<img src="'.$dataUri.'" />';
}


// Save it to a file
//$result->saveToFile(__DIR__.'/qrcode.png');



//echo $dataUri;
//echo $dataUri;
?>