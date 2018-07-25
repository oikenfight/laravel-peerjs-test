<template>
    <div>
        <h2>Receiver</h2>
        <p>my peer id: {{ peer.id }}</p>
        <p><span>message: </span>{{ message }}</p>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data () {
            return {
                status: 'disconnected',
                message: '(メッセージ受信前)'
            }
        },
        computed: {
            // store の getter をローカルにマッピングさせることで算出可能にしている。
            ...mapGetters({
                peer: 'peer',
            }),
        },
        mounted () {
            let self = this
            this.peer.on('connection', function(conn) {
                conn.on('data',function(data) {
                    console.log(this)
                    self.message = data['message']
                });
            });
        },
    }
</script>

<style scoped>

</style>