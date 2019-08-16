<template>
	<div>Create Inventory</div>
</template>

<script>
	export default {
		name: "InventoryCreateForm",
        beforeRouteEnter (to, from, next) { 
            if (!localStorage.getItem('jwt')) {
                return next('login');
            }

            next();
        }
	}
</script>