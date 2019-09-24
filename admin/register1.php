<?php
  include_once('../lib/config.php');
  if($_POST){
      
            // 1. 后台验证
      if(!isset($_POST['admin_email']) || empty($_POST['admin_email'])){
          showMsg('请填写邮箱...');die;
          
      }
      if(!isset($_POST['admin_password']) || empty($_POST)){
        showMsg('请输入密码');die ;
      }
// 2. 查看邮箱是否已经被注册
      $admin_email = $_POST['admin_email'];
      $admin_password = $_POST['admin_password'];
      $sql="select admin_email from {$pre}admin where admin_email='{$admin_email}'";
      $result= getOne($sql);
    //   echo $sql;die;
    
      if($result){
        showMsg('邮箱已经注册过，请登录...','login.php');die;
      }
// 3. 注册账号
      $data=array(
           'admin_email' =>$admin_email,
           'admin_password' =>$admin_password,
           'addtime' =>time(),
        );
        // var_dump($data);die;
      $r =add('admin',$data);
      
      if($r){
        showMsg('注册成功，请登录....','login.php');die;
      }else{
        showMsg('注册失败...');die ;
      }
  }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carbon - Admin Template</title>
    <link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<div class="page-wrapper flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="card-header text-center text-uppercase h4 font-weight-light">
                        Register
                    </div>
                    <form action="" method="post" class="form">
                    <div class="card-body py-5">
                       
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input type="email" class="form-control" name="admin_email">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Password</label>
                            <input type="password" class="form-control" name="admin_password">
                        </div>

                       
                    </div>

                    <div class="card-footer">
                        <div class="row">
                             <div class="col-6">
                                <button onclick="check()" type="submit" class="btn btn-success btn-block">Create Account</button>
                             </div>
                             <div class="col-6">
                             <a href="login.php" class="btn btn-link">login</a>
                             </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/popper.js/popper.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="./vendor/chart.js/chart.min.js"></script>
<script src="./js/carbon.js"></script>
<script src="./js/demo.js"></script>
<script type="text/javascript">
    // 1. js验证
    function check(){
        var admin_email = $('[name="admin_email"]')
        var admin_password = $('[name="admin_password"]')

        if(admin_email == '') {
            alert('邮箱不能为空...');
            return false;
        }

        if(admin_password == '') {
            alert('密码不能为空...');
            return false;
        }

        return true;
    }
</script>

</body>
</html>
