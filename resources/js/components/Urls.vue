<template>
    <div class="container">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Old Url</td>
                    <td>New Url</td>
                    <td>Redirect</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(url,index) in urls.data" :key="index">
                    <td>{{ index }}</td>
                    <td>{{ url.old_url }}</td>
                    <td>{{ url.new_url }}</td>
                    <td><a :href="url.old_url" target="_blank"> <button class="btn btn-primary">Redirect</button></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            urls: {},
        }
    },
    methods: {
        getUrls() {
            axios.get('getUrl').then((res) => {
                this.urls = res
            })
        }
    },
    mounted() {
        this.getUrls();
    }
}
</script>