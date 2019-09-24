$.ajax({
    type:'get',
    url:'api/index.php',
    data:{
        action:'header',
    },
    dataType:'json',
    success:function(data){
        var str='';
        
        for(let i=0;i<data.length;i++){
            str+=`
            <li><a href="${data[i].url}">${data[i].title}</a></li>
            `
        }
        $('#starlist').empty().html(str);
    },
})