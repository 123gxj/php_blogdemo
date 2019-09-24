<?php 
    include_once('../lib/config.php');
    // 检查是否登录
    include_once('../lib/admin_check.php');
  $id=isset($_GET['link_id']) && !empty($_GET['link_id']) ? intval($_GET['link_id']) : '';
  
  if($id){
    $sql="select * from {$pre}friend_link where link_id={$id}";
    $friend_link = getOne($sql);
    $friend_link=isset($friend_link) && !empty($friend_link) ? $friend_link : '';
  }
// var_dump($friend_link);
  if($_POST){
     $link_name = isset($_POST['link_name']) && !empty($_POST['link_name']) ? trim($_POST['link_name']) : '';
     $link_url = isset($_POST['link_url']) && !empty($_POST['link_url']) ? trim($_POST['link_url']) : '';
    $data = array(
    'link_name' => $link_name,
    'link_url' => $link_url,
    );
      if($id){
    $r= update('friend_link',$data,"where link_id={$id}");

    if($r){showMsg('编辑成功...' );die;}
        
    else{showMsg('编辑失败...');die; }
        
   }else{

        $r= add('friend_link',$data);
        if($r){showMsg('添加成功...', 'singlep_list.php');die;}
             
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
                        <?php echo $id ? '编辑' : '添加' ?>链接
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
                                        <label for="link_name" class="form-control-label">链接名称</label>
                                        <input id="link_name" class="form-control" placeholder="名称" name="link_name" 
                                        value="<?php echo $link_name=isset($friend_link['link_name']) && !empty($friend_link['link_name']) ? $friend_link['link_name'] : ''; ?>
                                        " >
                                       <small class="form-text">名称不能为空</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="link_url" class="form-control-label">链接地址</label>
                                        <input id="link_url" class="form-control" placeholder="地址" name="link_url" 
                                        value="<?php echo $link_url=isset($friend_link['link_url']) && !empty($friend_link['link_url']) ? $friend_link['link_url'] : ''; ?>" >
                                        
                                       <small class="form-text">地址不能为空</small>
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
<!-- 编辑器插件 -->

<script type="text/javascript">
 
    // function check(){

    //     var cate_link_name = $('[link_name="cate_link_name"]').val()
        

       
    //     if(cate_link_name == '') {
    //         alert('内容不能为空...');
    //         return false;
    //     }

    //     return true;
    // }
</script>
