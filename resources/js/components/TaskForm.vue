<template>
<div class="row">
    <div class="col-12">
        <div class="m-2">
            <label class="form-label">Add new task</label>
            <input type="text" class="form-control" v-model="title">
            <div v-if="error.title" class="error-task-form">text is require</div>
        </div>
        <div class="d-inline m-2">
            <button class="btn btn-outline-dark me-2" @click="$emit('cancelForm')">Cancel</button>
            <button class="btn btn-outline-primary" @click="saveFrom">Save</button>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";

export default {
    name: "TaskForm",
    props: {
        token: String
    },
    data() {
        return {
            title: '',
            error: {
                title: false
            }
        }
    },
    methods: {
        async saveFrom() {

            if (this.title == '') {
                this.error.title = true
                return;
            }

            await axios.post('api/task/create', {
                title: this.title
            }, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            });

            this.$emit('getItems');
            this.$emit('cancelForm');
        }
    }
}
</script>

<style scoped>

.error-task-form {
    color: red;
}

</style>
