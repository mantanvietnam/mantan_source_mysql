   <style>
.tableList{
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
    border-spacing: 0;
    border-top: 1px solid #bcbcbc;
    border-left: 1px solid #bcbcbc;
}
.tableList td{
    padding: 5px;
    border-bottom: 1px solid #bcbcbc;
    border-right: 1px solid #bcbcbc;
}
</style>
<?php
    $breadcrumb= array( 'name'=>'Theme Settings',
                        'url'=>$urlPlugins.'theme/minhtrang-admin-cauchuyencuatoi.php',
                        'sub'=>array('name'=>'Settings')
                      );
    addBreadcrumbAdmin($breadcrumb);
?>  
<script type="text/javascript">
    
    function save()
    {
        document.listForm.submit();
    }
</script>
<div class="thanhcongcu">

    <div class="congcu" onclick="save();">
        <input type="hidden" id="idChange" value="" />
        <span id="save">
            <input type="image" src="<?php echo $webRoot;?>images/save.png" />
        </span>
        <br/>
        Lưu
    </div>
</div>

<div class="clear" style="height: 10px;margin-left: 15px;margin-bottom: 15px;" id='status'>
    <?php
        echo $mess;
    ?>
</div>
    
<div class="taovien">
    <form action="" method="post" name="listForm">
        <table class="tableList">
            <tr>
                <td colspan="4" align="center" style="color: red; font-weight: bold;">Câu chuyện của tôi</td>
            </tr>
             <tr>
           <td colspan="2">
                    <?php
                        showEditorInput('content','content',@$data['Option']['value'],1);
                    ?>
                </td>
              </tr>   
        </table>
    </form>
</div>