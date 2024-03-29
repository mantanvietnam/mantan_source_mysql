<?php 
$menus= array();
$menus[0]['title']= "Hệ thống đại lý";

$menus[0]['sub'][0]= array(	'title'=>'Đại lý',
							'url'=>'/plugins/admin/key_person-view-admin-person-listPersonAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listMemberAdmin'
						);

$menus[0]['sub'][]= array( 'title'=>'Khu vực',
                            'url'=>'/plugins/admin/key_person-view-admin-person-categoryPersonAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'categoryPersonAdmin'
                        );



addMenuAdminMantan($menus);

function get_all_person()
{
    global $modelCategories;
    global $controller;

    $modelPersons = $controller->loadModel('Persons');

    $listData = $modelPersons->find()->where()->all()->toList();
    
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $category = $modelCategories->find()->where(['id'=>$value->id_category])->first();

            $listData[$key]->name_location = @$category->name;
        }
    }

    return $listData;
}
?>