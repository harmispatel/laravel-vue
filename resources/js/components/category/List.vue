<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"imagesAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>MULTIPLE IMAGE UPLODER</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="categories.length > 0">
                                <tr v-for="(category,key) in categories" :key="key">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.title }}</td>
                                    <td>{{ category.description }}</td>
                                    <td>
                                        <router-link :to='{name:"imagesView", params:{id:category.id}}' class="btn btn-info text-white">View</router-link>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Data Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"categories",
    
    data () {
        return {
            categories:[]
        }
    },

    mounted () {
        this.getImageDetails()
    },
    
    methods: {
        /**
         * Get the All Images Data
         */
        async getImageDetails () {
            await this.axios.get('/api/uploader').then(response=>{
                this.categories = response.data.data
            }).catch(error=>{
                console.log(error)
                this.categories = []
            })
        },

        /**
         * Delete Multiple Images Data
         */
        deleteCategory (id) {
            if (confirm("Are you sure to delete this Images Data ?")) {
                this.axios.delete(`/api/uploader/${id}`).then(response=>{
                    this.getImageDetails()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>