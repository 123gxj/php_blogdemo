<?php
// 设置时区
// date_default_timezone_set('PRC');

// 设置路径
// define("APP", str_replace('\\', '/', dirname(__DIR__)) . '/');
// define("CONF", APP.'lib/config.php' );

// 引入库文件
include_once( '../lib/config.php' );
// include_once( DB );

// 链接数据库
// $cn = connect($host, $user, $pwd, $db);

// 请求数据
$action = isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action']:'index';
$limit = isset($_GET['limit']) && !empty($_GET['limit']) ? $_GET['limit']: 1;
// 分类id
$cate_id = isset($_GET['cate_id']) && !empty($_GET['cate_id']) ? $_GET['cate_id']: 1;
// 详情id
$aid = isset($_GET['aid']) && !empty($_GET['aid']) ? $_GET['aid']: 1;
//单页id
// echo $_GET['single_name'];
// echo "<br>";
$single_name=isset($_GET['single_name']) && !empty($_GET['single_name']) ? $_GET['single_name']:1;
// echo $_GET['single_name'];
// echo "<br>";
// echo $sql="select content from {$pre}single_page where name='{$single_name}'";die;
$link_type=isset($_GET['link_type'])  && !empty($_GET['link_type']) ?$_GET['link_type']  :1;

// 首页根据分类id查询文章
if( $action == 'index_article') {
	// join> where> order by> limit
	$sql = "select art_id, title from {$pre}article where cate_id = {$cate_id} order by art_id desc limit {$limit}";
	$data = getAll($sql);
	echo json_encode($data);die;
}

// 首页查询最新六篇文章
if( $action == 'index_article_new') {
	$sql = "select art_id, title, description from {$pre}article order by art_id desc limit {$limit}";
	$data = getAll($sql); 
	echo json_encode($data);die;
}

// 首页根据点击量查询文章
if( $action == 'index_article_reading') {
	$sql = "select art_id, title, description from {$pre}article order by reading desc limit {$limit}";
	$data = getAll($sql); 
	echo json_encode($data);die;
}

// 首页站长推荐文章
if( $action == 'index_article_reading') {
	$sql = "select art_id, title, description from {$pre}article where recommend = 1 order by reading desc limit {$limit}";
	$data = getAll($sql); 
	echo json_encode($data);die;
}

// 首页分类
if( $action == 'index_cate') {
	$sql = "select * from {$pre}cate  order by cate_id asc limit 5";
	$data = getAll($sql);

	foreach($data as $key=>$value) {

		$cate_id = $value['cate_id'];
		$sql = "select count(*) as c from {$pre}article where cate_id={$cate_id}";
		$temp = getOne($sql);
		$data[$key]['count'] = $temp['c'];
	}
	echo json_encode($data);die;
}
//博客日记子导航以及相关文章
if($action == 'pageContents'){
	$sql = "select * from {$pre}more_link where moreL_type={$link_type}";
	// echo $sql;die;
	$data = getAll($sql);
	echo json_encode($data);die;

}

// 博客详情
if( $action == 'blog_detail') {
	$sql = "select * from {$pre}article where addtime = 
	(select max(addtime) from {$pre}article)";
	
	if(isset($_GET['cate_id']) && !empty($_GET['cate_id'])){

		$sql ="select * from {$pre}article as a left join {$pre}cate as c on c.cate_id = a.cate_id where a.cate_id={$_GET['cate_id']} limit 1";
	}
	if(isset($_GET['aid']) && !empty($_GET['aid'])){
		$sql = "select * from {$pre}article as a left join {$pre}cate as c on c.cate_id = a.cate_id where a.art_id={$aid}";
	}
	// echo $sql;die;
	$data = getOne($sql);
	
	// 时间处理
	$data['addtime'] = date('Y-m-d', $data['addtime']);

	echo json_encode($data);die;
}
// 首页推荐
if($action=='index_recommend'){
	$sql="select c.cate_name,a.title,a.description,a.art_id from {$pre}article as a left join {$pre}cate as c on c.cate_id = a.cate_id where a.cate_id={$cate_id} and recommend=2";
	$data=getOne($sql);
	echo json_encode($data);die;
}
//首页点击量
if($action=='index_clicks'){
	$sql="select title,art_id from {$pre}article order by reading desc limit {$limit}";
	$data=getAll($sql);
	echo json_encode($data);die;
}
//站长推荐
if($action=='index_master'){
	$sql="select title,art_id from {$pre}article where recommend=1 limit {$limit}";
	$data=getAll($sql);
	echo json_encode($data);die;
}
//友情链接
if($action=='index_frilink'){
	$sql="select * from {$pre}friend_link limit {$limit}";
	$data=getAll($sql);
	echo json_encode($data);die;
}

//header

if($action=='header'){
	$sql='select title,url from nav where is_show=1 order by show_order';
	$data=getAll($sql);
	echo json_encode($data);die;
}


//about_page
if($action=='about_page'){
	$sql="select content from {$pre}single_page where name='{$single_name}'";
	
	$data['aboutme'] = getAll($sql);
	$sql="select domain_name,website,record from {$pre}setting limit 1";
	$data['aboutweb']=getAll($sql);
    echo json_encode($data);die;
}
//分页实现
if($action=='article_count'){
	$sql = "select count(*) as count from {$pre}article";
	$count = getOne($sql);
	$c=$count;
	$count = $count['count'];

 // 当前是第几页
 $page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1;

 // 每页多少条数据
 $limit =5;
 // 下标 
 $offset = ($page - 1 ) * $limit;
 // 总页数
 $totalPage = ceil($count / $limit);
//  echo $count;die;
 // 总数大于0，进行分页。
 if( $count ) {
	 // 2. 连表 倒序 查询 文章和文章分类
	 $sql = "select * from {$pre}article as a left join {$pre}cate as c on c.cate_id=a.cate_id order by a.art_id desc limit {$offset}, {$limit}"; 
	 $data = getAll($sql); 
	// 时间处理
	for($i=0;$i<count($data);$i++){
		$data[$i]['addtime']=date('Y-m-d',$data[$i]['addtime']);
	}
 }
 // 3. 生成分页字符串
//  $pageStr = pagination($count, $page, $limit, $totalPage,'Sabros.us Style');
$pageStr = pagination($count, $page, $limit,'','','Sabros.us');
 $result['data']=$data;
 $result['pageStr']=$pageStr;
 echo json_encode($result);
 
}