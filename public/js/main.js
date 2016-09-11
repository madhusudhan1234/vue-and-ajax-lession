Vue.component('tasks',{
    template: '#tasks-template',

    props: ['list'],

    data: function () {
       return{
           list: []
       }
    },

    created: function () {
        this.fetchTasks();
    },
    
    methods : {
        fetchTasks: function(){
            this.$http.get('api/tasks',function (tasks) {
                console.log(tasks);
                 this.list = tasks;
            }.bind(this));
        },

        deleteTask: function (task) {
            this.list.$remove(task);
        }
    }
});

new Vue({
    el: 'body'
});