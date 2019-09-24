<?php include_once('header.php') ?>
<div class="box">
 <div class="blank"></div>
 <div class="infosbox">
    <div class="newsview" id="blog_article">
     
<p class="diggit"><a href="JavaScript:makeRequest('/e/public/digg/?classid=3&amp;id=19&amp;dotop=1&amp;doajax=1&amp;ajaxarea=diggnum','EchoReturnedText','GET','');"> 很赞哦！ </a>(<b id="diggnum"><script type="text/javascript" src="/e/public/ViewClick/?classid=2&amp;id=20&amp;down=5"></script>13</b>)</p>
</div>
    
    <div class="nextinfo">
      <p>上一篇：<a href="/news/life/2018-03-13/804.html">作为一个设计师,如果遭到质疑你是否能恪守自己的原则?</a></p>
      <p>下一篇：<a href="/news/life/">返回列表</a></p>
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul id="related_article"></ul>
          
    </div>
    <div class="news_pl">
      <h2>文章评论</h2>
      <ul>
        <div class="gbko"> </div>
      </ul>
    </div>
  </div> 
  <aside>
  <div class="ztbox">
      <ul id="cate">
         
      </ul>
    </div>
    <div class="paihang">
      <h2>点击排行</h2>
      <ul id="index_clicks_ul">
     
      </ul>
    </div>
    <div class="paihang">
      <h2>站长推荐</h2>
      <ul id="index_master_ul">
       
      </ul>
    </div>
    <div class="paihang">
      <h2>友情链接</h2>
      <ul id="index_frilink_ul">
       
      </ul>
    </div>
  </aside>
</div>
 <div class="blank"></div>
 <?php include_once('footer.php') ?>

<script type="text/javascript" src="static/js/header.js"></script>
<script type="text/javascript" src="static/js/index.js"></script>
<script type="text/javascript" src="static/js/footer.js"></script>
<script type="text/javascript">

  // 获取参数函数
  function getParam(key='') {
    var src = location.href; // 当前地址
    var index = src.indexOf('?') // 获取参数起始位置？的下标
    src = src.substr(index + 1); // 获取参数字符串 aid=5&action=test&limit=11&orderby=desc
   
    var arr = src.split('&'); // 将字符串切割成数组
  
    if(key != '') {
      for(var i = 0; i < arr.length; i++) {
        var temp = arr[i].split('=') // 将数组里面的类似 aaa=1 这样的字符串切割成数组
        if(temp[0] == key) {
          return temp[1];
        }
      }
    }else{
      return arr;
    }
  }
  
 var aid = getParam('aid');
 var cate_id = getParam('cate_id');
 //博客内容
  $.ajax({
    type: 'get',
    url: './api/index.php',
    dataType: 'json',
    data: {
      action: 'blog_detail',
      aid: aid,
      cate_id:cate_id
    },
    success: function(data) {
      console.log(data);
  
      var str = `
        <h3 class="news_title">${data.title}</h3>
              <div class="bloginfo">
                <ul>
                  <li class="author"><a href="/">${data.author}</a></li>
                  <li class="lmname"><a href="/">${data.cate_name}</a></li>
                  <li class="timer">${data.addtime}</li>
                  <li class="view">${data.reading}已阅读</li>
                  <li class="like">${data.likes}</li>
                </ul>
              </div>
              <div class="tags"><a href="/" target="_blank">个人博客</a> &nbsp; <a href="/" target="_blank">小世界</a></div>
              <div class="news_about"><strong>简介</strong>${data.description}</div>
              <div class="news_con">${data.content}</div>
      `
  
      $('.newsview').prepend(str);
  
  
    }
  })
//相关文章
   $.ajax({
    type: 'get',
    url: './api/index.php',
    dataType: 'json',
    data: {
      action: 'pageContents',
      link_type:2,
    },
    success: function(data) {
      
      str='';
      data.forEach(function(value,index){
        str += `<li><a href="${value['moreL_url']}" title="${value['moreL_name']}">${value['moreL_name']}</a></li> `
       });
     
      $('#related_article').empty().html(str);
     
  
    }
  })
  </script>
