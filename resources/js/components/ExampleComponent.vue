<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component. {{counter}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        counter: Number,
        token: String
    },
    data() {
        return {
            items: []
        }
    },
    created() {
        axios.get('/api/user',{
            headers: {
                'Authorization': `Bearer ${this.token}`
            }
        }).then(resp=>{
            console.log(resp.data)
        })
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
