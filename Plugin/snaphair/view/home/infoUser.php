<?php $user = getInfoUser(); ?>
<div class="header-right">
                    <button class="btn btn-create">
                        Tạo ảnh ngay
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <div class="point-info">
                        Điểm tích lũy: <span><?php echo $user->coin ?> ePoint</span>
                    </div>
                    <div class="user-info">
                        <img src="<?php echo $user->avatar ?>" alt="User avatar" class="user-avatar">
                        <span class="user-email"><?php echo $user->full_name; ?></span>
                        <span class="user-email"><?php echo $user->phone ?></span>
                        <span class="user-action">Cố bắt</span>
                    </div>
                </div>