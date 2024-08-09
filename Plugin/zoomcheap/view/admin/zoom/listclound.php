<?php $id = isset($_GET['id']) ? intval($_GET['id']) : 0;?>
<?php if (!empty($cloudRecords) && isset($cloudRecords['meetings'])): ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card row">
        <h5 class="card-header">Danh sách tài khoản zoom</h5>
  
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Ngày</th>
                        <th scope="col">Thời gian diễn ra</th>
                        <th scope="col">bản ghi</th>
                        <!-- <th scope="col">dowload</th> -->
                    </tr>   
                </thead>
                <tbody>
                <?php if (!empty($cloudRecords['meetings'])): ?>
                    <?php foreach ($cloudRecords['meetings'] as $record): ?>
                        <tr>
                            <th scope="row"><?php echo $record['id']; ?></th>
                            <td class="text-center"><?php echo $record['topic']; ?></td>
                            <td class="text-center"><?php
                                $startTime = $record['start_time'];
                                $date = new DateTime($startTime);
                                $formattedTime = $date->format('H:i d/m/y');
                                echo $formattedTime; ?></td>
                            <td class="text-center"><?php if (isset($record['recording_files']) && is_array($record['recording_files'])): ?>     
                                    <?php 
                                        foreach ($record['recording_files'] as $file): ?>
                                        <?php if (isset($file['recording_start'])): ?>
                                                <?php
                                                    $recordend = $file['recording_end'];
                                                    $date = new DateTime($recordend);
                                                    $formattedTimeend = $date->format('H:i d/m/y');
                                                    $recordstart = $file['recording_start'];
                                                    $date = new DateTime($recordstart);
                                                    $formattedTimestart = $date->format('H:i d/m/y');
                                                    echo $formattedTimestart .'-'.$formattedTimeend.'<br>';  
                                                ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if (isset($record['recording_files']) && is_array($record['recording_files'])): ?>
                                    
                                    <?php 
                                        $record_cout =1;
                                        foreach ($record['recording_files'] as $file): ?>
                                        <?php if (isset($file['download_url'])): ?>
                                            <a href="<?php echo $file['download_url']; ?>" target="_blank">Bản ghi số <?=$record_cout;?></a><br>
                                            <?php $record_cout++;?>
                                        <?php else: ?>
                                            Không có URL tải xuống
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    Không có tệp ghi
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td class="text-center" colspan="6">Không có bản ghi nào để hiển thị.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
        <p>Không có bản ghi nào để hiển thị.</p>
    <?php endif; ?>
</div>