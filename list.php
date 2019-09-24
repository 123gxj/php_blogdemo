<?php include_once('header.php') ?>

<div class="box">
  <div class="place" id="pageContents"></div>

  <div class="blogs" id="blogs_list"></div> 
  <aside>
    <div class="ztbox">
      <ul id="cate"> </ul>
  
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
  <div class="pagelist"><a title="Total record">&nbsp;<b>162</b> </a>&nbsp;&nbsp;&nbsp;<b>1</b>&nbsp;<a href="/jstt/index_2.html">2</a>&nbsp;<a href="/jstt/index_3.html">3</a>&nbsp;<a href="/jstt/index_4.html">4</a>&nbsp;<a href="/jstt/index_5.html">5</a>&nbsp;<a href="/jstt/index_6.html">6</a>&nbsp;<a href="/jstt/index_2.html">下一页</a>&nbsp;<a href="/jstt/index_14.html">尾页</a></div>
 
</div>
<?php include_once('footer.php') ?>

<script type="text/javascript" src="static/js/header.js"></script>
<script type="text/javascript" src="static/js/index.js"></script>
<script type="text/javascript" src="static/js/footer.js"></script>
<script>
    $.ajax({
      type: 'get',
      url: 'api/index.php',
      data:{
        action:'article_count',
      },
      dataType: 'json', // text json xml 
      success: function(result){
      var data=result['data'];
      var pageStr=result['pageStr'];
     console.log(pageStr);
        var str = '' 
        if(data){
           for(var i = 0; i < data.length; i++) {
          str += `
            <div class="bloglist">
              <h2>
                <a href="info.php?aid=${data[i].art_id}" title="${data[i].title}">${data[i].title}</a>
              </h2>
              <p>${data[i].description}</p>
            </div>
          `
        }
        }else{
          str=`
          <div class="bloglist">
          <h2>
            <a href="#" title="">暂无数据</a>
          </h2>
          <p>暂无数据</p>
        </div>
          `
        }
       $('.pagelist').empty().html(pageStr);
        $('#blogs_list').empty().html(str);
      }
    })
</script>
