<template>
	<div>
		<table>
		    <thead>
		        <tr>
		            <th>Description</th>
		            <th>Quantity</th>
		            <th>Weight</th>
		            <th>Price</th>
		        </tr>
		    </thead>
		    <tbody v-for="item in items">
		    	<ItemRow v-bind:item="item" />
		    </tbody>
		</table>
	</div>
</template>

<script>
	import ItemRow from "./ItemRow";

	export default {
		name: "InventoryTable",
		props: [
			"inventory"
		],
		components: {
			ItemRow
		},
		data(){
			return {
				items: this.inventory.items
			}
		}
	}
</script>