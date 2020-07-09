<template>
    <div class="row justify-content-center">
        <h4>New Task</h4>
        <form action="#" @submit.prevent="edit ? updateTask(task.id) : createTask()">
            <div class="input-group">
                <input 
                    v-model="task.title"
                    ref="taskinput"
                    type="text" 
                    name="title" 
                    class="form-control"
                    placeholder="title"
                    autofocus
                >
                <input 
                    v-model='task.description' 
                    ref="taskinput"
                    type="text" 
                    name="description" 
                    class="form-control"
                    placeholder="description"
                    autofocus
                >
                <select @change="onChange($event)" class="form-control" v-model="task.id">
                    <option value="" disabled hidden>Group</option>
                    <option v-for="(value, index) in status" v-bind:key="index" :value="value.id">
                        {{ value.title }}
                    </option>
                </select>
                <span class="input-group-btn">
                    <button v-show="!edit" type="submit" class="btn btn-primary">
                        Add Task
                    </button>
                    <button v-show="edit" type="submit" class="btn btn-primary">
                        Edit Task
                    </button>
                </span>
            </div>
        </form>
        <h4>{{ status[0].title }}</h4>
        <ul>
            <template v-for="task in list">
                <li class="list-group-item" v-if="task.status_id === status[0].id" :key="task.body">
                    <div class="card border-primary mb-1" style="max-width: 20rem;">
                        <div class="card-header">{{ task.title }}</div>
                        <div class="card-body">
                            <h4 class="card-title">{{ task.description }}</h4>
                            <p class="card-text">{{ task.status }}</p>
                        </div>
                    </div>
                    <button @click="showTask(task.id)" class="btn btn-warning btn-xs pull-right">
                        Edit
                    </button>
                    <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">
                        Delete
                    </button>
                </li>
            </template>
        </ul>
        <h4>{{ status[1].title }}</h4>
        <ul>
            <template v-for="task in list">
                <li class="list-group-item" v-if="task.status_id === status[1].id" :key="task.body">
                    <div class="card border-primary mb-1" style="max-width: 20rem;">
                        <div class="card-header">{{ task.title }}</div>
                        <div class="card-body">
                            <h4 class="card-title">{{ task.description }}</h4>
                            <p class="card-text">{{ task.status }}</p>
                        </div>
                    </div>
                    <button @click="showTask(task.id)" class="btn btn-warning btn-xs pull-right">
                        Edit
                    </button>
                    <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">
                        Delete
                    </button>
                </li>
            </template>
        </ul>
        <h4>{{ status[2].title }}</h4>
        <ul>
            <template v-for="task in list">
                <li class="list-group-item" v-if="task.status_id === status[2].id" :key="task.body">
                    <div class="card border-primary mb-1" style="max-width: 20rem;">
                        <div class="card-header">{{ task.title }}</div>
                        <div class="card-body">
                            <h4 class="card-title">{{ task.description }}</h4>
                            <p class="card-text">{{ task.status }}</p>
                        </div>
                    </div>
                    <button @click="showTask(task.id)" class="btn btn-warning btn-xs pull-right">
                        Edit
                    </button>
                    <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">
                        Delete
                    </button>
                </li>
            </template>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                edit: false,
                list: [],
                task: {
                    id: '',
                    title: '',
                    description: '',
                    status_id: 1,
                },
                status: []
            };
        },
        mounted: function() {
            this.fetchTaskList();
            this.fetchStatusList();
        },
        methods: {
            fetchTaskList: function() {
                this.$http.get('api/tasks').then(response => {
                    this.list = response.data
                });
            },
            fetchStatusList: function() {
                this.$http.get('api/status').then(response => {
                    this.status = response.data
                })
            },
            createTask: function() {
                this.$http.post('api/tasks/store', this.task)
                this.task = {
                    id: '',
                    title: '',
                    description: '',
                    status_id: ''
                }
                this.edit = false
                this.fetchTaskList()
            },
            updateTask: function(id) {
                this.$http.patch('api/task/' + id, this.task)
                this.task = {
                    id: '',
                    title: '',
                    description: '',
                    status_id: ''
                }
                this.edit = false
                this.fetchTaskList()
            },
            showTask: function(id) {
                this.$http.get('api/task/' + id).then(function(response) {
                    this.task.id = response.data.id
                    this.task.title = response.data.title
                    this.description = response.data.description
                    this.status_id = response.data.status_id
                })
                this.$els.taskinput.focus()
                this.edit = true
            },
            deleteTask: function(id) {
                this.$http.delete('api/task/' + id)
                this.fetchTaskList()
            }
        }
    }    
</script>
