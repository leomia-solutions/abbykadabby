<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Add an Item to Your Inventory</div>

                    <div class="card-body">
                        <form method="POST" action="/api/inventory">
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Item Description</label>

                                <div class="col-md-6">
                                	{{ errors.description }}
                                    <input id="description" type="text" class="form-control" v-model="description" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity</label>

                                <div class="col-md-6">
                                    <input id="quantity" type="number" class="form-control" v-model="quantity" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="weight" class="col-md-4 col-form-label text-md-right">Weight</label>

                                <div class="col-md-6">
                                    <input id="weight" type="text" class="form-control" v-model="weight" required>
                                    <select id="weight_units" class="form-control" v-model="weight_units" required>
                                    	<option>Select</option>
                                    	<option value="lb">lbs</option>
                                    	<option value="kg">kg</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price ($)</label>

                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" v-model="price" required> /
                                    <select id="price_units" class="form-control" v-model="price_units" required>
                                    	<option>Select</option>
                                    	<option value="lb">lbs</option>
                                    	<option value="kg">kg</option>
                                    	<option value="ea">each</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
	#price, #weight { width:265px; display: inline-flex; }
	#price_units, #weight_units { width: 130px; display: inline-flex; }
</style>

<script>
	export default {
		name: "InventoryCreateForm",
		data() {
			return {
				description: null,
				quantity: null,
				weight: null,
				weight_units: null,
				price: null,
				price_units: null,
				errors: {},
				state: 0
			}
		},
		computed: {
			descriptionError() {
				return this.errors.description
			}
		},
        beforeRouteEnter (to, from, next) { 
            if (!localStorage.getItem('jwt')) {
                return next('login');
            }

            next();
        },
        methods: {
        	validate() {
        		if (!this.description) {
        			this.errors.description = "You must enter a description."
        			this.state++
        		}

        		if (typeof this.quantity !== "number") {
        			this.errors.quantity = "Quantity must be a number."
        			this.state++
        		}

        		if (typeof this.weight !== "number") {
        			this.errors.weight = "Weight must be a number."
        			this.state++
        		}

        		if (!this.weight) {
        			this.errors.weight = "You must enter a weight."
        			this.state++
        		}

        		if (!this.weight_units) {
        			this.errors.weight_units = "You must select a weight unit."
        			this.state++
        		}

        		if (typeof this.price !== "number") {
        			this.errors.price = "Price must be a number."
        			this.state++
        		}

        		if (!this.price) {
        			this.errors.price = "You must enter a price."
        			this.state++
        		}

        		if (!this.price_units) {
        			this.errors.price_units = "You must select a price unit."
        			this.state++
        		}

        		console.log(this.errors)

        		return !(this.errors)
        	},
        	handleSubmit: function (e) {
                let headers = {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('jwt')
                    } 

        		e.preventDefault();

        		if (this.validate()) {
	        		axios.post('/api/inventory', {
	        			headers: headers,
	        			description: this.description,
	        			quantity: this.quantity,
	        			weight: this.weight,
	        			weight_units: this.weight_units,
	        			price: this.price,
	        			price_units: this.price_units
	        		}).then(response => {
	        			this.$router.go('inventory')
	        		}).catch(function (error) {
	        			alert(error.message)
	        		})
        		}
        	}
        }
	}
</script>