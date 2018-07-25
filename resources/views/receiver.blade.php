<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>reciver</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/peerjs/0.3.9/peer.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
<h1>受信側</h1>
<p>my peer id: <span id="peer-id"></span></p>
<p id='reciver_messege'>こんにちは！(メッセージ受信前)</p>
</body>
<script type="text/javascript">

    let reciverMessage = document.getElementById('reciver_messege');

    const peer = new Peer({
        host: '127.0.0.1',
        port: 9000,
        path: '/peerjs',
        debug: 3,
        proxied: true,
    });

    peer.on('open', function(){
        console.log(peer.id)
        $('#peer-id').text(peer.id);
    });

    peer.on('connection', function(conn) {
        conn.on('data',function(data) {
            // 受け取ったデータをコンソールログ出力
            // 映像と、テキストを別で送信することが可能。
            console.log(data['string']);
            reciverMessage.innerText = data['string'];
        });
    });
</script>
</html>