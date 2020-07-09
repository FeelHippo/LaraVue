<template>
    <div class="row justify-content-center centerPiece">
        <form class="taskForm" action="#" @submit.prevent="edit ? updateTask(task.id) : createTask()">
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
                <select @change="changeStatus($event)" class="form-control">
                    <option value="" disabled hidden>Group</option>
                    <option v-for="(value, index) in status" :key="index" :value="value.id">
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
                    <button v-show="edit" @click="toggleEdit()" class="btn btn-primary">
                        Cancel
                    </button>
                    <button class="btn btn-primary" @click="sort">
                        To original order
                    </button>
                </span>
            </div>
        </form>

        <h4 class="status1">{{ status[0].title }}</h4>
        <draggable
            class="list-group column1"
            tag="ul"
            v-model="list"
            v-bind="dragOptions"
            @start="drag = true"
            @end="drag = false"
        >
            <transition-group type="transition" :name="!drag ? 'flip-list' : null">
                <li 
                    class="list-group-item taskCard"
                    v-for="task in list"
                    v-if="task.status_id === status[0].id"
                    :key="task.order"
                >
                    <div @click="element.fixed = !element.fixed">
                        <div class="card border-primary mb-1" style="max-width: 20rem;">
                            <div class="card-header">{{ task.title }}</div>
                            <div class="card-body">
                                <h4 class="card-title">{{ task.description }}</h4>
                                <p class="card-text">{{ task.status }}</p>
                            </div>
                        </div>
                        <section class="frontCardButtons">
                            <button @click="showTask(task.id)" class="btn btn-warning btn-xs pull-right">
                                Edit
                            </button>
                            <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">
                                Delete
                            </button>
                        </section>
                    </div>
                </li>
            </transition-group>
        </draggable>

        <h4 class="status2">{{ status[1].title }}</h4>
        <draggable
            class="list-group column2"
            tag="ul"
            v-model="list"
            v-bind="dragOptions"
            @start="drag = true"
            @end="drag = false"
        >
            <transition-group type="transition" :name="!drag ? 'flip-list' : null">
                <li 
                    class="list-group-item taskCard"
                    v-for="task in list"
                    v-if="task.status_id === status[1].id"
                    :key="task.order"
                >
                    <div @click="element.fixed = !element.fixed">
                        <div class="card border-primary mb-1" style="max-width: 20rem;">
                            <div class="card-header">{{ task.title }}</div>
                            <div class="card-body">
                                <h4 class="card-title">{{ task.description }}</h4>
                                <p class="card-text">{{ task.status }}</p>
                            </div>
                        </div>
                        <section class="frontCardButtons">
                            <button @click="showTask(task.id)" class="btn btn-warning btn-xs pull-right">
                                Edit
                            </button>
                            <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">
                                Delete
                            </button>
                        </section>
                    </div>
                </li>
            </transition-group>
        </draggable>

        <h4 class="status3">{{ status[2].title }}</h4>
        <draggable
            class="list-group column3"
            tag="ul"
            v-model="list"
            v-bind="dragOptions"
            @start="drag = true"
            @end="drag = false"
        >
            <transition-group type="transition" :name="!drag ? 'flip-list' : null">
                <li 
                    class="list-group-item taskCard"
                    v-for="task in list"
                    v-if="task.status_id === status[2].id"
                    :key="task.order"
                >
                    <div @click="element.fixed = !element.fixed">
                        <div class="card border-primary mb-1" style="max-width: 20rem;">
                            <div class="card-header">{{ task.title }}</div>
                            <div class="card-body">
                                <h4 class="card-title">{{ task.description }}</h4>
                                <p class="card-text">{{ task.status }}</p>
                            </div>
                        </div>
                        <section class="frontCardButtons">
                            <button @click="showTask(task.id)" class="btn btn-warning btn-xs pull-right">
                                Edit
                            </button>
                            <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs pull-right">
                                Delete
                            </button>
                        </section>
                    </div>
                </li>
            </transition-group>
        </draggable>
    </div>
</template>

<script>

    import draggable from 'vuedraggable'

    export default {
        name: "ToDoList",
        display: "Transitions",
        order: 7,
        components: {
            draggable
        },
        data: function() {
            return {
                edit: false,
                drag: false,
                list: [],
                task: {
                    id: '',
                    title: '',
                    description: '',
                    status_id: 1,
                    order: 0
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
                    this.list = response.data.map((task, index) => {
                        return {
                            ...task,
                            order: index + 1
                        };
                    })
                });
            },
            fetchStatusList: function() {
                this.$http.get('api/status').then(response => {
                    this.status = response.data
                })
            },
            changeStatus(event) {
                this.task.status_id = event.target.value
            },
            toggleEdit() {
                this.edit = !this.edit
            },
            sort() {
                this.list = this.list.sort((a, b) => a.order - b.order)
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
                this.$http.patch('api/tasks/' + id, this.task)
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
                this.$http.get('api/tasks/' + id).then(response => {
                    this.task = response.data;
                })
                this.$refs.taskinput.focus()
                this.edit = true
            },
            deleteTask: function(id) {
                this.$http.delete('api/tasks/' + id).then(() => {
                    this.fetchTaskList()
                })
            }
        },
        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        }
    }    
</script>
