<template>
	<tr>
		<td name="description">
			{{ item.description }}
		</td>
		<td name="quantity">
			{{ item.quantity }}
		</td>
		<td name="weight">
			{{ item.weight }} {{ item.weight_units }}
		</td>
		<td name="price">
			${{ item.price }} / {{ item.price_units }}
		</td>
	</tr>
</template>

<script>
export default {
	name: "ItemRow",
	props: [
		"item"
	]
}
</script>