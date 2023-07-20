<template>
<div>
    <h5 class="card-title">List task<a href="#" @click="openForm" title="add new task"><i class="far fa-plus-square ms-2"></i></a></h5>
    <TaskForm :display="displayForm" @cancelForm="closeForm" @getItems="getItems" v-if="displayForm" :token="token"></TaskForm>
    <div class="accordion mt-4" id="accordionPanelsStayOpenOne">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    tasks to be done
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <TaskList :items="tasks" :token="token" @getItems="getItems"></TaskList>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion mt-4" id="accordionPanelsStayOpenTwo">
        <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                tasks to be done
            </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
                <TaskList :items="tasksDone" :token="token" @getItems="getItems"></TaskList>
            </div>
        </div>
    </div>
    </div>

</div>
</template>

<script>

import TaskForm from "./TaskForm.vue";
import TaskList from "./TaskList.vue";
export default {
    name: "TaskView",
    components: {
        TaskForm,
        TaskList
    },
    props: {
        token: String
    },
    data() {
        return {
            tasks: [],
            tasksDone: [],
            displayForm: false
        }
    },
    created() {
        this.getItems();
    },
    methods: {
        openForm() {
            this.displayForm = true;
        },
        closeForm(){
            this.displayForm = false;
        },
        getItems() {
            axios.get('/api/task/list',{
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then(resp=>{
                if (Array.isArray(resp.data)) {
                    this.tasks = resp.data
                }
            });
            axios.get('/api/task/list-done',{
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then(resp=>{
                if (Array.isArray(resp.data)) {
                    this.tasksDone = resp.data
                }
            });
        }
    }
}
</script>
