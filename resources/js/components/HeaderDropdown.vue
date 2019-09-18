<template>

	<div class="dropdown relative mr-10">

		<div @click="isOpen = !isOpen">
			<slot name="trigger"></slot>
		</div>



		<div v-show="isOpen" 
			class="dropdownmenu absolute card mt-2 w-full" 
			style="padding: 10px  0 10px 0;"
			:style="{ width }"
		>

			<slot></slot>

		</div>


	</div>

</template>





<script>

	export default {

		props: {
			width: {default: 'auto'}
		},

		data() {
			return { isOpen: false }
		}

	}




</script>