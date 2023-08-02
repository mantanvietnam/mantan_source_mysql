<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Sơ đồ giường</h4>
    <div class="card">
        <?php if(!empty($listData)){ 
                foreach($listData as $key =>$item){ ?>
                    <div class="row diagram">
                        <div style="background-color: #000; color: #fff;" class="col-xs-6 col-md-1 col-sm-2 floors context-menu-three" idRoom="<?php echo $item->id ?>"><?php echo $item->name ?></div>
                            <div class="col-md-11 col-sm-10">
                                <div class="row">
                                    <?php if(!empty($item->bed)){ 
                                            foreach($item->bed as $k =>$bed){ ?>
                                            <div class="col-xs-6 col-sm-4 col-md-2 clear-room context-menu-two" idBed="<?php echo $bed->id ?>" nameroom="<?php echo $bed->name ?>" clearroom="1" >
                                            <div class="customer-name"><span class="room-number"><?php echo $bed->name ?></span></div>
                                            </div>                
                                  <?php }} ?>      
                                </div>
                            </div>
                    </div>
        <?php }} ?>
    </div>
                     

<style type="text/css">
    .card{
        padding: 30px;
    }
    .diagram {
        vertical-align: middle;
        margin-bottom: 10px;
        height: 100px;
    }
    .diagram .floors {
        font-weight: bold;
        background: #1d2127;
        color: white;
        margin: 1px 0;
        font-size: 18px;
        padding: 0 6px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .diagram .clear-room {
        background: seagreen;
        color: white;
        height: 100px;
        margin: 1px;
    }
    .customer-name {
        text-align: center;
        margin-top: 3em;
    }
</style>            
                               
    


</div>
<?php include(__DIR__.'/../footer.php'); ?>