<template>
    <div class="row d-flex align-items-center px-4">
        
		<div class="col-md-4 mt-4">
			<div class="page-total">
				<p><em>Total <strong>{{ total }} records</strong> found.</em></p>
			</div>
		</div>
		<div class="col-md-8">
			<nav aria-label="Page navigation">
				<ul v-if="pageData.length" class="pagination justify-content-end mt-4">
					<template v-for="pg in pageData">
						<li v-if="pg.url === null && !pg.active" class="page-item" :data-check="JSON.stringify(pg)">
							<a href="#" data-page="" class=" page-link disabled" role="button" v-html="pg.label"></a>
						</li>
						<li v-else-if="pg.url !== null && pg.active" class="page-item active" :data-check="JSON.stringify(pg)">
							<a :href="pg.url" :data-page="pg.label" class=" page-link" role="button" v-html="pg.label"></a>
						</li>
						<li v-else class="page-item" :data-check="JSON.stringify(pg)">
							<a :href="pg.url" :data-page="pg.label" class=" page-link" role="button" v-html="pg.label"></a>
						</li>
					</template>
				</ul>
			</nav>	
		</div>
	</div>
</template>

<script>
export default {
   
	props: ['pageData', 'total'],
	methods: {
	},
	mounted: function() {
	},
}
</script>