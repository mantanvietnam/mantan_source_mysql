<?php
function getInfoSchoolAPI($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;
    global $controller;

    $modelTeachers = $controller->loadModel('Teachers');
    $modelStudents = $controller->loadModel('Students');
    $modelClasses = $controller->loadModel('Classes');

    $conditions = array('key_word' => 'infoSchoolAdmin');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
        $data_value['info'] = @nl2br($data_value['info']);
        $data_value['info_timeline'] = @nl2br($data_value['info_timeline']);

        // video
        if(!empty($data_value['video'])){
            $codeYoutube = '';

            $codeYoutube = explode('v=', $data_value['video']);

            if(!empty($codeYoutube[1])){
                $codeYoutube = explode('&', $codeYoutube[1]);

                $codeYoutube = $codeYoutube[0];
            }else{
                $codeYoutube = '';
            }

            $data_value['video'] = 'https://www.youtube.com/embed/'.$codeYoutube;
        }

        // album ảnh sự kiện lịch sử nhà trường
        $data_value['list_image_timeline'] = [];
        if(!empty($data_value['id_album_event'])){
            $album_event = $modelAlbuminfos->find()->where(['id_album'=>(int) $data_value['id_album_event']])->all()->toList();

            if(!empty($album_event)){
                foreach ($album_event as $event) {
                    $data_value['list_image_timeline'][] = [
                                                                'title'=>$event->title,
                                                                'image'=>$event->image,
                                                                'description'=> @nl2br($event->description),
                                                            ];
                }
            }
        }

        // album ảnh thành tích nhà trường
        $data_value['list_image_achievement'] = [];
        if(!empty($data_value['id_album_achievement'])){
            $album_achievement = $modelAlbuminfos->find()->where(['id_album'=>(int) $data_value['id_album_achievement']])->order(['id'=>'desc'])->all()->toList();

            if(!empty($album_achievement)){
                foreach ($album_achievement as $item) {
                    $data_value['list_image_achievement'][] = [
                                                                'title'=>$item->title,
                                                                'image'=>$item->image,
                                                                'description'=> @nl2br($item->description),
                                                            ];
                }
            }
        }

        shuffle($data_value['list_image_achievement']);

        // chuyên mục ảnh hoạt động nhà trường
        $data_value['list_album_activities'] = [];
        if(!empty($data_value['id_category_activities'])){
            $data_value['list_album_activities'] = $modelAlbums->find()->where(['id_category'=>(int) $data_value['id_category_activities']])->order(['id' => 'DESC'])->all()->toList();
        }
    }

    // danh sách niên khóa
    $conditions = array('type' => 'school_year');
    $listYear = $modelCategories->find()->where($conditions)->all()->toList();
    $listYearValue = [];

    if(!empty($listYear)){
        foreach ($listYear as $value) {
            $listYearValue[$value->id] = $value->name;
        }
    }

    // danh sách chức danh giáo viên
    $conditions = array('type' => 'positionTeacher');
    $listPositionTeacher = $modelCategories->find()->where($conditions)->all()->toList();
    $listPositionTeacherShow = [];
    if(!empty($listPositionTeacher)){
        foreach ($listPositionTeacher as $key => $value) {
            $listPositionTeacherShow[$value->id] = $value->name;
        }
    }
    $data_value['listPositionTeacher'] = $listPositionTeacherShow;

    $data_value['listYear'] = [];
    if(!empty($listYear)){
        foreach ($listYear as $key => $value) {
            $data_value['listYear'][] = ['id'=>$value->id, 'name'=>$value->name, 'image'=>$value->image];
        }
    }

    // danh sách giáo viên
    $data_value['listTeacher'] = $modelTeachers->find()->where()->order(['pin'=>'desc'])->all()->toList();

    if(!empty($data_value['listTeacher'])){
        foreach ($data_value['listTeacher'] as $key => $value) {
            $data_value['listTeacher'][$key]->position = @$listPositionTeacherShow[$value->position];
        }
    }

    // danh sách học sinh
    $data_value['listStudent'] = $modelStudents->find()->where()->order(['id_year'=>'asc'])->all()->toList();

    if(!empty($data_value['listStudent'])){
        foreach ($data_value['listStudent'] as $key => $value) {
            $data_value['listStudent'][$key]->year = @$listYearValue[$value->id_year];

            $class = $modelClasses->find()->where(['id'=>(int) $value->id_class])->first();

            $data_value['listStudent'][$key]->class_name = @$class->name;
        }
    }

    return $data_value;
}

function getConfigRoom3DAPI($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelCategories;
    global $modelAlbums;
    global $modelAlbuminfos;
    global $controller;

    $conditions = array('key_word' => 'configRoom3DAdmin');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    return $data_value;
}