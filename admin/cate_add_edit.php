<?php 
    include_once('../lib/config.php');
    // 检查是否登录
    include_once('../lib/admin_check.php');
  $cate_id=isset($_GET['cate_id']) && !empty($_GET['cate_id']) ? intval($_GET['cate_id']) : '';
  
  if($cate_id){
    $sql="select * from {$pre}cate where cate_id={$cate_id}";
    $cate = getOne($sql);
    $cate=isset($cate) && !empty($cate) ? $cate : '';
  }

  if($_POST){
     $cate_name = isset($_POST['cate_name']) && !empty($_POST['cate_name']) ? trim($_POST['cate_name']) : '';
    $data = array(
    'cate_name' => $cate_name,
    );
      if($cate_id){
    $r= update('cate',$data,"where cate_id={$cate_id}");

    if($r){showMsg('编辑成功...' );die;}
        
    else{showMsg('编辑失败...');die; }
        
   }else{

        $r= add('cate',$data);
        if($r){showMsg('添加成功...', 'cate_list.php');die;}
             
         else{showMsg('添加失败...');die; }
   }
  }
 

 
?>
<?php include_once('header.php') ?>
<style type="text/css">
    .navbar{
        z-index: 100000;
    }
</style>
<!-- 时间样式 --> 

<link rel="stylesheet" type="text/css" href="js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css">

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <?php echo $cate_id ? '编辑' : '添加' ?>文章分类
                        <button class="btn btn-primary float-right rounded" onclick="history.go(-1)" >
                            <i class="fa fa-chevron-left"></i>
                            <!-- <i class="fa fa-hand-o-left"></i>  -->
                            返回
                        </button>
                    </div>
                    <form method="post" action="" onsubmit="return check()">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="card-body"> 
                            <div class="row mt-12">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="form-control-label">分类名称</label>
                                        <input id="title" class="form-control" placeholder="标题" name="cate_name" 
                                        value="<?php echo $cate_name=isset($cate['cate_name']) && !empty($cate['cate_name']) ? $cate['cate_name'] : ''; ?>" >
                                       
                                        <small class="form-text">名称不能为空</small>
                                    </div>
                                </div>
                               
                            </div>
                           
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group"> 
                                        <input type="submit" class="btn btn-primary rounded" value="提交">
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>

        
    </div>
</div>
<?php include_once('footer.php') ?>

<script type="text/javascript">
 
    function check(){

        var cate_name = $('[name="cate_name"]').val()
        

       
        if(cate_name == '') {
            alert('内容不能为空...');
            return false;
        }

        return true;
    }
</script>
