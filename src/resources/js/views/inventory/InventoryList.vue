<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Inventory</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <form method="GET" action="/api/inventory" @submit="handleSubmit">
                                <div class="col-md-6">
                                    <input id="search" type="text" placeholder="Search Inventory" class="form-control" v-model="search" autofocus>
                                </div>
                            </form>
                        </div>
                        <div class="row" v-if="loading">
                            Loading...
                        </div>
                        <div class="row" v-else-if="error">
                            Error!
                        </div>
                        <div class="row" v-else-if="inventory.items.length > 0">
                            <InventoryTable v-bind:inventory="inventory" />
                        </div>
                        <div class="row" v-else>
                            <h2>No results were found</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InventoryTable from "../../components/inventory/InventoryTable"

    export default {
        name: "InventoryList",
        components: {
            InventoryTable
        },
        watch: {
            '$route': "fetchData"
        },
        data(){
            return {
                loading: true,
                error: null,
                inventory: {
                    items: []
                },
                search: ""
            }
        },
        created () {
            // fetch the data when the view is created and the data is
            // already being observed
            this.fetchData()
        },
        methods : {
            fetchData() {
                axios.get('/api/inventory')
                    .then(response => {
                        this.inventory.items = response.data.data
                        this.loading = false
                    })
                    .catch(function (error) {
                        this.loading = false
                        this.error = true
                        console.error(error)
                    });
            },
            handleSubmit(e){
                e.preventDefault()

                this.loading = true

                axios.get('api/inventory', {
                    params: {
                        description_contains: this.search
                    }
                  })
                  .then(response => {
                    this.inventory.items = response.data.data
                    this.loading = false
                  })
                  .catch(function (error) {
                    this.error = true
                    console.error(error)
                  })
            }
        }
    }
</script>