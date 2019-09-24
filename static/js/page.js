//about me

//time
$.ajax({
    type:'get',
    url:'api/index.php',
    data:{
        action:'time_page',
        limit:16,
    },
    dataType:'json',
    success:function(data){
        var str='';
        // console.log(data);
        if(data){
            data.forEach(function(value,index){
           
                str+=`
            <li><span>${value.addtime}</span><i><a href="/" target="_blank">${value.title}</a></i></li>
            ` 
            });
          }else{
           str=`
           <li><span></span><i><a href="/" target="_blank">暂无数杮</a></i></li>
           `
        }
        $('#time_ul').empty().html(str);
    }
})