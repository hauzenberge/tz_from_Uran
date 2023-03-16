<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vue.js + Bootstrap + API Demo</title>

    <!-- Підключення бібліотек -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>

    <div id="app" class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Vue.js + Bootstrap + API Demo</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <!-- Форма фільтрації за trial_end -->
                <div class="form-group">
                    <label for="trial_end_filter">Trial End Filter</label>
                    <input type="date" class="form-control" id="trial_end_filter" v-model="trialEndFilter">
                </div>
            </div>

            <div class="col-md-4">
                <!-- Форма пошуку за name та description -->
                <div class="form-group">
                    <label for="search_filter">Search </label>
                    <input type="text" class="form-control" id="search_filter" v-model="searchFilter">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Відображення карток з даними -->
                <div class="card-columns">
                    <div v-for="item in filteredItems" class="card">
                        <div class="card-body">
                            <h5 class="card-title">@{{ item.name }}</h5>
                            <p class="card-text" v-html="item.description"></p>
                            <p class="card-text"><small class="text-muted">@{{ item.trial_end }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS-скрипт з кодом Vue.js -->
    <script>
        new Vue({
            el: '#app',
            data: {
                items: [],
                trialEndFilter: '',
                searchFilter: ''
            },
            computed: {
                // Фільтрація за trial_end
                filteredItems: function() {
                    return this.items.filter(item => {
                        if (this.trialEndFilter === '') {
                            return true;
                        }
                        return item.trial_end.includes(this.trialEndFilter);
                    }).filter(item => {
                        // Пошук за name та description
                        if (this.searchFilter === '') {
                            return true;
                        }
                        return item.name.includes(this.searchFilter) || item.description.includes(this.searchFilter);
                    });
                }
            },
            mounted() {
                // Запит до API
                axios.get('http://localhost/api/organisations')
                    .then(response => {
                        // Присвоювання даних до масиву items
                        this.items = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        });
    </script>

</body>

</html>