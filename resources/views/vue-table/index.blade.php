<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue Table </title>
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css') }}">
    <style>
        .ui.vertical.stripe h3 {
            font-size: 2em;
        }

        .secondary.pointing.menu .toc.item {
            display: none;
        }

        .vuetable {
            margin-top: 1em !important;
        }
        .vuetable-wrapper.ui.basic.segment {
            padding: 0em;
        }
        .vuetable button.ui.button {
            padding: .5em .5em;
            font-weight: 400;
        }
        .vuetable button.ui.button i.icon {
            margin: 0;
        }
        .vuetable th.sortable:hover {
            color: #2185d0;
            cursor: pointer;
        }
        .vuetable-actions, .custom-action {
            width: 15%;
            padding: 12px 0px;
            text-align: center;
        }
        .vuetable-pagination {
            background: #f9fafb !important;
        }
        .vuetable-pagination-info {
            margin-top: auto;
            margin-bottom: auto;
        }
        [v-cloak] {
            display: none;
        }
        .highlight {
            background-color: yellow;
        }
        .vuetable-detail-row {
            height: 200px;
        }
        .detail-row {
            margin-left: 40px;
        }
        .expand-transition {
            transition: all .5s ease;
        }
        .expand-enter, .expand-leave {
            height: 0;
            opacity: 0;
        }
        tr.odd {
            background-color: #e6f5ff;
        }
        body {
            overflow-y: scroll;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/sementic/components/icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sementic/components/button.css') }}">
</head>
<body>

<div id="app" class="container">
    <div id="app" class="ui vertical stripe segment">
        <div class="ui container">
            <div id="content" class="ui basic segment">
                <h3 class="ui header">List of Users</h3>
                <vuetable
                        api-url="api/users"
                        table-wrapper="#content"
                        :fields="columns"
                        pagination-path=""
                        :pagination-component="paginationComponent"
                        :item-actions="itemActions"
                ></vuetable>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.min.js"></script>
<script src="https://npmcdn.com/vuetable"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            sortOrder: [{
                field: 'name',
                direction: 'asc'
            }],
            multiSort: true,
            paginationComponent: 'vuetable-pagination',
            perPage: 5,
            columns: [
                'name',
                'nick_name',
                'gender',
                'birth_date',
                'email',
                '__actions'
            ],
            itemActions: [
                { name: 'view-item', label: '', icon: 'zoom icon', class: 'ui teal button' },
                { name: 'edit-item', label: '', icon: 'edit icon', class: 'ui orange button'},
                { name: 'delete-item', label: '', icon: 'delete icon', class: 'ui red button' }
            ]
        },
        methods: {
            viewProfile: function(id) {
                console.log('view profile with id:', id)
            }
        },
        events: {
            'vuetable:action': function(action, data) {
                console.log('vuetable:action', action, data)
                if (action == 'view-item') {
                    this.viewProfile(data.id)
                }
            },
            'vuetable:load-error': function(response) {
                console.log('Load Error: ', response)
            }
        }
    })
</script>
</body>
</html>