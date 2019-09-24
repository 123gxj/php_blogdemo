<?php 
    include_once('../lib/config.php');
    // 检查是否登录
    include_once('../lib/admin_check.php');
   
    // 查询分类
    $sql = "select * from {$pre}cate";
    $cate = getAll($sql);
    $id = isset($_GET['id']) && !empty($_GET['id']) ? intval($_GET['id']) : '';
    $article = array(
      'cate_id'=>0,
      'recommend' =>'不推荐',
    );

    // 网站设置
    $is_recommend = array(
        '0' => '不推荐',
        '1' => '站长推荐',
        '2' => '首页推荐'
    );
    
    
    if($id) {
        // 编辑展示页面

        $sql = "select * from {$pre}article where art_id={$id}";
        $article = getOne($sql);
        
    }

    if($_POST) {

        $title = isset($_POST['title']) && !empty($_POST['title']) ? trim($_POST['title']) : '';
        $cate_id = isset($_POST['cate_id']) && !empty($_POST['cate_id']) ? intval($_POST['cate_id']) : 1;

        $recommend = isset($_POST['recommend']) && !empty($_POST['recommend']) ? trim($_POST['recommend']) : 0;

        $author = isset($_POST['author']) && !empty($_POST['author']) ? trim($_POST['author']) : 'admin';

        $content = isset($_POST['content']) && !empty($_POST['content']) ? trim($_POST['content']) : '';

        $description = isset($_POST['description']) && !empty($_POST['description']) ? intval($_POST['description']) : cutstr($content, 0, 10, '...');

        $reading = isset($_POST['reading']) && !empty($_POST['reading']) ? trim($_POST['reading']) : 0;
        $likes = isset($_POST['likes']) && !empty($_POST['likes']) ? trim($_POST['likes']) : 0;
        $addtime = isset($_POST['addtime']) && !empty($_POST['addtime']) ? intval($_POST['addtime']) : time();

        $data = array(
            'title' => $title,
            'cate_id' => $cate_id,
            'recommend' => $recommend,
            'author' => $author,
            'description' => $description,
            'content' => $content,
            'reading' => $reading,
            'likes' => $likes,
            'addtime' => $addtime
        );

        if($id) {
            $r = update('article', $data, "where art_id={$id}");

            if($r) {
                showMsg('编辑成功...' );die;
            }else{
                showMsg('编辑失败...');die;
            } 
        }else{
            $r = add('article', $data);
            
            if($r) {
                showMsg('添加成功...', 'article-list.php');die;
            }else{
                showMsg('添加失败...');die;
            }
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
                        <?php echo $id ? '编辑' : '添加' ?>文章
                        <button class="btn btn-primary pull-right rounded" onclick="history.go(-1)" >
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
                                        <label for="title" class="form-control-label">标题</label>
                                        <input id="title" class="form-control" placeholder="标题" name="title" value="<?php echo isset($article['title']) ? $article['title'] : '' ?>">
                                        <small class="form-text">标题不能为空</small>
                                    </div>
                                </div>
                            </div>
                            <?php if($cate){ ?>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cate_id">文章分类</label>
                                        <select id="cate_id" name="cate_id" class="form-control">
                                            <?php foreach ($cate as $key => $value): ?>
                                            <option <?php echo $value['cate_id'] == $article['cate_id'] ? 'selected' : '' ?> value="<?php echo $value['cate_id'] ?>"><?php echo $value['cate_name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div> 
                                </div>
                            </div>
                            <?php } ?>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="recommend">是否推荐</label>
                                        <select id="recommend" name="recommend" class="form-control">
                                            <?php foreach ($is_recommend as $key => $value): ?>
                                                <option value="<?php echo $key ?>" <?php echo $key == $article['recommend'] ? "selected" : '' ?> ><?php echo $value; ?></option> 
                                            <?php endforeach ?>
                                        </select>
                                    </div> 
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="author" class="form-control-label">作者</label>
                                        <input id="author" class="form-control" placeholder="" name="author" value="<?php echo isset($article['author']) ? $article['author'] : '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">描述</label>
                                        <textarea id="description" class="form-control" rows="6" name="description"><?php echo isset($article['description']) ? $article['description'] : '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">内容</label>
                                        <script id="content" name="content" type="text/plain" style="height: 400px;"><?php echo isset($article['content']) ?  $article['content'] : '' ?></script>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reading" class="form-control-label">阅读量</label>
                                        <input id="reading" class="form-control" placeholder="" name="reading" value="<?php echo isset($article['reading']) ? $article['reading'] : '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="likes" class="form-control-label">点赞数</label>
                                        <input id="likes" class="form-control" placeholder="" name="likes" value="<?php echo isset($article['likes']) ? $article['likes'] : '' ?>">
                                    </div>
                                </div>
                            </div> 
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="addtime">发布时间</label>
                                        <input type="text" class="form-control" value="<?php echo isset($article['addtime']) ? date('Y-m-d', $article['addtime']) : ''  ?>" id="addtime" >
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

<!-- 时间插件 -->
<script type="text/javascript" src="js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>


<!-- 编辑器插件 -->
<script type="text/javascript" src="js/utf8-php/ueditor.config.js"></script>
<script type="text/javascript" src="js/utf8-php/ueditor.all.min.js"></script>
<script type="text/javascript" src="js/utf8-php/lang/zh-cn/zh-cn.js"></script> 

<script type="text/javascript">
    $('#addtime').datetimepicker({
        // 格式化日期
        format: 'yyyy-mm-dd',
        language:  'zh-CN',
    });

    var ue = UE.getEditor('content', {
        toolbars: [ // 配置工具栏
            ['fullscreen', 'source', 'undo', 'redo'],
            ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
        ]
    });

    function check(){

        var title = $('[name="title"]').val()
        var content = $('[name="content"]').val()

        if(title == '') {
            alert('标题不能为空...');
            return false;
        } 
        
        if(content == '') {
            alert('内容不能为空...');
            return false;
        }

        return true;
    }
</script>
