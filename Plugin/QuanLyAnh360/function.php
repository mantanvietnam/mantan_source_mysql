<?php 

$menus= array();
$menus[0]['title']= 'Quản lý ảnh 360';

$menus[0]['sub'][0]= array('title'=>'Thông tin bối cảnh',
                            'url'=>'/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listSceneAdmins',
                        );

// /$menus[1]['sub'][6]= ;
addMenuAdminMantan($menus);


function addChildXMLElements(SimpleXMLElement $parent, $xmlString) {
    $xmlChild = new SimpleXMLElement($xmlString);
    foreach ($xmlChild->children() as $child) {
        $parent->addChild($child->getName(), htmlspecialchars((string)$child));
    }
}

?>
