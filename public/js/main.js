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
            $.getJSON('api/tasks',function (tasks) {
                this.list = tasks;
            }.bind(this));
        },

        delete: function (task) {
            this.list.$remove(task);
        }
    }
});

new Vue({
    el: 'body'
});