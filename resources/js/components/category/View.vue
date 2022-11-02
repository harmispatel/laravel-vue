<template>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>View Images</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    <label>{{images.title}}</label>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <label>{{images.description}}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-4" v-for="(image, index) in this.images.files">
                                        <img :src="image.path" height="150" width="150">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
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
    name:"update-uploader",

    data(){
        return {
            images:{
                title:"",
                description:"",
                _method:"patch",
                files: [],
                images: [],
            }
        }
    },
    
    mounted(){
        this.getDetails()
    },
    
    methods:{
        /**
         * Get the Specific Images Data
         */
        async getDetails () {
            await this.axios.get(`/api/uploader/${this.$route.params.id}`).then(response=>{
                const { title, description } = response.data.data.data
                this.images.title = title
                this.images.description = description
                this.images.files = response.data.data.media
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>