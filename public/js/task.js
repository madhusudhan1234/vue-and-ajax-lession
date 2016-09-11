Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

new Vue({

    el: '#tasks',

    data: {
        tasks: [],
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        formErrors:{},
        formErrorsUpdate:{},
        newTask : {'body':''},
        fillTask : {'body':'','id':''}
    },

    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    ready : function(){
        this.getVueItems(this.pagination.current_page);
    },

    methods : {

        getVueItems: function(page){
            this.$http.get('/api/tasks?page='+page).then((response) => {
                this.$set('tasks', response.data.data.data);
            this.$set('pagination', response.data.pagination);
        });
        },

        createTask: function(){
            var input = this.newTask;
            this.$http.post('/tasks',input).then((response) => {
                this.changePage(this.pagination.current_page);
            this.newTask = {'body':''};
            $("#create-task").modal('hide');
            toastr.success('Task Created Successfully.', 'Success Alert', {timeOut: 5000});
        }, (response) => {
                this.formErrors = response.data;
            });
        },

        deleteTask: function(task){
            this.$http.delete('/tasks/'+task.id).then((response) => {
                this.changePage(this.pagination.current_page);
            toastr.success('Task Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        });
        },

        editTask: function(task){
            this.fillTask.id = task.id;
            this.fillTask.body = task.body;
            $("#edit-task").modal('show');
        },

        updateTask: function(id){
            var input = this.fillTask;
            this.$http.put('/tasks/'+id,input).then((response) => {
                this.changePage(this.pagination.current_page);
            this.fillTask = {'body':'','id':''};
            $("#edit-task").modal('hide');
            toastr.success('Task Updated Successfully.', 'Success Alert', {timeOut: 5000});
        }, (response) => {
                this.formErrorsUpdate = response.data;
            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getVueItems(page);
        }

    }

});
