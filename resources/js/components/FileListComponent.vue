<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">File List Component</div>

                    <div class="card-body">
                        <div v-if="uploads" class="container">
                            <div class="row">
                                <div class="col-3-sm" 
                                    v-for="upload in uploads" :key="upload.id">
                                    <uploaded-file-component :upload="upload"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                uploads: undefined
            }
        },
        created() {
            bus.$on('upload-complete', (_) => {
                this.load();
            })
        },
        mounted() {
            console.log('Component mounted.');
            this.load();
        },
        methods: {
            load() {
                axios.get('/api/uploads').then(response => {
                    console.log(response);
                    this.uploads = response.data;
                })
            },
        }
    }
</script>
