//首页列表1
$.ajax({
      type: 'get',
      url: 'api/index.php?action=index_article&cate_id=1&limit=6',
      dataType: 'json', // text json xml 
      success: function(data){
        
       
        var str = '';
        
        for(var i = 0; i < data.length; i++) {
          str += `
            <li><a href="info.php?aid=${data[i].art_id}" target="_blank" title="${data[i].title}">
              ${data[i].title}
            </a></li>
          `;
        }
        
        $('#newsli1').empty().html(str);
      }
    })
//首页列表2
    $.ajax({
      type: 'get',
      url: 'api/index.php?action=index_article&cate_id=2&limit=6',
      dataType: 'json', // text json xml 
      success: function(data){

        // console.log(data);
        var str = '';

        if(data) {

            for(var i = 0; i < data.length; i++) {
              str += `
                <li><a href="info.php?aid=${data[i].art_id}" target="_blank" title="${data[i].title}">${data[i].title}</a></li>
              `;
            }
            
        }else{

          str += `<li><a href="#" target="_blank" >暫無數據</a></li>`
        }
        
        $('#newsli2').empty().html(str);
      }
    })
//首页最新六篇文章
    $.ajax({
      type: 'get',
      url: 'api/index.php',
      data: {
        action: 'index_article_new',
        limit: 6,
      },
      dataType: 'json',
      success: function(data) {
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
       
        $('#index-blogs').empty().html(str);
      }
    })

//文章分类列表  
      $.ajax({
        type: 'get',
        url: './api/index.php',
        data: {
          action: 'index_cate'
        },
        dataType: 'json',
        success: function(data) {
          var str = ''
          if(data){
            for(var i = 0; i < data.length; i++) {
            str += `
              <li> <a href="info.php?cate_id=${data[i].cate_id}" title="${data[i].cate_name}">${data[i].cate_name}(${data[i].count})</a></li>
            `
          }
          }else{
            str=`
            <li> <a href="info.php?" title="">暂无数据</a></li>
            
            `
          }
          
          $('#cate').empty().html(str);
        }
      })
//首页推荐1
      $.ajax({
        type:'get',
        url:'./api/index.php',
        data:{
          action:'index_recommend',
          cate_id:'5',
        },
        dataType:'json',
        success:function(data){
  var  str =`
             <span>${data.cate_name}</span>
    <h2>${data.title}</h2>
    <p>${data.description}</p>
    <a href="info.php?aid=${data.art_id}" class="read">点击阅读</a>
             `;
       $('#index_recommend1').empty().html(str);
      }
      });
//首页推荐2
      $.ajax({
        type:'get',
        url:'./api/index.php',
        data:{
          action:'index_recommend',
          cate_id:2,
        },
        dataType:'json',
        success:function(data){
       
          var  str =`
             <span>${data.cate_name}</span>
    <h2>${data.title}</h2>
    <p>${data.description}</p>
    <a href="info.php?aid=${data.art_id}" class="read">点击阅读</a>
             `;
       $('#index_recommend2').empty().html(str);
      }
      });
//首页推荐3
      $.ajax({
        type:'get',
        url:'./api/index.php',
        data:{
          action:'index_recommend',
          cate_id:3,
        },
        dataType:'json',
        success:function(data){
         var  str =`
     <span>${data.cate_name}</span>
    <h2>${data.title}</h2>
    <p>${data.description}</p>
    <a href="info.php?aid=${data.art_id}" class="read">点击阅读</a>
             `;
       $('#index_recommend3').empty().html(str);
      }
      });
//点击排行
      $.ajax({
        type:'get',
        url:'api/index.php',
        data:{
          action:'index_clicks',
          limit:9,
        },
        dataType:'json',
        success:function(data){
       
          var str='';
         
          for(let i=0 ; i < data.length ; i++){
              str+=`
              <li><a href="info.php?aid=${data[i].art_id}" target="_blank" title="${data[i].title}">${data[i].title}</a></li>
              `
           }
       
          $('#index_clicks_ul').empty().html(str);
        }
      })
//站长推荐
      $.ajax({
        type:'get',
        url:'api/index.php',
        data:{
          action:'index_master',
          limit:9,
        },
        dataType:'json',
        success:function(data){
              str='';
              if(data){
                for(let i=0 ; i < data.length ; i++){
                  str+=`
                  <li><a href="info.php?aid=${data[i].art_id}" target="_blank" title="${data[i].title}">${data[i].title}</a></li>
                  `
               }
              }else{
                str=`
                <li><a href="#" target="_blank" title=">暂无数据</a></li>
                `
              }
               $('#index_master_ul').empty().html(str);
        },
      })
//友情链接
      $.ajax({
        type:'get',
        url:'api/index.php',
        data:{
          action:'index_frilink',
          limit:3,
        },
        dataType:'json',
        success:function(data){
          str='';
          if(data){
            for(let i=0 ; i < data.length ; i++){
              str+=`
              <li><a href="${data[i].link_url}">${data[i].link_name}</a></li>
              `
           }
          }else{
            str=`
            <li><a href="">暂无数据</a></li>
            `
          }
           $('#index_frilink_ul').empty().html(str);
        },
      })
//博客日记二级链接
      $.ajax({
        type: 'get',
        url: 'api/index.php',
        data:{
          action:'pageContents',
          link_type:1,
        },
        dataType: 'json', // text json xml 
        success: function(data){
          // console.log(data);
          str='';
          data.forEach(function(value,index){
            // console.log(index,value);
            str+=`<a href="${value['moreL_url']}" target="_blank" id="pagecurrent">${value['moreL_name']}</a> `;
           
          });
         $('#pageContents').empty().html(str);
        }
      })
  