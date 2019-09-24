<?php include_once('header.php') ?>
<article>
  <div class="timebox">
    <ul id="time_ul">
     
    </ul>
  </div>
  <div class="pagelist"></div>
  
</article>
<?php include_once('footer.php') ?>
<script type="text/javascript" src="static/js/header.js"></script>

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
            data.forEach(function(value,index){
           
                str+=`
            <li><span>${value.addtime}</span><i><a href="/" target="_blank">${value.title}</a></i></li>
            ` 
            });
          }else{
           str=`
           <li><span></span><i><a href="/" target="_blank">æš‚æ— æ•°æ�®</a></i></li>
           `
        }
       $('.pagelist').empty().html(pageStr);
        $('#time_ul').empty().html(str);
      }
    })
</script>