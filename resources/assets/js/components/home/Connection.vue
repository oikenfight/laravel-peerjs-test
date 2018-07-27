<template>
    <div class="row justify-content-center" style="padding-top: 30px">
        <div class="col-12">
            <div class="row form-inline">
                <div class="col-8">
                    <div class="form-inline">
                        <input type="text" v-model="targetPeerId" class="form-control" placeholder="Target Peer ID">
                        <button @click="connect" class="btn btn-primary" :class="">Connect</button>
                    </div>
                </div>

                <div class="col-4 text-right">
                    <h4 class=""><span class="badge" :class="badgeColor">{{ connectStatus }}</span></h4>
                </div>
            </div>

            <div class="row">
                <div class="offset-8 col-4">
                    <p>自分のID: {{ peer.id }}</p>
                    <p>相手のID: {{ connection.peer }}</p>
                </div>
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
            }
        },
        computed: {
            // store の getter をローカルにマッピングさせることで算出可能にしている。
            ...mapGetters({
                peer: 'peer',
                connection: 'connection',
                isConnected: 'isConnected',
            }),
            badgeColor () {
                return this.connection.peer ? 'badge-success' : 'badge-secondary'
            },
            connectStatus () {
                return this.connection.peer ? 'connected' : 'disconnected'
            },
        },
        methods: {
            connect () {
                if (this.targetPeerId.length === 16) {
                    let connection = this.peer.connect(this.targetPeerId);

                    let self = this
                    connection.on('open',function(){
                        self.$store.dispatch('connectPeer', this)
                    });
                }
            },
        }
    }
</script>

<style scoped>

</style>