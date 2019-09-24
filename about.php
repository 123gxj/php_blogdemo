<?php include_once('header.php') ?>
<div class="box">
  <div class="newsview">
    <h2>关于我</h2>
    <div class="news_infos" id='about'>
      <p id="aboutme_p">无数据 </p>
        <br>
     
        <h2>About my blog</h2>
      &nbsp;
     
    </div>
  </div>
</div>
<?php include_once('footer.php') ?>

<script type="text/javascript" src="static/js/header.js"></script>

<script type="text/javascript" src="static/js/footer.js"></script>
<script>
$.ajax({
    type:'get',
    url:'api/index.php',
    data:{
        action:'about_page',
        single_name:'关于我',
    },
    dataType:'json',
    success:function(data){
       
        strme=data['aboutme'][0]['content'];
        strweb=`
       <p>域 名：${data['aboutweb'][0]['domain_name']}</p>
      <br>
      <p>服务器：阿里云服务器&nbsp;&nbsp;<a href="${data['aboutweb'][0]['website']}"><span style="color:#FF0000;"><strong>前往阿里云官网购买&gt;&gt;</strong></span></a></p>
      <br>
      <p>备案号：${data['aboutweb'][0]['record']}</p>
      <br>
      <p>程 序：PHP 帝国CMS7.5</p>
        `;
       
      $('#aboutme_p').empty().html(strme);
      $('#about').append(strweb);

    }
})
</script>