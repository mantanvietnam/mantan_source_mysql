<?php 
include(__DIR__.'/../../lib/qr-code-master/vendor/autoload.php');

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;

$content = (!empty($data->code))?'https://smartqr.vn/r/'.$data->code:'https://smartqr.vn';
$logoURL = @$data->logo;
$label = (!empty($_GET['label']))?$_GET['label']:'';
$size = (!empty($_GET['size']))?$_GET['size']:1000;
$colorForeground = (!empty($data->color_foreground))?explode(',', $data->color_foreground):[0,0,0];
$colorBackground = (!empty($data->color_background))?explode(',', $data->color_background):[255, 255, 255];

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($content)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size($size)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->foregroundColor(new Color($colorForeground[0], $colorForeground[1], $colorForeground[2]))
    ->backgroundColor(new Color($colorBackground[0], $colorBackground[1], $colorBackground[2]))
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