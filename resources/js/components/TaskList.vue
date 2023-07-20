<template>
<div class="p2">
    <table class="table">
        <thead>
        <tr>
            <td style="width: 30px"></td>
            <td style="width: 30px"></td>
            <td></td>
            <td style="width: 60px"></td>

        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in items" :key="item.id">
            <td>{{index+1}}</td>
            <td>
                <a href="#" @click="deleteTask(item.id)" title="delete task"><i class="fa-solid fa-trash"></i></a>
            </td>
            <td :class="underline(item)">
                <div contenteditable="true" v-if="!item.done" @blur="changeTitleTask(item.id, $event.target.innerText)">{{item.title}}</div>
                <div v-else>{{item.title}}</div>
            </td>
            <td>
                <button v-if="item.done" class="btn btn-outline-secondary" @click="cancelDoneTask(item.id)">cancel</button>
                <button v-else class="btn btn-outline-success" @click="doneTask(item.id)">done</button>

            </td>
        </tr>
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    name: "TaskList",
    props: {
        token: String,
        items: Array
    },
    methods: {
        async deleteTask(id) {
            await axios.get('/api/task/delete/'+id,{
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            });
            this.$emit('getItems');
        },
        async doneTask(id) {
            await axios.put('/api/task/'+id,{action: 'done' },{
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            });
            this.$emit('getItems');
        },
        async cancelDoneTask(id) {
            await axios.put('/api/task/'+id,{action: 'cancel' },{
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            });
            this.$emit('getItems');
        },
        async changeTitleTask(id, title) {
            await axios.put('/api/task/'+id,{action: 'title', title: title},{
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            });
            this.$emit('getItems');
        },
        underline(item) {
            return item.done !== null ? 'text-decoration-underline' : '';
        }
    }
}
</script>
