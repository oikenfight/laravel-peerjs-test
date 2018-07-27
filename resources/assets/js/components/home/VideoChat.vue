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
                    <h2>peer camera</h2>
                    <div class="camera">
                        <video id="peer-video" class="embed-responsive" autoplay></video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        date () {
            return {
                myStream: '',
                peerStream: '',
            }
        },
        created () {
            this.getVideo();
        },
        computed: {
            // store の getter をローカルにマッピングさせることで算出可能にしている。
            ...mapGetters({
                peer: 'peer',
                connection: 'connection',
                isConnected: 'isConnected',
            }),
        },
        methods: {
            getVideo () {
                let self = this
                navigator.getUserMedia({audio: true, video: true}, (stream) => {
                    let video = $('#my-video')
                    // video.srcObject = stream
                    video.prop('src', URL.createObjectURL(stream))
                    // video.src = URL.createObjectURL(stream)
                    self.myStream = stream
                    self.peerStream = stream
                }, (error) => {
                    console.log(error)
                    alert('An error occured. Please try again')
                })
            },
        }
    }
</script>

<style scoped>

</style>