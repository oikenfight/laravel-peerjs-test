<template>
    <div>
        <h2>Sender</h2>
        <p>my peer id: {{ peer.id }}</p>
        <div>
            <div class="form-inline">
                <input type="text" v-model="targetPeerId" class="form-control" placeholder="Target Peer ID">
                <button @click="connectPeer" class="btn btn-secondary">Connect</button>
                <label class="" style="padding-left: 20px"><span>{{ status }}</span></label>
            </div>
            <div v-show="showForm" class="form-inline" style="padding-top: 30px">
                <input type="text" v-model="message" class="form-control" placeholder="message">
                <button @click="send" class="btn btn-primary">send</button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data () {
            return {
                targetPeerId: '',
                message: '',
                status: 'disconnected',
                showForm: false,
                conn: '',
            }
        },
        computed: {
            // store の getter をローカルにマッピングさせることで算出可能にしている。
            ...mapGetters({
                peer: 'peer',
            }),
        },
        methods: {
            connectPeer () {
                this.conn = this.peer.connect(this.targetPeerId);

                let self = this
                this.conn.on('open',function(){
                    self.status = 'connected'
                    self.showForm = true
                });
            },
            send () {
                this.conn.send({
                    message : this.message,
                    number : 1
                });
            },
        },
    }
</script>

<style scoped>

</style>