<template>
    <div class="row justify-content-center" style="padding-top: 30px">
        <div class="col-11">
            <div class="row">
                <div class="col-6">
                    <h2>my camera</h2>
                    <div class="col-11 camera">
                        <video id="my-video" class="embed-responsive" autoplay></video>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <h2>peer camera</h2>
                        </div>
                        <div class="col-6">
                            <button v-if="callStatus === 'call'" class="btn btn-primary" @click="callTo">{{ callStatus }}</button>
                            <button v-if="callStatus === 'wait'" class="btn btn-secondary disabled">{{ callStatus }}</button>
                            <button v-if="callStatus === 'talk'" class="btn btn-primary disabled" @click="callTo">{{ callStatus }}</button>
                            <button v-if="callStatus === 'talking'" class="btn btn-success disabled">{{ callStatus }}</button>

                        </div>
                    </div>

                    <div class="offset-1 col-11 camera">
                        <video id="peer-video" class="embed-responsive" autoplay></video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    // TODO: Call ボタンを押したら、Wait 状態（相手の応答待ち）にする
    // TODO: Call されたら、Talk 状態（自分の応答待ち）にする
    // TODO: Call and Talk が成立して初めてビデオチャットを開始する

    export default {
        data () {
            return {
                myStream: null,
                peerStream: null,
                calling: false,
                called: false,
            }
        },
        created () {
            let self = this
            this.getMyVideo();

            // コネクションが成立した時
            this.peer.on('connection', function (connection) {
                console.log('connect to ' + connection.peer)
                self.$store.dispatch('connectPeer', connection)
            })

            // コールがかかってきた時
            this.peer.on('call', function(call){
                self.received(call)
            })
        },
        computed: {
            // store の getter をローカルにマッピングさせることで算出可能にしている。
            ...mapGetters({
                peer: 'peer',
                connection: 'connection',
                isConnected: 'isConnected',
            }),
            callStatus () {
                console.log(this.connection.peer)
                console.log(this.calling)
                console.log(this.called)
                if (this.connection.peer && this.calling && !this.called) {
                    console.log('wait')
                    return 'wait'
                } else if (this.connection.peer && !this.calling && this.called) {
                    console.log('talk')
                    return 'talk'
                } else if (this.connection.peer && this.calling && this.called) {
                    console.log('talking')
                    return 'talking'
                } else {
                    console.log('call')
                    return 'call'
                }
            },
        },
        methods: {
            onReceiveStream (stream, elementId) {
                // stream を流す
                let video = $('#' + elementId)
                video.prop('src', URL.createObjectURL(stream))
            },
            getMyVideo () {
                // 自分のカメラ映像を取得する
                let self = this
                navigator.getUserMedia({audio: true, video: true}, (stream) => {
                    self.myStream = stream
                    self.onReceiveStream(self.myStream, 'my-video')
                }, (error) => {
                    console.log(error)
                    alert('An error occured. Please try again')
                })
            },
            callTo () {
                // 相手に自分の stream を流す
                if (this.isConnected) {
                    let self = this
                    this.calling = true
                    let call = this.peer.call(this.connection.peer, this.myStream)
                    // call して応答が合った場合、stream を受け取り stream を流す
                    call.on('stream', function(stream){
                        console.log('receive stream when callTo')
                        self.peerStream = stream;
                        self.onReceiveStream(self.peerStream, 'peer-video');
                    });
                } else {
                    alert('Connection is not established. Please enter a valid peer ID')
                }
            },
            received (call) {
                // call を受け取った場合、受け取った stream を流す
                console.log('received call')
                this.called = true
                let self = this
                call.answer(this.myStream);
                call.on('stream', function(stream){
                    self.peerStream = stream;
                    self.onReceiveStream(self.peerStream, 'peer-video');
                });
            },


        }
    }
</script>

<style scoped>

</style>