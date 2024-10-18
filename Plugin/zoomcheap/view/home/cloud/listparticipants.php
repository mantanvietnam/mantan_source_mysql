<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Người tham gia</h4>
    <div class="card row">
    
    <?php
        if ( !empty($room['info'])) {
            $info = json_decode($room['info']);
        } else {
            echo "";
        }
        ?>
        <h5 class="card-header"><i class='bx bx-food-menu'></i>:
            <span class="text-primary">
                <?php 
                    if(!empty($info->topic)){
                        echo $info->topic;
                    }else{
                        echo '';
                    }
            ?>
            </span>
            <p class="mt-2 text-primary">Tổng số:
                <?php if(!empty($listregistrant['total_records'])){
                        echo $listregistrant['total_records'];
                }else{
                    echo '';
                }
                ?>
            </p>                             
        </h5>
        <div class="table-responsive">
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th scope="col">tên</th>
                        <th scope="col">Thời gian tham gia</th>
                        <th scope="col">Thời gian rời đi</th>
                    </tr>   
                </thead>
                <tbody>

                <?php if (!empty($listregistrant['participants'])): ?>
                    <?php foreach ($listregistrant['participants'] as $detaillistregistrant) : ?>
                            <tr>
                                <td><?=$detaillistregistrant['name']?></td>
                                <td><?=date('d/m/Y H:i:s', strtotime($detaillistregistrant['join_time']))?></td>
                                <td><?=date('d/m/Y H:i:s', strtotime($detaillistregistrant['leave_time']))?></td>
                            </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có người tham gia</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include(__DIR__.'/../footer.php'); ?>
