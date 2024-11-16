<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php mantan_header();?>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/plugins/ngayhoixanh/view/home/asset/css/style.css?time=1232">
</head>
<body>

    <div class="container my-5 alate">
        <h1 class="text-center text-uppercase main-title"><?php echo $nameCity;?></h1>
        <?php
        if(!empty($listData)){
            foreach ($listData as $location) { ?>
                <div class="project-section-1">
                    <h2 class="project-subtitle"><?php echo $location->name;?></h2>
                    <div class="row">
                        <div class="col-md-3">
                        <img src="<?php echo $location->image;?>" class="img-project-section-1" alt="">
                        </div>
                        <div class="col-md-9">
                            <div class="img-lasttext">
                                <?php echo $location->description;?>
                            </div>
                        </div>
                    </div>

                    <?php 
                    if(!empty($location->listTree)){
                        foreach ($location->listTree as $keyTree=>$tree) {
                            if($keyTree > 0){
                                echo '<div class="horizontal"></div>';
                            }

                            echo '<div class="info-section">
                                    <div class="row info">
                                        <div class="col-md-3 ">';
                                            if($keyTree == 0) echo '<p class="info-name">Tên chương trình</p>';
                            
                            echo           '<p class="info-name_sologant my-2">'.$tree->name_program.'</p>
                                            <p class="info-number">Số lượng cây trồng</p>
                                            <h2>'.$tree->number_tree.'</h2>
                                        </div>
                                        <div class="col-md-9 detail">';
                                            if($keyTree == 0) echo '<p class="info-tree">Lý do chọn giống cây trồng</p>';
                            
                            if(!empty($tree->choose_1) && !empty($tree->choose_2)){
                                echo           '<div class="row detai">
                                                    <div class="detai-tree">
                                                        <p class="info-tree_sologant col-md-6">'.$tree->name_tree.'</p>
                                                        <div class="img-lasttext">'.$tree->choose_1.'</div> 
                                                    </div>
                                                    <div class="imgtext-bdrd col-md-6">
                                                        <div class="img-bdrd">';
                                                        if(!empty($tree->listImageTree)){
                                                            foreach ($tree->listImageTree as $imageTree) {
                                                                echo '<img src="'.$imageTree->link.'" alt="">';
                                                            }
                                                        }
                                echo                   '</div>
                                                        <div class="text-bdrd">
                                                            <div class="img-lasttext">'.$tree->choose_2.'</div> 
                                                        </div>
                                                    </div>
                                                </div>';
                            }else{
                                echo           '<div class="row detai">
                                                    <div class="detai-tree">
                                                        <p class="info-tree_sologant col-md-6">'.$tree->name_tree.'</p>
                                                    </div>
                                                    <div class="imgtext-bdrd col-md-6">
                                                        <div class="img-bdrd">';
                                                        if(!empty($tree->listImageTree)){
                                                            foreach ($tree->listImageTree as $imageTree) {
                                                                echo '<img src="'.$imageTree->link.'" alt="">';
                                                            }
                                                        }
                                echo                   '</div>
                                                        
                                                    </div>

                                                    <div class="">
                                                        <div class="img-lasttext">'.$tree->choose_1.'</div> 
                                                    </div>
                                                </div>';
                            }


                            echo        '</div>
                                    </div>
                                </div>';
                        }
                    }
                    ?>
                </div>
            <?php }
        }
        ?>
    </div>

    <!-- Repeat for each project section as in the provided image -->
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JavaScript -->
  
</body>
</html>