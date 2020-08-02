<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Upload Your Shit</div>

                    <div class="card-body">
                        <input type="file" id="file" ref="file" @change="upload">
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            upload() {

                Vapor.store(this.$refs.file.files[0], {
                    progress: progress => {
                        this.uploadProgress = Math.round(progress * 100);
                    }
                }).then(response => {
                    axios.post('/api/uploads', {
                        uuid: response.uuid,
                        key: response.key,
                        bucket: response.bucket,
                        name: this.$refs.file.files[0].name,
                        content_type: this.$refs.file.files[0].type,
                    }).then(_ => {
                        console.log('emit')
                        bus.$emit('upload-complete')
                    })
                });
                
            }
        }
    }
</script>
