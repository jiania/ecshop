shopex Prism sdk (php version)
=================================


## 基本设置

```php
    require_once('prism-php/lib/client.php');

    $url = 'http://127.0.0.1:8080/api';
    $key = 'ysw6o4wl';
    $secret = 'fe24mkjmxh5wch4cbob7';

    $c = new prism_client($url, $key, $secret);

    /* 日志信息输出
    * $c->set_logger(function($message){
    *     echo $message;
    *     flush();
    * });
    */
```

## 发起Api请求

```php
    $params = array(
        'username'=>'b', 
        'password'=>'c',
        );
    $a = $c->post('/user/login', $params);
    var_dump($a);
```

## 消息队列
### 发布数据

```php
    $mq = $c->notify();

    $i=0;
    while(1){
        $data = $mq->get();
        echo $data, "\n";
        $data->ack();
        $i++;
    }
```
- [视频演示][1]


### 消费队列中的数据

```php
    $mq = $c->notify();

    $i=0;
    while(1){
        $data = $mq->get();
        echo $data, "\n";
        $data->ack();
        $i++;
    }
```
- [视频演示][2]

[1]: http://asciinema.org/a/6541       "产生数据"
[2]: http://asciinema.org/a/6541       "消费数据"