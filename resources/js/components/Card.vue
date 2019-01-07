<template>
	<card class="flex flex-col items-center justify-center" style="height: 50px;">
		<div class="px-3 py-3">
			<form @submit.prevent="processExport" ref="form">
				<button
						:disabled="working"
						type="submit"
						class="btn btn-default btn-primary ml-auto mt-auto"
				>
					<loader v-if="working" width="30"></loader>
					<span v-else>{{__('Export')}}</span>
				</button>
			</form>
		</div>
	</card>
</template>

<script>
	export default {
		props: [
			'card',
		],

		data() {
			return {
				working: false,
			};
		},
		mounted() {
			//
		},


		methods: {
			processExport() {
				this.working = true;
				axios({
					method: 'get',
					url: '/nova-vendor/export-card/endpoint/' + this.card.resource,
					responseType: 'arraybuffer'
				}).then(response => {
						const url = window.URL.createObjectURL(new Blob([response.data], {
							type:
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
						}));
						const link = document.createElement('a');
						link.href = url;
						link.setAttribute('download', 'stockAvailable.xlsx'); //or any other extension
						document.body.appendChild(link);
						link.click();
					})
					.finally(() => {
						this.working = false;
					});
			},
		},
	};
</script>
