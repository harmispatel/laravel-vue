<template>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Add Images</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="uploader.title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="uploader.description">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Images</label>
                                    <input type="file" name="images[]" multiple @change="uploadImages">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <router-link :to='{name:"imageList"}' class="btn btn-secondary">Back</router-link>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"add-uploader",
    
    data () {
        return {
            uploader: {
                title: "",
                description: "",
                images: []
            }
        }
    },

    methods:{
        /**
         * Uploade Images
         */
        uploadImages (e) {
            this.uploader.images = e.target.files;
        },

        /**
         * Save Multiple Images Data
         */
        async create(){
            let formData = new FormData();

            formData.append('title', this.uploader.title);
            formData.append('description', this.uploader.description);

            for( var i = 0; i < this.uploader.images.length; i++ ){
                let file = this.uploader.images[i];
                formData.append('images[' + i + ']', file);
            }

            let config = { headers: { 'Content-Type': 'multipart/form-data' } }
            
            await this.axios.post('/api/uploader', formData, config)
            .then(response => {
                this.$router.push({name:"imageList"})
            }).catch(error => {
                console.log(error)
                alert('Please Fill All the details and File Type Should be Image');
            })
        }
    }
}
</script>