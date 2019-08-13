<template>
	<table>
	    <thead>
	        <tr>
	            <th>Description</th>
	            <th>Quantity</th>
	            <th>Weight</th>
	            <th>Price</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<tr v-for="item in items">
	    		<ItemRows v-bind:items="items">
	    	</tr>
	    </tbody>
	</table>
</template>

<script>
	import ItemRow from "./ItemRow";

	export default {
		name: "InventoryTable",
		props: "items"
		components: {
			ItemRows
		},
		data(){
			return {
				items: []
			}
		}
	}
</script>