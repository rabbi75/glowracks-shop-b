<template>
	<div>
		<div class="sidebar">
			<div class="custom-tree">
				<div class=" title ">
					<h6>Product category</h6>
				</div>
				<ul class="mtree transit" v-if="categories.length > 0">
					<li v-for="(category,index) in categories">
						<router-link :to="{name:'category', params: {slug:category.slug}}">
							{{category.name}} 
							<span>({{category.products_count}})</span> 
						</router-link>
					</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				categories:[],
			}
		},
	methods:{
		loadCategory(){
			axios.get('/api/v1/all-category').then(response => {
				this.categories = response.data.categories;
			});
		}
	},
	mounted(){
		this.loadCategory();
	}
};
</script>