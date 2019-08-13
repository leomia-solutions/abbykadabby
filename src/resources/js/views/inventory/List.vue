<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Inventory</div>

                    <div class="card-body">
                        <form method="POST" action="/inventory">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="search" type="text" class="form-control" v-model="description_contains" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <InventoryTable />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    import InventoryTable from './InventoryTable'

    export default {
        name: 'Inventory',
        components: {
            InventoryTable
        },
        data(){
            return {
                inventory: { 
                    items: [],
                }
            }
        },
        methods : {
            handleSubmit(e){
                e.preventDefault()

                if (this.description_contains.length > 0) {
                    axios.get('api/inventory', {
                        description_contains: this.search,
                      })
                      .then(response => {

                      })
                      .catch(function (error) {
                        console.error(error);
                      });
                }
            }
        }
    }
</script>