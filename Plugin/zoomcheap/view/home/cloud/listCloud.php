<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Bản ghi</h4>
    <div class="card row">
        <h5 class="card-header">Danh sách bản ghi cloud zoom</h5>
        <div class="table-responsive">
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Thời gian diễn ra</th>
                        <th scope="col">Thời gian kết thúc</th>
                        <th scope="col" style="width: 70%;">link video</th>
                        <th scope="col">Bản ghi</th>
                        <!-- <th scope="col">Download</th> -->
                    </tr>   
                </thead>
                <tbody>
                <?php if (!empty($cloudRecords['recording_files'])): ?>
                    <?php foreach ($cloudRecords['recording_files'] as $record) : ?>
                        <?php if ($record['file_type'] === 'MP4') : // Chỉ hiển thị các file video ?>
                            <tr>
                                <td><?=$cloudRecords['id']?></td>
                                <td><?=$cloudRecords['topic']?></td>
                                <td><?=date('d/m/Y H:i:s', strtotime($record['recording_start']))?></td>
                                <td><?=date('d/m/Y H:i:s', strtotime($record['recording_end']))?></td>
                                <td><p style="max-width:280px"><?=$record['download_url']?></p></td>
                                <td>
                                    <video width="320" height="240" controls>
                                        <source src="<?=$record['download_url']?>" type="video/mp4">
                                        Trình duyệt của bạn không hỗ trợ thẻ video.
                                    </video>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Không có bản ghi nào</td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include(__DIR__.'/../footer.php'); ?>
