<?php 
    include_once('../lib/config.php');
    // 检查是否登录
    include_once('../lib/admin_check.php');
  $id=isset($_GET['single_id']) && !empty($_GET['single_id']) ? intval($_GET['single_id']) : '';
  
  if($id){
    $sql="select * from {$pre}single_page where single_id={$id}";
    $single_page = getOne($sql);
    $single_page=isset($single_page) && !empty($single_page) ? $single_page : '';
  }
// var_dump($single_page);
  if($_POST){
     $name = isset($_POST['name']) && !empty($_POST['name']) ? trim($_POST['name']) : '';
     $content = isset($_POST['content']) && !empty($_POST['content']) ? trim($_POST['content']) : '';
    $data = array(
    'name' => $name,
    'content' => $content,
    );
      if($id){
    $r= update('single_page',$data,"where single_id={$id}");

    if($r){showMsg('编辑成功...' );die;}
        
    else{showMsg('编辑失败...');die; }
        
   }else{

        $r= add('single_page',$data);
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
                        <?php echo $id ? '编辑' : '添加' ?>单页面
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
                                        <label for="name" class="form-control-label">单页面名称</label>
                                        <input id="name" class="form-control" placeholder="名称" name="name" 
                                        value="<?php echo $name=isset($single_page['name']) && !empty($single_page['name']) ? $single_page['name'] : ''; ?>" >
                                        
                                       <small class="form-text">名称不能为空</small>
                                    </div>
                                </div>
                               
                            </div>



                            <div class="row mt-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">内容</label>
                                        <script id="content" name="content" type="text/plain" style="height: 400px;">
                                        <?php echo $content=isset($single_page['content']) && !empty($single_page['content']) ? $single_page['content'] : ''; ?>
                                    </script>
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
<script type="text/javascript" src="js/utf8-php/ueditor.config.js"></script>
<script type="text/javascript" src="js/utf8-php/ueditor.all.min.js"></script>
<script type="text/javascript" src="js/utf8-php/lang/zh-cn/zh-cn.js"></script> 

<script type="text/javascript">
    var ue = UE.getEditor('content', {
        toolbars: [ // 配置工具栏
            ['fullscreen', 'source', 'undo', 'redo'],
            ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
        ]
    });
    function check(){

        var cate_name = $('[name="cate_name"]').val()
        

       
        if(cate_name == '') {
            alert('内容不能为空...');
            return false;
        }

        return true;
    }
</script>
