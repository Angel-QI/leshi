<?php
    /*
    接受前端传递来的参数
      + 再一个预定义变量里面接受参数
      + $_GET -> 存储的是前端以 GET 方式传递来的参数
      + $_POST -> 存储的是前端以 POST 方式传递来的参数

    因为前端是以 POST 方式发送的请求
      + 后端就在 $_POST 这个预定义变量里面获取
      + 也是一个关联型数组, 从里面获取数据

  */

  // 0. 中文乱码
  header('content-type: text/html;charset=utf-8;');

  // 1. 获取前端传递来的参数
  $uname = $_POST['username'];
  $upass = $_POST['password'];

  // 2. 去数据库比对
  // 2-1. 连接数据库
  $link = mysqli_connect('localhost', 'root', 'root', 'test908');

  // 2-2. 执行 sql 语句
  $sql = "SELECT * FROM `users` WHERE `username`='$uname' ";
  $res = mysqli_query($link,$sql);

  // 2-3. 解析结果
  $row = mysqli_fetch_assoc($res);
 
  
  if ($row) {
    $arr = array("message" => "用户名已存在", "code" => 0);
  } else {
    
    $res = mysqli_query($link, "INSERT INTO `users` VALUES(null,$uname,$upass)");
    
    $arr = array("message" => "注册成功", "code" =>1 );
  }
  print_r(json_encode($arr));

  // 2-4. 断开和数据库的连接
  mysqli_close($link);

  //3. 根据数据库操作的结果进行操作
  
?>