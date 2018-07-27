<template>
    <div>
        <connection></connection>

        <ul class="list-group" style="padding-top: 30px">
            <li class="list-group-item">
                <router-link to="/home/video_chat">Video Chat</router-link>
            </li>
        </ul>

        <router-view></router-view>
    </div>
</template>

<script>
    import connection from './Connection'

    export default {
        data () {
            return {}
        },
        components: {
            'connection': connection
        }
    }
</script>

<style scoped>

</style>