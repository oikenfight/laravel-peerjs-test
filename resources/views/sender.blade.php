<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>sender</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/peerjs/0.3.9/peer.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>
<body>
    <p>my peer id: <span id="peer-id"></span></p>
    <h1>送信側</h1>

    <div>
        <input type="text" name="target_peer_id" id="target_peer_id" placeholder="Target Peer ID">
        <button id="connect">Connect</button>
    </div>

    <p id="connected"></p>

</body>
<script type="text/javascript">

    const peer = new Peer({
        host: '127.0.0.1',
        port: 9000,
        path: '/peerjs',
        debug: 3,
        proxied: true,
    });

    $('#connect').click(function(){
        const target_peer_id = $('#target_peer_id').val();
        const conn = peer.connect(target_peer_id);

        conn.on('open',function(){
            conn.send({
                string : 'Hello World!(メッセージ受信後)',
                number : 1
            });
            $('#connected').text('connect successful');
        });
    });

    peer.on('open', function(){
        console.log(peer.id)
        $('#peer-id').text(peer.id);
    });
</script>
</html>