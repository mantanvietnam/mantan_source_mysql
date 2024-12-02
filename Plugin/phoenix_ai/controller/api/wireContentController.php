<?php 
function testcontentwrite($input){
    $question = "hay viet content nau an cho toi";
    $conversation_id = "";
    $dulieu= callAIphoenixtech($question,$conversation_id);
    debug($dulieu);
}


?>