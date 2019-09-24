<?php
    // 引入配置文件
    include_once( '../lib/config.php' );
    include_once('../lib/admin_check.php');
    $sql="select count(*) as count from {$pre}friend_link";
    $count= getOne($sql);
    $count=$count['count'];
   
    // 当前是第几页
    $page=isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] :1;
 // 每页多少条数据
    $limit =5;
     // 下标 
    $offset = ($page - 1)*$limit;
     // 总页数
    $totalPage = ceil($count/$limit);
    if($count){
        $sql="select * from {$pre}friend_link order by link_id desc";
        $data = getAll($sql);
        foreach($data as $key=>$value){
            $data[$key]['link_url'] = cutstr($value['link_url'], 0, 20, '...');
         }
    }
  
    // var_dump($data);
 // 3. 生成分页字符串
    $pageStr=pagination($count,$page,$limit,$totalPage);
// 删除??????没有接收到请求
    $id='';
    $id=isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : '';
   
    if($id){
    echo  '4564565';die;
     $sql="delete from {$pre}friend_link where link_id={$id}";
    //  echo $sql;die;
        $r = delete($sql);
       
        if($r){
            echo '1';die;
        }else{
            echo '0';die;
        }
    }

?>
<?php include_once('header.php') ?>
<div class="content">
    <div class="row"> 

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    列表
                    <button class="btn btn-primary float-right rounded"  onclick="window.location.href='singlep_add_edit.php'" >
                        <i class="fa fa-plus"></i>
                        添加
                    </button>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th> 
                                <th>ID</th>
                                <th>链接名称</th>
                                <th>链接地址</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if($count){ foreach ($data as $key => $value){ ?>
                                    
                                    <tr id="trparent">
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                  <input type="checkbox" class="slt">
                                                </label>
                                              </div>
                                        </td>
                                        <!-- 构造序列号 不够指定长度补0 -->
                                        <td><?php echo str_pad($value['link_id'], 4, 0,  STR_PAD_LEFT) ?></td>
                                        <td><?php echo $value['link_name'] ?></td>
                                        <td class="text-nowrap" title="<?php echo $value['link_url'] ?>"><?php echo $value['link_url'] ?></td>  
                                         
                                        <td>
                                            <a class="btn btn-primary rounded" href="./link_add_edit.php?link_id=<?php echo $value['link_id']   ?>">
                                                <i class="fa fa-edit"></i>
                                                编辑
                                            </a>
                                            <button class="btn btn-danger rounded dlt" data-toggle="modal" data-target="#modal-delete" data-did="<?php echo $value['link_id'] ?>">
                                                <i class="fa fa-trash"></i>
                                                删除
                                            </button>
                                        </td>
                                    </tr>
                                   
                                <?php } }else{ ?>
                                <tr>
                                    <td>暂无数据</td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="10">
                                        <button class="btn btn-warning rounded" id="sltAll">全选</button>
                                        <button class="btn btn-warning rounded" id="cancel">取消</button>
                                        <button class="btn btn-warning rounded" id="reverse">反选</button>
                                    </td>
                                </tr>
                                <tr>
                                   <td>
                                       <button class="btn btn-danger rounded">
                                           <i class="fa fa-trash-o fa-lg"></i>
                                           全部删除
                                       </button> 
                                   </td>
                                   <td colspan="9"> 
                                      <nav aria-label="Page navigation">
                                        <ul class="pagination float-right">
                                           <?php echo $pageStr; ?>
                                        </ul>
                                      </nav> 
                                   </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger border-0">
                                        <h5 class="modal-title text-white">系统提示</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body p-3">
                                        请确认是否删除？
                                    </div>
                                    
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-link" data-dismiss="modal">取消</button>
                                        <button type="button" class="btn btn-danger" data-id="" id="delete">确定</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> 
<?php include_once('footer.php') ?>

<script type="text/javascript">
$('#sltAll').click(function(){
    console.log(132);
    $('.slt').each(function(){
        this.checked=true;
    })
})

$('#cancel').click(function(){
    console.log(132);
    $('.slt').each(function(){
        this.checked=false;
    })
})

$('#reverse').click(function(){
    console.log(132);
    $('.slt').each(function(){
        this.checked=!this.checked;
    })
})

   $('.dlt').click(function(){
       var id=$(this).attr('data-did');
       $('#delete').attr('data-id',id);
       
   })
  
   $('#delete').click(function(){
       var id=$(this).attr('data-id');
      
       $.ajax({
            type: 'get',
            url: 'link_list.php',
            data: {
                id: id,
               
            },
            dataType: 'json',
            // error:function(jqXHR,textStatus,errorThrown){
            //    console.log(errorThrown);
            // },
           success:function(data){
              
               if(data){
                // console.log('关闭模拟框');
                   // 关闭模拟框
                   $('.close').trigger('click'); 
                   $('[data-did='+id+']').parents('tr').remove();
                   alert('删除成功')
               }else{
                   alert('删除失败')
               }
           }
       })
   })
</script>
